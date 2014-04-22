ALTER TABLE qlyfe_entity_relationships DROP KEY guid_one;
ALTER TABLE qlyfe_entity_relationships ADD KEY guid_one (guid_one,relationship,guid_two);
ALTER TABLE qlyfe_entity_relationships ADD KEY classified (guid_one, guid_two, network, classifier);

