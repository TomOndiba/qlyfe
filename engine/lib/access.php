<?php
/**
 * Elgg access permissions
 * For users, objects, collections and all metadata
 *
 * @package Elgg
 * @subpackage Core
 */

/**
 * Temporary class used to determing if access is being ignored
 */
class ElggAccess {
	/**
	 * Bypass Elgg's access control if true.
	 * @var bool
	 */
	private $ignore_access;

	/**
	 * Get current ignore access setting.
	 * @return bool
	 */
	public function get_ignore_access() {
		return $this->ignore_access;
	}

	/**
	 * Set ignore access.
	 *
	 * @param $ignore bool true || false to ignore
	 * @return bool Previous setting
	 */
	public function set_ignore_access($ignore = true) {
		$prev = $this->ignore_access;
		$this->ignore_access = $ignore;

		return $prev;
	}
}

/**
 * Return a string of access_ids for $user_id appropriate for inserting into an SQL IN clause.
 *
 * Will always return PUBLIC 
 *  Will return LOGGED_IN if you're logged in
 *  Will return PRIVATE if you have access override privileges
 *  
 * @uses get_access_array
 * @param int $user_id User ID; defaults to currently logged in user
 * @param int $site_id Site ID; defaults to current site
 * @param boolean $flush If set to true, will refresh the access list from the database
 * @return string A list of access collections suitable for injection in an SQL call
 */
function get_access_list($user_id = 0, $site_id = 0, $flush = false) {
	global $CONFIG, $init_finished, $SESSION;
	static $access_list;

	if (!isset($access_list) || !$init_finished) {
		$access_list = array();
	}

	if ($user_id == 0) {
		$user_id = $SESSION['id'];
	}

	if (($site_id == 0) && (isset($CONFIG->site_id))) {
		$site_id = $CONFIG->site_id;
	}
	$user_id = (int) $user_id;
	$site_id = (int) $site_id;

	if (isset($access_list[$user_id])) {
		return $access_list[$user_id];
	}

	$access_list[$user_id] = "(" . implode(",", get_access_array($user_id, $site_id, $flush)) . ")";

	return $access_list[$user_id];
}

/**
 * Gets an array of access restrictions the given user is allowed to see on this site
 * 
 * Will always return PUBLIC 
 *  Will return LOGGED_IN if you're logged in
 *  Will return PRIVATE if you have access override privileges
 *
 * @param int $user_id User ID; defaults to currently logged in user
 * @param int $site_id Site ID; defaults to current site
 * @param boolean $flush If set to true, will refresh the access list from the database
 * @return array An array of access collections suitable for injection in an SQL call
 */
function get_access_array($user_id = 0, $site_id = 0, $flush = false) {
	global $CONFIG, $init_finished;

	// @todo everything from the db is cached.
	// this cache might be redundant.
	static $access_array;

	if (!isset($access_array) || (!isset($init_finished)) || (!$init_finished)) {
		$access_array = array();
	}

	if ($user_id == 0) {
		$user_id = get_loggedin_userid();
	}

	if (($site_id == 0) && (isset($CONFIG->site_guid))) {
		$site_id = $CONFIG->site_guid;
	}

	$user_id = (int) $user_id;
	$site_id = (int) $site_id;

	if (empty($access_array[$user_id]) || $flush == true) {
		$tmp_access_array = array(ACCESS_PUBLIC);
		if (isloggedin()) {
			
			// @qlyfe addition .. we don't really care about LOGGED_IN either
			// $tmp_access_array[] = ACCESS_LOGGED_IN;

			/** @qlyfe addition ... we're not using access collections
			// The following can only return sensible data if the user is logged in.

			// Get ACL memberships
			$query = "SELECT am.access_collection_id FROM {$CONFIG->dbprefix}access_collection_membership am ";
			$query .= " LEFT JOIN {$CONFIG->dbprefix}access_collections ag ON ag.id = am.access_collection_id ";
			$query .= " WHERE am.user_guid = {$user_id} AND (ag.site_guid = {$site_id} OR ag.site_guid = 0)";

			if ($collections = get_data($query)) {
				foreach($collections as $collection) {
					if (!empty($collection->access_collection_id)) {
						$tmp_access_array[] = $collection->access_collection_id;
					}
				}
			}

			// Get ACLs owned.
			$query = "SELECT ag.id FROM {$CONFIG->dbprefix}access_collections ag  ";
			$query .= " WHERE ag.owner_guid = {$user_id} AND (ag.site_guid = {$site_id} OR ag.site_guid = 0)";

			if ($collections = get_data($query)) {
				foreach($collections as $collection) {
					if (!empty($collection->id)) {
						$tmp_access_array[] = $collection->id;
					}
				}
			}
			*/

			$ignore_access = elgg_check_access_overrides($user_id);

			if ($ignore_access == true) {
				$tmp_access_array[] = ACCESS_PRIVATE;
			}

			$access_array[$user_id] = $tmp_access_array;
		} else {
			// No user id logged in so we can only access public info
			$tmp_return = $tmp_access_array;
		}

	} else {
		$tmp_access_array = $access_array[$user_id];
	}

	return trigger_plugin_hook('access:collections:read','user',array('user_id' => $user_id, 'site_id' => $site_id),$tmp_access_array);
}

