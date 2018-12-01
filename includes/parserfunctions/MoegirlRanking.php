<?php

/**
 * Created by PhpStorm.
 * User: Hi_old
 * Date: 2018/11/22
 * Time: 10:04
 */
require_once("TypeEnum.php");
require_once("DateUtils.php");

final class MoegirlRanking
{
    protected static $service;

    // Register any render callbacks with the parser
    public static function onParserFirstCallInit(Parser &$parser)
    {

        // Create a function hook associating the "example" magic word with renderExample()
        try {
            $parser->setFunctionHook('MoeRanking2', 'MoegirlRanking::renderExample');
            $parser->setFunctionHook('MoeRanking', 'MoegirlRanking::rankDispatcher');
        } catch (MWException $e) {
        }
//        return true;
    }

    // Render the output of {{#example:}}.
    public static function renderExample($parser, $param1 = '', $param2 = '', $param3 = '')
    {
        $parser->getOutput()->updateCacheExpiry(30);
        // The input parameters are wikitext with templates expanded.
        // The output should be wikitext too.
        $pgt = '[http://192.168.0.108/index.php/测试页面20 测试页面20]';


        $output = "param1 is $param1 and param2 is $param2 and param3 is $param3";

        return $output;
    }

    // Render the output of {{#example:}}.
    public static function ranking($parser, $start, $limit)
    {
        $parser->getOutput()->updateCacheExpiry(30);
        // The input parameters are wikitext with templates expanded.
        // The output should be wikitext too.
        $service = new RankAroundService();
        $rock = $service->getAllrank($start, $limit);

        $output = "";
        for ($idx = 0; $idx < sizeof($rock); $idx++) {
            $tar = $rock[$idx];
            $output = $output . "[" . $tar[2] . " " . $tar[1]->mTitle->mTextform . "]" . "'''访问量:" . $tar[0]->vstcnt . "'''" . "<br>";
        }


//        $output = "Hi_old   " . date("Y-m-d H:i:s:u");

        return $output;
    }

    //magic ranking word
    //任务派发调度

    public static function rankDispatcher($parser, $ranktype = '', $datatype = '', $param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '', $param6 = '', $param7 = '', $param8 = '')
    {
        //实时加载
        $parser->getOutput()->updateCacheExpiry(30);

        if ($ranktype == TypeEnum::$MOERANK_RANKTYPE_RANKTIMEDAY) {
            if ($datatype == TypeEnum::$MOERANK_DATATYPE_DEFAULT) {
                return self::rankByTimeDefault($parser, $param1, $param2);
            } else if ($datatype == TypeEnum::$MOERANK_DATATYPE_DEFAULT_SINGLE) {
                return self::rankByTimeDefaultForSingle($parser, $param1, $param2);
            } else if ($datatype == TypeEnum::$MOERANK_DATATYPE_DEFAULT_SINGLE_FIELD) {
                return self::rankByTimeDefaultForSingleField($parser, $param1, $param2, $param3);
            }
        }
        return "empty";
    }


    /**
     * 近期词条排序默认展示
     * @param $parser Parser 输出控制
     * @param $date int 日期
     * @param $size int 获取数量
     */
    public static function rankByTimeDefault($parser, $date, $size)
    {
//        self::addlogtoFile("func", $date . "    " . $size);
        $localDateString = DateUtils::getDateArray($date);

        $parser->getOutput()->updateCacheExpiry(30);
        // The input parameters are wikitext with templates expanded.
        // The output should be wikitext too.
        $service = new RankAroundService();
        $rock = $service->getRankByTimeLimited($localDateString[0], $localDateString[1], 0, $size);

//        print_r($rock);
//        $src = $rock[0];

        $output = "";
        for ($idx = 0; $idx < sizeof($rock); $idx++) {
            $tar = $rock[$idx];
            $output = $output . "[" . $tar[2] . " " . $tar[1]->mTitle->mTextform . "]" . "'''访问量:" . $tar[0]->vstcnt . "'''" . "<br>";
        }
        return $output;
    }


    public static function rankByTimeDefaultForSingle($parser, $date, $position)
    {
        if ($position < 1) {
            return null;
        }
//        self::addlogtoFile("func", $date . "    " . $position);
        $localDateString = DateUtils::getDateArray($date);

        $parser->getOutput()->updateCacheExpiry(30);
        // The input parameters are wikitext with templates expanded.
        // The output should be wikitext too.
        $service = new RankAroundService();
        $rock = $service->getRankByTimeLimited($localDateString[0], $localDateString[1], $position - 1, 1);

//        print_r($rock);
//        $src = $rock[0];

        $output = "";
        for ($idx = 0; $idx < sizeof($rock); $idx++) {
            $tar = $rock[$idx];
            $output = $output . "[" . $tar[2] . " " . $tar[1]->mTitle->mTextform . "]" . "'''访问量:" . $tar[0]->vstcnt . "'''" . "<br>";
        }
        return $output;
    }


    public static function rankByTimeDefaultForSingleField($parser, $date, $position, $field)
    {
        if ($position < 1) {
            return null;
        }
//        self::addlogtoFile("func", $date . "    " . $position);
        $localDateString = DateUtils::getDateArray($date);

        $parser->getOutput()->updateCacheExpiry(30);
        $service = new RankAroundService();
        $rock = $service->getRankByTimeLimited($localDateString[0], $localDateString[1], $position - 1, 1);

//        print_r($rock);
//        $src = $rock[0];

        $output = "";

        if ($field == TypeEnum::$MOERANK_FIELD_WIKI_TITLE) {
            for ($idx = 0; $idx < sizeof($rock); $idx++) {
                $tar = $rock[$idx];
                $output = $tar[1]->mTitle->mTextform;
            }
        } else if ($field == TypeEnum::$MOERANK_FIELD_WIKI_URL) {
            for ($idx = 0; $idx < sizeof($rock); $idx++) {
                $tar = $rock[$idx];
                $output = $tar[2];
            }
        } else if ($field == TypeEnum::$MOERANK_FIELD_WIKI_RANK) {
            for ($idx = 0; $idx < sizeof($rock); $idx++) {
                $tar = $rock[$idx];
                $output = $tar[0]->vstcnt;
            }
        }

        return $output;
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