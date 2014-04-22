<?php 
	global $vars;
	$username = $vars['user']->username;
	$context = get_context();
	$sub_context = get_sub_context();
	
	function print_friends_vertical_tab($username, $context, $sub_context, $classifier, $name = null) {
		$encoded = urlencode($classifier);
		$class = ($context == "friends" && $sub_context == $classifier) ? "vertical_tab_current" : "vertical_tab"; 
		if (!$name) $name = elgg_echo("classifier:friends" . ($classifier ? "/" : "") . $classifier);

		echo "<div class='$class'>";
		echo "<a href='/pg/connections/{$username}/friends/{$encoded}'><span>" . $name . "</span></a>";
		echo "</div>";
	}

	echo "<br/>";
	echo "<center><h3>" . elgg_echo('context:friends'). "</h3></center>";
	echo "<div id='vertical_tabs_topline'></div>";	
	print_friends_vertical_tab($username, $context, $sub_context, "");
	
	global $_SESSION;
	if ($_SESSION['user']->getGUID() == get_user_by_username($username)->guid) {
		print_friends_vertical_tab($username, $context, $sub_context, "bf");
		print_friends_vertical_tab($username, $context, $sub_context, "f");
		print_friends_vertical_tab($username, $context, $sub_context, "a");
	}
	
	$circles = get_user_access_collections(get_user_by_username($username)->guid);
	foreach ($circles as $circle) {
		print_friends_vertical_tab($username, $context, $sub_context, $circle->name, $circle->name);
	}
	