/**
 * Gets the default access permission for new content
 *
 * @return int default access id (see ACCESS defines in elgglib.php)
 */
function get_default_access(ElggUser $user = null) {
	global $CONFIG;

	if (!$CONFIG->allow_user_default_access) {
		return $CONFIG->default_access;
	}

	if (!($user) || (!$user = get_loggedin_user())) {
		return $CONFIG->default_access;
	}

	if (false !== ($default_access = $user->getPrivateSetting('elgg_default_access'))) {
		return $default_access;
	} else {
		return $CONFIG->default_access;
	}
}

/**
 * Override the default behaviour and allow results to show hidden entities as well.
 * THIS IS A HACK.
 *
 * TODO: Replace this with query object!
 */
$ENTITY_SHOW_HIDDEN_OVERRIDE = false;

/**
 * This will be replaced. Do not use in plugins!
 *
 * @param bool $show
 */
function access_show_hidden_entities($show_hidden) {
	global $ENTITY_SHOW_HIDDEN_OVERRIDE;
	$ENTITY_SHOW_HIDDEN_OVERRIDE = $show_hidden;
}

/**
 * This will be replaced. Do not use in plugins!
 */
function access_get_show_hidden_status() {
	global $ENTITY_SHOW_HIDDEN_OVERRIDE;
	return $ENTITY_SHOW_HIDDEN_OVERRIDE;
}

/**
 * Add annotation restriction
 *
 * Returns an SQL fragment that is true (or optionally false) if the given user has
 * added an annotation with the given name to the given entity.
 *
 * TODO: This is fairly generic so perhaps it could be moved to annotations.php
 *
 * @param string $annotation_name name of the annotation
	* @param string $entity_guid SQL string that evaluates to the GUID of the entity the annotation should be attached to
	* @param string $owner_guid SQL string that evaluates to the GUID of the owner of the annotation	 	 *
	* @param boolean $exists If set to true, will return true if the annotation exists, otherwise returns false
	* @return string An SQL fragment suitable for inserting into a WHERE clause
 */
function get_annotation_sql($annotation_name, $entity_guid, $owner_guid, $exists) {
	global $CONFIG;

	if ($exists) {
		$not = '';
	} else {
		$not = 'NOT';
	}

	$sql = <<<END
$not EXISTS (SELECT * FROM {$CONFIG->dbprefix}annotations a
INNER JOIN {$CONFIG->dbprefix}metastrings ms ON (a.name_id = ms.id)
WHERE ms.string = '$annotation_name'
AND a.entity_guid = $entity_guid
AND a.owner_guid = $owner_guid)
END;
	return $sql;
}

/** @qlyfe addition all of this classifer stuff */

/**
 * @see get_access_sql_suffix
 * @param unknown_type $table_prefix
 * @param unknown_type $looker
 */
function get_entity_access_sql_suffix($table_prefix = '', $looker = null) {
	return get_access_sql_suffix("entity", $table_prefix, $looker);
}
/**
 * @see get_access_sql_suffix
 * @param unknown_type $table_prefix
 * @param unknown_type $looker
 */
function get_metadata_access_sql_suffix($table_prefix = '', $looker = null) {
	return get_access_sql_suffix("metadata", $table_prefix, $looker);
}
/**
 * @see get_access_sql_suffix
 * @param unknown_type $table_prefix
 * @param unknown_type $looker
 */
function get_annotation_access_sql_suffix($table_prefix = '', $looker = null) {
	return get_access_sql_suffix("annotation", $table_prefix, $looker);
}

