<?php 
//	$current_context = get_context();
	$url = $vars['url'];
	$page = get_input('page');
	$arr = split('/',$page);
	$username = $_SESSION['user']->username;

	$class = ($arr[0] == "inbox") ? "class='current_small_tab'" : "";
	echo "<li ><a $class href='{$url}pg/messages/inbox'><span>Inbox</span></a></li>";

	$class = ($arr[0] == "outbox") ? "class='current_small_tab'" : "";
	echo "<li ><a $class href='{$url}pg/messages/outbox'><span>Outbox</span></a></li>";

	$class = ($arr[0] == "new") ? "class='current_small_tab'" : "";
	echo "<li ><a $class href='{$url}pg/messages/new'><span>New Message</span></a></li>";

?>