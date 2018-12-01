<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/20
 * Time: 21:07
 */

final class SqlInfomation
{
    public static $tableName = 'moegirl_ranking_visit_records';
    public static $MOEGIRL_VISIT_RECORD_INSER = 'INSERT INTO %s(`wiki_id`,`wiki_version`,`user_id`,`visit_time`) VALUES(%d,%d,\'%s\',NOW());';
    public static $MOEGIRL_QUERY_ALL_RANK = 'SELECT COUNT(wiki_id) vstcnt,wiki_id FROM %s GROUP BY wiki_id ORDER BY vstcnt DESC LIMIT %d ,%d;';
    public static $MOEGIRL_QUERY_RANK_BY_CREATIONTIME = 'SELECT COUNT(wiki_id) vstcnt,wiki_id FROM %s WHERE wiki_id IN (SELECT rev_page FROM %s WHERE rev_parent_id=0 AND rev_len <> 0 AND rev_timestamp BETWEEN \'%s\' AND \'%s\') GROUP BY wiki_id ORDER BY vstcnt DESC;';
    public static $MOEGIRL_QUERY_RANK_BY_CREATIONTIME_LIMITED = 'SELECT COUNT(wiki_id) vstcnt,wiki_id FROM %s WHERE wiki_id IN (SELECT rev_page FROM %s WHERE rev_parent_id=0 AND rev_len <> 0 AND rev_timestamp BETWEEN \'%s\' AND \'%s\') GROUP BY wiki_id ORDER BY vstcnt DESC limit %s,%s;';


}