function get_river_access_sql_suffix($table_prefix = '', $looker = null) {
	return get_river_sql_suffix("river", $table_prefix, $looker);
}
function get_system_log_access_sql_suffix($table_prefix = '', $looker = null) {
	return get_system_log_sql_suffix("system_log", $table_prefix, $looker);
}
/**
 * Insert into the metadata classifiers table
 * Enter description here ...
 * @param string $type (entity, metadata, or annotation)
 * @param string or int $id
 * @param Qlyfe_CList, string or array $clist
 */
function insert_classifiers($type, $id, $clist) {
	global $CONFIG;
	
	if (empty($clist)) return;
	
	if (!($clist instanceof Qlyfe_CList))
		$clist = new Qlyfe_CList($clist);
	$id_name = $type == "entity" ? "guid" : "id";
		
	// @var Qlyfe_Classifier $classifier
	foreach ($clist->list as $classifier) {
		
		// this means a network but no classifier (like 'public')
		if ($classifier->classifier) {
			insert_data("INSERT into {$CONFIG->dbprefix}classifiers (id, type, network, classifier) " .
				"VALUES ($id, '{$type}', '{$classifier->network}', '{$classifier->classifier}')");
		} else {			
			insert_data("INSERT into {$CONFIG->dbprefix}classifiers (id, type, network) " .
				"VALUES ($id, '{$type}', '{$classifier->network}')");
		}
	}
}
function insert_entity_classifiers($id, $clist) { insert_classifiers("entity", $id, $clist); }
function insert_metadata_classifiers($id, $clist) { insert_classifiers("metadata", $id, $clist); }
function insert_annotation_classifiers($id, $clist) { insert_classifiers("annotation", $id, $clist); }
function insert_river_classifiers($id, $clist) { insert_classifiers("river", $id, $clist); }
function insert_system_log_classifiers($id, $clist) { insert_classifiers("system_log", $id, $clist); }

/**
 * Delete these classifiers from the DB
 * @param string $type (entity, metadata, or annotation)
 * @param string or int $id
 */
