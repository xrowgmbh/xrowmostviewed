CREATE TABLE `ex_xrow_counter` (
  `node_id` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `impressions` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO ex_xrow_counter (node_id, views)
    SELECT ezview_counter.node_id, ezview_counter.count 
    FROM ezview_counter;