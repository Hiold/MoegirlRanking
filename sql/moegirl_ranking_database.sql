BEGIN;
CREATE TABLE IF NOT EXISTS /*_*/moegirl_ranking_visit_records (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `wiki_id` int(11) NOT NULL,
  `wiki_version` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `visit_time` datetime NOT NULL,
  `byzd1` varchar(100) DEFAULT NULL,
  `byzd2` varchar(100) DEFAULT NULL,
  `byzd3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rank_id`)
)/*$wgDBTableOptions*/;

CREATE INDEX /*i*/ranking_user ON /*_*/moegirl_ranking_visit_records(user_id);
CREATE INDEX /*i*/ranking_wikiId ON /*_*/moegirl_ranking_visit_records(wiki_id);
CREATE INDEX /*i*/ranking_vsttime ON /*_*/moegirl_ranking_visit_records(visit_time);

COMMIT;