function delete_classifiers($type, $id) {
	global $CONFIG;
	$id_name = $type == "entity" ? "guid" : "id";
	delete_data("DELETE FROM {$CONFIG->dbprefix}classifiers WHERE 
		type='{$type}' AND id=$id");
}
function delete_entity_classifiers($id) { delete_classifiers("entity", $id); }
function delete_metadata_classifiers($id) { delete_classifiers("metadata", $id); }
function delete_annotation_classifiers($id) { delete_classifiers("annotation", $id); }
function delete_river_classifiers($id) { delete_classifiers("river", $id); }
function delete_system_log_classifiers($id) { delete_classifiers("system_log", $id); }

/**
 * @return Qlyfe_CList object
 */
function select_classifiers($type, $id) {
	global $CONFIG;
	$clist = new Qlyfe_CList();
	$id_name = $type == "entity" ? "guid" : "id";
	$query = "SELECT network, classifier FROM {$CONFIG->dbprefix}classifiers WHERE 
		type = '{$type}' AND id=$id";
	$result = get_data($query);
	if ($result) {
		foreach ($result as $row) {
			$network = $row->network;
			$classifier = $row->classifier;
			// @todo QLYFE BAP .. put this into the clist add method
			if ($classifier == null)
				$clist->add($row->network);
			else
				$clist->add($row->network . "/" . $row->classifier);
		}
	}
	return $clist;
}
function select_entity_classifiers($id) { return select_classifiers("entity", $id); }
function select_metadata_classifiers($id) { return select_classifiers("metadata", $id); }
function select_annotation_classifiers($id) { return select_classifiers("annotation", $id); }
function select_river_classifiers($id) { return select_classifiers("river", $id); }
function select_system_log_classifiers($id) { return select_classifiers("system_log", $id); }

/**
 * Call this if you're deleting a classifier
 * @param unknown_type $owner_guid
 * @param unknown_type $network
 * @param unknown_type $classifier
 */
function de_classify($owner_guid, $network, $classifier) {
	de_classify_by_type("entity", $owner_guid, $network, $classifier);
	de_classify_by_type("metadata", $owner_guid, $network, $classifier);
	de_classify_by_type("annotation", $owner_guid, $network, $classifier);
//	de_classify_by_type("river", $owner_guid, $network, $classifier);
	de_classify_by_type("system_log", $owner_guid, $network, $classifier);
}
function de_classify_by_type($type, $owner_guid, $network, $classifier) {
	global $CONFIG;
	
	$id = ($type == "entity" ? "guid" : "id");
	$table = ($type == "entity" ? "entities" : $type);
	$table = ($type == "annotation" ? "annotations" : $table);
	
	$query = "DELETE FROM {$CONFIG->dbprefix}classifiers " .
		"WHERE type='$type' AND network='$network' AND classifier='$classifier' ".
		"AND id in (select t.$id FROM {$CONFIG->dbprefix}{$table} t WHERE t.owner_guid = $owner_guid)";
	delete_data($query);
}
/**
 * Call this if you're renaming a classifier
 * @param unknown_type $owner_guid
 * @param unknown_type $network
 * @param unknown_type $old_classifier
 * @param unknown_type $old_classifier
 */
function re_classify($owner_guid, $network, $old_classifier, $new_classifier) {
	re_classify_by_type("entity", $owner_guid, $network, $old_classifier, $new_classifier);
	re_classify_by_type("metadata", $owner_guid, $network, $old_classifier, $new_classifier);
	re_classify_by_type("annotation", $owner_guid, $network, $old_classifier, $new_classifier);
//	re_classify_by_type("river", $owner_guid, $network, $old_classifier, $new_classifier);
	re_classify_by_type("system_log", $owner_guid, $network, $old_classifier, $new_classifier);
}
function re_classify_by_type($type, $owner_guid, $network, $old_classifier, $new_classifier) {
	global $CONFIG;
	
	$id = ($type == "entity" ? "guid" : "id");
	$table = ($type == "entity" ? "entities" : $type);
	$table = ($type == "annotation" ? "annotations" : $table);
	
	$query = "UPDATE {$CONFIG->dbprefix}classifiers SET classifier='$new_classifier'" .
		" WHERE type='$type' AND network='$network' AND classifier='$classifier' ".
		" AND id in (select t.$id FROM {$CONFIG->dbprefix}{$table} t WHERE t.owner_guid = $owner_guid)";
	update_data($query);
}

/**
 * @qlyfe addition this is the heart of our access changes
 * 
 * Add access restriction sql code to a given query.
 * Note that if this code is executed in privileged mode it will return blank.
 *
 * @param string $type the type of the object we're getting (entity, metadata, annotation)
 * @param string $table_prefix Optional table. prefix for the access code.
 * @param int $owner
 */
function get_access_sql_suffix($type, $table_prefix = '', $looker = null) {
	global $ENTITY_SHOW_HIDDEN_OVERRIDE, $CONFIG;

	$sql = "";
	$friends_bit = "";
	$enemies_bit = "";
	
	$id = $type == "entity" ? "guid" : "id";
	
	$cls = "cls";
	$rel = "rel";
	
	// sanitise our table prefix
	if ($table_prefix) 
	{
		$table_prefix = sanitise_string($table_prefix);
		$cls = "cls" . $table_prefix;
		$rel = "rel" . $table_prefix;
		$table_prefix .= ".";
	}
	
	// make sure it's not one we need
	if ($talbe_prefix == "cls" || $table_prefix == "rel") 
		throw new DatabaseException("We need that table prefix " . $table_prefix);

	// set our looker to the logged in user if it's not set
	if (!isset($looker)) $looker = get_loggedin_userid();
	
	$ignore_access = elgg_check_access_overrides($looker);
	//$access = get_access_list($looker);

	// if we have super-access then just return a catch-all sql
	if ($ignore_access) {
		$sql = " (1 = 1) ";
		
	} else if ($looker != 0) {

		// looker is who is looking for this data = 2 this case
		// guid is what are we looking at = 1 in this case
		// owner_guid refers to the owner of guid 1
		// so we need to know 
		//    1. is the owner and the looker the same person? (line 1)
		//			owner_guid = looker
		//    2. is this guid a 'public' object? (line 2)
		// 			exists (select * from qlyfe_entity_classifiers cls where cls.entity_guid = guid and cls.network = 'public'
		//    3. taking the relationship between the owner and the looker 
		//       is that relationship in the list of relationships approved for this guid? (lines 3-7)
		//       meaning in db language
		//       	is their a relationship between these two on the same network (with a null class)
		// 			or on the same network with the same class
		//			
		//			exists (select * from qlyfe_entity_relationships rel, qlyfe_entity_classifiers cls WHERE
		//						rel.guid_one = owner_guid and rel.guid_two = looker AND
		//						cls.entity_guid = guid AND
		//						rel.network = cls.network AND
		//						(cls.classifier is null OR cls.classifier = rel.classifier) )
		//
		//
		$sql = "(
		  	({$table_prefix}owner_guid = {$looker}) OR 
			(exists (select * from {$CONFIG->dbprefix}classifiers {$cls} where {$cls}.id = {$table_prefix}{$id} and {$cls}.type = '{$type}' and {$cls}.network = 'public')) OR
			(exists (select * from {$CONFIG->dbprefix}entity_relationships {$rel}, {$CONFIG->dbprefix}classifiers {$cls} WHERE			
						{$rel}.guid_one = {$table_prefix}owner_guid and {$rel}.guid_two = $looker AND
						{$cls}.type = '{$type}' AND 
						{$cls}.id = {$table_prefix}{$id} AND
						{$rel}.network = {$cls}.network AND
					({$cls}.classifier is null OR {$cls}.classifier = {$rel}.classifier) ) )
		)";
						
		
	} else {
		// no looker, so we just need to check if this is a public object
		// exists (select * from qlyfe_entity_classifiers cls where cls.entity_guid = guid and cls.network = 'public'
		$sql = "exists (select * from {$CONFIG->dbprefix}classifiers {$cls} WHERE  
				{$cls}.id = {$table_prefix}{$id} AND 
				{$cls}.type = '{$type}' AND 
				{$cls}.network = 'public')";
	}


	if (!$ENTITY_SHOW_HIDDEN_OVERRIDE)
		$sql .= " and {$table_prefix}enabled='yes'";
	return '('.$sql.')';
}

