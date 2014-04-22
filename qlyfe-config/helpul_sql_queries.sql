-- get metadata for a guid
select a.string, b.string, c.network, c.classifier 
from qlyfe_metastrings a, qlyfe_metastrings b, qlyfe_metadata m, qlyfe_classifiers c 
where 
	a.id = m.name_id and 
	b.id = m.value_id and 
	c.id = m.id and c.type = 'metadata' and
	m.entity_guid = 2;


