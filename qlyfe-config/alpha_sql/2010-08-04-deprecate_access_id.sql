ALTER TABLE qlyfe_entities MODIFY column access_id int(11);
ALTER TABLE qlyfe_entities DROP KEY access_id;

ALTER TABLE qlyfe_metadata MODIFY column access_id int(11);
ALTER TABLE qlyfe_metadata DROP KEY access_id;

ALTER TABLE qlyfe_annotations MODIFY column access_id int(11);
ALTER TABLE qlyfe_annotations DROP KEY access_id;

ALTER TABLE qlyfe_river MODIFY column access_id int(11);
ALTER TABLE qlyfe_river DROP KEY access_id;

ALTER TABLE qlyfe_system_log MODIFY column access_id int(11);
ALTER TABLE qlyfe_system_log DROP KEY access_id;