/**
 * Determines whether the given user has access to the given entity
 *
 * @param ElggEntity $entity The entity to check access for.
 * @param ElggUser $user Optionally the user to check access for.
 *
 * @return boolean True if the user can access the entity
 */
function has_access_to_entity($entity, $user = null) {
	global $CONFIG;

	if (!isset($user)) {
		$access_bit = get_entity_access_sql_suffix("e");
	} else {
		$access_bit = get_entity_access_sql_suffix("e", $user->getGUID());
	}

	$query = "SELECT guid from {$CONFIG->dbprefix}entities e WHERE e.guid = " . $entity->getGUID();
	$query .= " AND " . $access_bit; // Add access controls
	if (get_data($query)) {
		return true;
	} else {
		return false;
	}
}

/**
 * Returns an array of access permissions that the specified user is allowed to save objects with.
 * Permissions are of the form ('id' => 'Description')
 *
 * @param int $user_id The user's GUID.
 * @param int $site_id The current site.
 * @param true|false $flush If this is set to true, this will shun any cached version
 *
 * @return array List of access permissions
 * 
 * NEVER SHOULD BE USED... deprecated with NOP 
function get_write_access_array($user_id = 0, $site_id = 0, $flush = false) {
	global $CONFIG;
	//@todo this is probably not needed since caching happens at the DB level.
	static $access_array;

	if ($user_id == 0) {
		$user_id = get_loggedin_userid();
	}

	if (($site_id == 0) && (isset($CONFIG->site_id))) {
		$site_id = $CONFIG->site_id;
	}

	$user_id = (int) $user_id;
	$site_id = (int) $site_id;

	if (empty($access_array[$user_id]) || $flush == true) {
		$query = "SELECT ag.* FROM {$CONFIG->dbprefix}access_collections ag ";
		$query .= " WHERE (ag.site_guid = {$site_id} OR ag.site_guid = 0)";
		$query .= " AND (ag.owner_guid = {$user_id})";
		$query .= " AND ag.id >= 3";

		$tmp_access_array = array(	ACCESS_PRIVATE => elgg_echo("PRIVATE"),
									ACCESS_FRIENDS => elgg_echo("access:friends:label"),
									ACCESS_LOGGED_IN => elgg_echo("LOGGED_IN"),
									ACCESS_PUBLIC => elgg_echo("PUBLIC"));
		if ($collections = get_data($query)) {
			foreach($collections as $collection) {
				$tmp_access_array[$collection->id] = $collection->name;
			}
		}

		$access_array[$user_id] = $tmp_access_array;
	} else {
		$tmp_access_array = $access_array[$user_id];
	}

	$tmp_access_array = trigger_plugin_hook('access:collections:write','user',array('user_id' => $user_id, 'site_id' => $site_id),$tmp_access_array);

	return $tmp_access_array;
}
 */

/**
 * Creates a new access control collection owned by the specified user.
 *
 * @param string $name The name of the collection.
 * @param int $owner_guid The GUID of the owner (default: currently logged in user).
 * @param int $site_guid The GUID of the site (default: current site).
 *
 * @return int|false Depending on success (the collection ID if successful).
 */
