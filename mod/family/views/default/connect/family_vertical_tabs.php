<?php 
	global $vars;
	$username = $vars['user']->username;
	$context = get_context();
	$sub_context = get_sub_context();
	
	function print_family_vertical_tab($username, $context, $sub_context, $classifier, $name = null) {
		$encoded = urlencode($classifier);
		$class = ($context == "family" && $sub_context == $classifier) ? "vertical_tab_current" : "vertical_tab"; 
		if (!$name) $name = elgg_echo("classifier:family" . ($classifier ? "/" : "") . $classifier);

		echo "<div class='$class'>";
		echo "<a href='/pg/connections/{$username}/family/{$encoded}'><span>" . $name . "</span></a>";
		echo "</div>";
	}

	echo "<br/>";
	echo "<center><h3>" . elgg_echo('context:family'). "</h3></center>";
	echo "<div id='vertical_tabs_topline'></div>";	
	print_family_vertical_tab($username, $context, $sub_context, "");
	//print_family_vertical_tab($username, $context, $sub_context, "bf");
	//print_family_vertical_tab($username, $context, $sub_context, "f");
	//print_family_vertical_tab($username, $context, $sub_context, "a");