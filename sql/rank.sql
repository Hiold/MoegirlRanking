SELECT COUNT(*) FROM wikimoegirl_ranking_visit_records g WHERE g.visit_time BETWEEN STR_TO_DATE('2014-08-20 00:00:00', '%Y-%m-%d %H:%i:%s') AND STR_TO_DATE('2018-11-20 23:59:59', '%Y-%m-%d %H:%i:%s')

SELECT * FROM wikimoegirl_ranking_visit_records;

SELECT COUNT(wiki_id) vstcnt,wiki_id FROM wikimoegirl_ranking_visit_records WHERE wiki_id IN (SELECT rev_id FROM `wikidb`.`wikirevision` WHERE rev_parent_id=0 AND rev_len <> 0 AND rev_timestamp BETWEEN '20181119000000' AND '20181120235959') GROUP BY wiki_id ORDER BY vstcnt DESC;


SELECT COUNT(wiki_id) vstcnt,wiki_id FROM wikimoegirl_ranking_visit_records GROUP BY wiki_id ORDER BY vstcnt DESC LIMIT 0,10;




SELECT rev_id FROM `wikidb`.`wikirevision` WHERE rev_parent_id=0 AND rev_len <> 0 AND rev_timestamp BETWEEN '20181119000000' AND '20181120235959';/*所有页面，可按时间排序*/


SELECT COUNT(wiki_id) vstcnt,wiki_id FROM %s WHERE wiki_id IN (SELECT rev_id FROM %s WHERE rev_parent_id=0 AND rev_len <> 0 AND rev_timestamp BETWEEN '%s' AND '%s') GROUP BY wiki_id ORDER BY vstcnt DESC LIMIT %s,%s;