function create_access_collection($name, $owner_guid = 0, $site_guid = 0) {
	global $CONFIG;

	$name = trim($name);
	if (empty($name)) {
		return false;
	}

	if ($owner_guid == 0) {
		$owner_guid = get_loggedin_userid();
	}
	if (($site_guid == 0) && (isset($CONFIG->site_guid))) {
		$site_guid = $CONFIG->site_guid;
	}
	$name = sanitise_string($name);

	$q = "INSERT INTO {$CONFIG->dbprefix}access_collections
		SET name = '{$name}',
			owner_guid = {$owner_guid},
			site_guid = {$site_guid}";
	if (!$id = insert_data($q)) {
		return false;
	}

	$params = array(
		'collection_id' => $id
	);

	if (!trigger_plugin_hook('access:collections:addcollection', 'collection', $params, true)) {
		return false;
	}

	return $id;
}

/**
 * Updates the membership in an access collection.
 *
 * @param int $collection_id The ID of the collection.
 * @param array $members Array of member GUIDs
 * @return true|false Depending on success
 */
function update_access_collection($collection_id, $members) {
	global $CONFIG;

	$collection_id = (int) $collection_id;
	$members = (is_array($members)) ? $members : array();

	$collections = get_write_access_array();

	if (array_key_exists($collection_id, $collections)) {
		$cur_members = get_members_of_access_collection($collection_id, true);
		$cur_members = (is_array($cur_members)) ? $cur_members : array();

		$remove_members = array_diff($cur_members, $members);
		$add_members = array_diff($members, $cur_members);

		$params = array(
			'collection_id' => $collection_id,
			'members' => $members,
			'add_members' => $add_members,
			'remove_members' => $remove_members
		);

		foreach ($add_members as $guid) {
			add_user_to_access_collection($guid, $collection_id);
		}

		foreach ($remove_members as $guid) {
			remove_user_from_access_collection($guid, $collection_id);
		}

		return true;
	}

	return false;
}

/**
 * Deletes a specified access collection
 *
 * @param int $collection_id The collection ID
 * @return true|false Depending on success
 */
function delete_access_collection($collection_id) {

	$collection_id = (int) $collection_id;
	//$collections = get_write_access_array(null, null, TRUE);
	//$params = array('collection_id' => $collection_id);

	//if (!trigger_plugin_hook('access:collections:deletecollection', 'collection', $params, true)) {
	//	return false;
	//}

	//if (array_key_exists($collection_id, $collections)) {
		global $CONFIG;
		//delete_data("delete from {$CONFIG->dbprefix}access_collection_membership where access_collection_id = {$collection_id}");
		delete_data("delete from {$CONFIG->dbprefix}access_collections where id = {$collection_id}");
		return true;

}

/**
 * Get a specified access collection
 *
 * @param int $collection_id The collection ID
 * @return array|false Depending on success
 */
function get_access_collection($collection_id) {
	global $CONFIG;
	$collection_id = (int) $collection_id;

	$get_collection = get_data_row("SELECT * FROM {$CONFIG->dbprefix}access_collections WHERE id = {$collection_id}");

	return $get_collection;
}

/**
 * Adds a user to the specified user collection
 *
 * @param int $user_guid The GUID of the user to add
 * @param int $collection_id The ID of the collection to add them to
 * @return true|false Depending on success
 */
function add_user_to_access_collection($user_guid, $collection_id) {
	$collection_id = (int) $collection_id;
	$user_guid = (int) $user_guid;
	$collections = get_write_access_array();

	if (!($collection = get_access_collection($collection_id)))
		return false;

	if ((array_key_exists($collection_id, $collections) || $collection->owner_guid == 0)
			&& $user = get_user($user_guid)) {
		global $CONFIG;

		$params = array(
			'collection_id' => $collection_id,
			'user_guid' => $user_guid
		);

		if (!trigger_plugin_hook('access:collections:add_user', 'collection', $params, true)) {
			return false;
		}

		try {
			insert_data("insert into {$CONFIG->dbprefix}access_collection_membership set access_collection_id = {$collection_id}, user_guid = {$user_guid}");
		} catch (DatabaseException $e) {
			// nothing.
		}
		return true;

	}

	return false;
}

/**
 * Removes a user from an access collection
 *
 * @param int $user_guid The user GUID
 * @param int $collection_id The access collection ID
 * @return true|false Depending on success
 */
