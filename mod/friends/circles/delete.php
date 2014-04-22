<?php 
	$id = get_input("id");
	$name = get_input("name");
	
	delete_friends_circle($id, $name);
	de_classify(get_loggedin_userid(), "friends", $name);
	
	system_message(sprintf(elgg_echo('friends:circle:successfully_deleted'), $name));
	forward($vars['url']."pg/friends");
?>