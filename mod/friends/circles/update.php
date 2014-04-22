<?php 


	$id = get_input("id");
	$name = trim(get_input("name"));
	$share = get_input("share");
	$users = get_input("users");
	
	$old_collection = get_access_collection($id);
	//error_log("update $id $name $users {$old_collection->name}");
	
	//forward($vars['url']."pg/friends/" . urlencode($name));
	//return;
	
	if (empty($users)) {
		register_error(elgg_echo("friends:circle:error:nousers"));
		forward($vars['url']."pg/friends");
		return;
	}
	
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
	
	delete_friends_circle($id, $old_collection->name);
	re_classify(get_loggedin_userid(), "friends", $old_collection->name, $name);

	$collection_id = create_access_collection($name);
	$user = get_loggedin_user();
	$users = explode(",", $users);
	foreach ($users as $user_guid) {
		if ($user && $user_guid) {
			//error_log("$user connect to $user_guid as $name");
			$user->connectTo($user_guid, "friend", "friends/$name");
		}
	}
	system_message(sprintf(elgg_echo('friends:circle:successfully_updated'), $name));
	forward($vars['url']."pg/friends/" . urlencode($name));