function remove_user_from_access_collection($user_guid, $collection_id) {
	$collection_id = (int) $collection_id;
	$user_guid = (int) $user_guid;
	$collections = get_write_access_array();

	if (!($collection = get_access_collection($collection_id)))
		return false;

	if ((array_key_exists($collection_id, $collections) || $collection->owner_guid == 0) && $user = get_user($user_guid)) {
		global $CONFIG;
		$params = array(
			'collection_id' => $collection_id,
			'user_guid' => $user_guid
		);

		if (!trigger_plugin_hook('access:collections:remove_user', 'collection', $params, true)) {
			return false;
		}

		delete_data("delete from {$CONFIG->dbprefix}access_collection_membership where access_collection_id = {$collection_id} and user_guid = {$user_guid}");
		return true;

	}

	return false;
}

/**
 * Get all of a users collections
 *
 * @param int $owner_guid The user ID
 * @param int $site_guid The GUID of the site (default: current site).
 * @return true|false Depending on success
 */
function get_user_access_collections($owner_guid, $site_guid = 0) {
	global $CONFIG;
	$owner_guid = (int) $owner_guid;
	$site_guid = (int) $site_guid;

	if (($site_guid == 0) && (isset($CONFIG->site_guid))) {
		$site_guid = $CONFIG->site_guid;
	}

	$query = "SELECT * FROM {$CONFIG->dbprefix}access_collections
			WHERE owner_guid = {$owner_guid}
			AND site_guid = {$site_guid}";
	

	$collections = get_data($query);

	return $collections;
}

/**
 * Get all of members of a friend collection
 *
 * @param int $collection The collection's ID
 * @param true|false $idonly If set to true, will only return the members' IDs (default: false)
 * @return ElggUser entities if successful, false if not
 */
function get_members_of_access_collection($collection, $idonly = false) {
	global $CONFIG;
	$collection = (int)$collection;

	if (!$idonly) {
		$query = "SELECT e.* FROM {$CONFIG->dbprefix}access_collection_membership m JOIN {$CONFIG->dbprefix}entities e ON e.guid = m.user_guid WHERE m.access_collection_id = {$collection}";
		$collection_members = get_data($query, "entity_row_to_elggstar");
	} else {
		$query = "SELECT e.guid FROM {$CONFIG->dbprefix}access_collection_membership m JOIN {$CONFIG->dbprefix}entities e ON e.guid = m.user_guid WHERE m.access_collection_id = {$collection}";
		$collection_members = get_data($query);
		foreach($collection_members as $key => $val) {
			$collection_members[$key] = $val->guid;
		}
	}

	return $collection_members;
}

/**
 * Displays a user's access collections, using the friends/collections view
 *
 * @param int $owner_guid The GUID of the owning user
 * @return string A formatted rendition of the collections
 */
function elgg_view_access_collections($owner_guid) {
	if ($collections = get_user_access_collections($owner_guid)) {
		foreach($collections as $key => $collection) {
			$collections[$key]->members = get_members_of_access_collection($collection->id, true);
			$collections[$key]->entities = get_user_friends($owner_guid,"",9999);
		}
	}

	return elgg_view('friends/collections',array('collections' => $collections));
}

/**
 * Get entities with the specified access collection id.
 *
 * @deprecated 1.7. Use elgg_get_entities_from_access_id()
 *
 * @param $collection_id
 * @param $entity_type
 * @param $entity_subtype
 * @param $owner_guid
 * @param $limit
 * @param $offset
 * @param $order_by
 * @param $site_guid
 * @param $count
 * @return unknown_type
 */
function get_entities_from_access_id($collection_id, $entity_type = "", $entity_subtype = "", $owner_guid = 0, $limit = 10, $offset = 0, $order_by = "", $site_guid = 0, $count = false) {
	// log deprecated warning
	elgg_deprecated_notice('get_entities_from_access_id() was deprecated by elgg_get_entities()!', 1.7);

	if (!$collection_id) {
		return FALSE;
	}

	// build the options using given parameters
	$options = array();
	$options['limit'] = $limit;
	$options['offset'] = $offset;
	$options['count'] = $count;

	if ($entity_type) {
		$options['type'] = sanitise_string($entity_type);
	}

	if ($entity_subtype) {
		$options['subtype'] = $entity_subtype;
	}

	if ($site_guid) {
		$options['site_guid'] = $site_guid;
	}

	if ($order_by) {
		$options['order_by'] = sanitise_string("e.time_created, $order_by");
	}

	if ((is_array($owner_guid) && (count($owner_guid)))) {
		$options['owner_guids'] = array();
		foreach($owner_guid as $guid) {
			$options['owner_guids'][] = $guid;
		}
	}

	if ($site_guid) {
		$options['site_guid'] = $site_guid;
	}

	$options['access_id'] = $collection_id;

	return elgg_get_entities_from_access_id($options);
}

