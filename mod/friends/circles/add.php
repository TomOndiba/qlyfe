<?php 
	$name = trim(get_input("name"));
	$share = get_input("share");
	$users = get_input("users");

	if (empty($users)) {
		register_error(elgg_echo("friends:circle:error:nousers"));
		forward($vars['url']."pg/friends");
		return;
	}
	
	$users = explode(",", $users);
	
	if ($name == "bf" || $name == "f" || $name == "a") {
		register_error(elgg_echo("friends:circle:error:reserved"));
		forward($vars['url']."pg/friends");
		return;
	} 
	
//	if (preg_match("/[a-zA-Z0-9_-' ]/",$name)) {
//		register_error(elgg_echo("friends:circle:error:badcharacters"));
//		forward($vars['url']."pg/friends");
//		return;
//	}
	
	if (empty($name)) {
		register_error(elgg_echo("friends:circle:error:empty"));
		forward($vars['url']."pg/friends");
		return;
	}
	
	// check to make sure it doesn't already exist
	$circles = get_user_access_collections(get_loggedin_userid());
	if ($circles) {
		foreach ($circles as $circle) {
			if ($circle->name == $name) {
				register_error(sprintf(elgg_echo("friends:circle:error:exists"), $name));
				forward($vars['url']."pg/friends");
				return;
			}
		}
	}
					
	$collection_id = create_access_collection($name);
	
	$user = get_loggedin_user();
	foreach ($users as $user_guid) {
		if ($user && $user_guid) {
			$user->connectTo($user_guid, "friend", "friends/$name");
		}
		//add_user_to_access_collection($user_guid, $collection_id);
	}
				
	system_message(sprintf(elgg_echo('friends:circle:successfully_created'), $name));
	forward($vars['url']."pg/friends/" . urlencode($name));
