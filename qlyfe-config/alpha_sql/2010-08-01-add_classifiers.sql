-- add classifiers to qlyfe... later we can remove the access_id from all tables (entities, metadata, annotations)

drop table if exists qlyfe_classifiers;
create table qlyfe_classifiers (
	id bigint(20) unsigned,
	type varchar(20) ,
	network varchar(20) ,
	classifier varchar(30) ,
	key network_classifier (id, type, network, classifier),
	key unique_id (id, type) 
);

-- entities
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'public' as network from qlyfe_entities e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'friends' as network from qlyfe_entities e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'private' as network from qlyfe_entities e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'friends' as network from qlyfe_entities e where e.access_id = -2;

-- metadata
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'public' as network from qlyfe_metadata e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'public' as network from qlyfe_metadata e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'private' as network from qlyfe_metadata e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'public' as network from qlyfe_metadata e where e.access_id = -2;

-- annotations
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'public' as network from qlyfe_annotations e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'public' as network from qlyfe_annotations e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'private' as network from qlyfe_annotations e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'public' as network from qlyfe_annotations e where e.access_id = -2;

-- the river
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'public' as network from qlyfe_river e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'public' as network from qlyfe_river e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'private' as network from qlyfe_river e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'public' as network from qlyfe_river e where e.access_id = -2;

-- system log
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'public' as network from qlyfe_system_log e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'public' as network from qlyfe_system_log e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'private' as network from qlyfe_system_log e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'public' as network from qlyfe_system_log e where e.access_id = -2;

update qlyfe_classifiers c, qlyfe_entities e set c.network = 'public' where c.id = e.guid and c.type='entity' and e.type = 'user'; 



alter table qlyfe_entity_relationships add column network varchar(20);
alter table qlyfe_entity_relationships add column classifier varchar(20);
update qlyfe_entity_relationships set network = 'friends', classifier = 'f' where relationship = 'friend';

update qlyfe_entities set owner_guid = guid where type = 'user';

grant all privileges on qlyfe.* to qlyfe@localhost identified by 'abc123';