/**
 * Retrieve entities for a given access collection
 *
 * @param int $collection_id
 * @param array $options @see elgg_get_entities()
 * @return array
 * @since 1.7
 */
function elgg_get_entities_from_access_id(array $options=array()) {
	// restrict the resultset to access collection provided
	if (!isset($options['access_id'])) {
		return FALSE;
	}

	// @todo add support for an array of collection_ids
	$where = "e.access_id = '{$options['access_id']}'";
	if (isset($options['wheres'])) {
		if (is_array($options['wheres'])) {
			$options['wheres'][] = $where;
		} else {
			$options['wheres'] = array($options['wheres'], $where);
		}
	} else {
		$options['wheres'] = array($where);
	}

	// return entities with the desired options
	return elgg_get_entities($options);
}

/**
 * Lists entities from an access collection
 *
 * @param $collection_id
 * @param $entity_type
 * @param $entity_subtype
 * @param $owner_guid
 * @param $limit
 * @param $fullview
 * @param $viewtypetoggle
 * @param $pagination
 * @return str
 */
function list_entities_from_access_id($collection_id, $entity_type = "", $entity_subtype = "", $owner_guid = 0, $limit = 10, $fullview = true, $viewtypetoggle = true, $pagination = true) {
	$offset = (int) get_input('offset');
	$limit = (int) $limit;
	$count = get_entities_from_access_id($collection_id, $entity_type, $entity_subtype, $owner_guid, $limit, $offset, "", 0, true);
	$entities = get_entities_from_access_id($collection_id, $entity_type, $entity_subtype, $owner_guid, $limit, $offset, "", 0, false);

	return elgg_view_entity_list($entities, $count, $offset, $limit, $fullview, $viewtypetoggle, $pagination);
}

/**
 * Return a humanreadable version of an entity's access level
 *
 * @param $entity_accessid (int) The entity's access id
 * @return string e.g. Public, Private etc
 **/
function get_readable_access_level($entity_accessid){
	$access = (int) $entity_accessid;
	//get the access level for object in readable string
	$options = get_write_access_array();
	foreach($options as $key => $option) {
		if($key == $access){
			$entity_acl = htmlentities($option, ENT_QUOTES, 'UTF-8');
			return $entity_acl;
			break;
		}
	}
	return false;
}

/**
 * Set if entity access system should be ignored.
 *
 * @return bool Previous ignore_access setting.
 */
function elgg_set_ignore_access($ignore = true) {
	$elgg_access = elgg_get_access_object();
	return $elgg_access->set_ignore_access($ignore);
}

/**
 * Get current ignore access setting.
 *
 * @return bool
 */
function elgg_get_ignore_access() {
	return elgg_get_access_object()->get_ignore_access();
}

/**
 * Decides if the access system is being ignored.
 *
 * @return bool
 */
function elgg_check_access_overrides($user_guid = null) {
	if (!$user_guid || $user_guid <= 0) {
		$is_admin = false;
	} else {
		$is_admin = elgg_is_admin_user($user_guid);
	}

	return ($is_admin || elgg_get_ignore_access());
}

/**
 * Returns the ElggAccess object.
 *
 * @return ElggAccess
 */
function elgg_get_access_object() {
	static $elgg_access;

	if (!$elgg_access) {
		$elgg_access = new ElggAccess();
	}

	return $elgg_access;
}

global $init_finished;
$init_finished = false;

/**
 * A quick and dirty way to make sure the access permissions have been correctly set up
 *
 */
function access_init() {
	global $init_finished;
	$init_finished = true;
}

/**
 * Override permissions system
 *
 * @return true|null
 */
function elgg_override_permissions_hook($hook, $type, $returnval, $params) {
	$user_guid = get_loggedin_userid();

	// check for admin
	if ($user_guid && elgg_is_admin_user($user_guid)) {
		return true;
	}

	// check access overrides
	if ((elgg_check_access_overrides($user_guid))) {
		return true;
	}

	// consult other hooks
	return NULL;
}

// This function will let us know when 'init' has finished
register_elgg_event_handler('init', 'system', 'access_init', 9999);

// For overrided permissions
register_plugin_hook('permissions_check', 'all', 'elgg_override_permissions_hook');
register_plugin_hook('container_permissions_check', 'all', 'elgg_override_permissions_hook');
