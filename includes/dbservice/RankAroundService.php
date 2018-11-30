<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/20
 * Time: 21:15
 */
require_once("SqlInfomation.php");

class RankAroundService
{
    //记录访问日志
    public function insertVisitToDB($wiki_id, $wiki_version, $user_id)
    {
        $dbConnR = @wfGetDB(DB_SLAVE);
        $dbConnW = @wfGetDB(DB_MASTER);
        $f = $dbConnW->tableName(SqlInfomation::$tableName);

        $sql = @sprintf(SqlInfomation::$MOEGIRL_VISIT_RECORD_INSER, $f, $wiki_id, $wiki_version, $user_id);
        $result = $dbConnW->query($sql, __METHOD__);
//        Loggerss::addlogtoFile("insertsql", $sql . "-----result" . $result);

    }

    //
    public function getAllrank($start, $limit)
    {
        if (!isset($start) || !isset($limit)) {
            return false;
        }

        $dbr = wfGetDB(DB_SLAVE);
        $f = $dbr->tableName(SqlInfomation::$tableName);
        $sql = @sprintf(SqlInfomation::$MOEGIRL_QUERY_ALL_RANK, $f, $start, $limit);
//        $this->logger->debug( __LINE__, 'getAverageScore sql is ' . $sql );
        $output = $dbr->query($sql, __METHOD__);
        $up = [];
        for ($ing = 0; $ing < $output->numRows(); $ing++) {
            $tem = $output->next();
            $up[$ing][0] = $tem;
            $up[$ing][1] = WikiPage::newFromID($tem->wiki_id);
            $up[$ing][2] = WikiPage::newFromID($tem->wiki_id)->getSourceURL();
        }

        return $up;
    }

    public function getRankByCreationTime($startTime, $endTime)
    {
        if (!isset($startTime) || !isset($endTime)) {
            return false;
        }

        $dbr = wfGetDB(DB_SLAVE);
        $visitTableName = $dbr->tableName(SqlInfomation::$tableName);
        $reversionTableName = $dbr->tableName('revision');
        $sql = @sprintf(SqlInfomation::$MOEGIRL_QUERY_RANK_BY_CREATIONTIME, $visitTableName, $reversionTableName, $startTime, $endTime);
        $output = $dbr->query($sql, __METHOD__);
        $up = [];
        for ($ing = 0; $ing < $output->numRows(); $ing++) {
            $tem = $output->next();
            $up[$ing][0] = $tem;
            $up[$ing][1] = WikiPage::newFromID($tem->wiki_id);
            $up[$ing][2] = WikiPage::newFromID($tem->wiki_id)->getSourceURL();
        }

        return $up;
    }

    public function getRankByTimeLimited($timestart, $timeend, $start, $limit)
    {
//        self::addlogtoFile("sql----", $timestart . "-----" . $timeend . "-----" . $start . "-----" . $limit);
        if (!isset($timestart) || !isset($timeend) || !isset($start) || !isset($limit)) {
            return false;
        }

        $dbr = wfGetDB(DB_SLAVE);
        $visitTableName = $dbr->tableName(SqlInfomation::$tableName);
        $reversionTableName = $dbr->tableName('revision');
        $sql = @sprintf(SqlInfomation::$MOEGIRL_QUERY_RANK_BY_CREATIONTIME_LIMITED, $visitTableName, $reversionTableName, $timestart, $timeend, $start, $limit);
//        self::addlogtoFile("sql----", $sql);
        $output = $dbr->query($sql, __METHOD__);
        $up = [];
        for ($ing = 0; $ing < $output->numRows(); $ing++) {
            $tem = $output->next();
            $up[$ing][0] = $tem;
            $up[$ing][1] = WikiPage::newFromID($tem->wiki_id);
            $up[$ing][2] = WikiPage::newFromID($tem->wiki_id)->getSourceURL();
        }

        return $up;
    }

    public static function addlogtoFile($func, $message)
    {
        $logfilePath = __DIR__ . '/logger' . -date('Ymd') . '.log';
        $fileobj = @fopen($logfilePath, "a");
        date_default_timezone_set("Asia/Shanghai");
        if (!$fileobj) {
            echo "没有当天日志文件-->创建一个日志文件";
            fopen($logfilePath, "w");
        } else {
            fwrite($fileobj, date("Y-m-d H:i:s:u") . ":-->" . $func . "-->" . json_encode($message));
            fwrite($fileobj, "\r\n");
        }
    }


}