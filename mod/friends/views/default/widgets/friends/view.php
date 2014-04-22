<?php

    /**
	 * List of Friends widget
	 */

    //the page owner
	$owner = get_user($vars['entity']->owner_guid);

    //the number of files to display
	$max = (int) $vars['entity']->num_display;
	if (!$max)
		$max = 9;
		
	//get the correct size
	$size = (int) $vars['entity']->icon_size;
	if (!$size || $size == 1){
		$size_value = "small";
	} else {
		$size_value = "tiny";
	}
	
	function print_friends_by_classifier($max, $num_printed, $owner, Qlyfe_Classifier $classifier, $size_value, $current, $name = null, $id = null)
	{
		global $CONFIG;
		$url = $CONFIG->site->url;
	    // Get the users friends by classifier
		$friends = $owner->getConnectedTo("", $max, $offset = 0, $classifier);
				
		
		// If there are any $friend to view, view them
		if (is_array($friends) && sizeof($friends) > 0) {
	
			if ($num_printed == 0) echo "<div id='vertical_tabs_topline'></div>";
			$class = $current ? "vertical_tab_current" : "vertical_tab";
			echo "<div class='$class'>";
				
			if (!$name) $name = elgg_echo("classifier:" . $classifier);
			$encoded = urlencode($classifier->classifier);

			// here is where we write the CONTEXTUAL MENU
			// position:relative is so the absolutely positioned stuff inside know where to go
			/*
			echo "<div style='text-align:center;position:relative;'>";
				$submenu_id = js_friendly_classifier($classifier->__toString());
	
				$menu_activator = elgg_view("contextual_menu/activator", array("id"=>$submenu_id, "target"=>"+"));
				$menu_items[] = elgg_view("contextual_menu/item", array("id"=>$submenu_id, "href"=>"/pg/connections/{$owner->username}/{$encoded}", "text"=>elgg_echo("friends:contextmenu:list")));
				
				if ($id) {
					$menu_items[] = elgg_view("contextual_menu/item", array("id"=>$submenu_id, "href"=>"javascript:editCircle($id, \"$name\")", "text"=>elgg_echo("friends:contextmenu:edit")));
					$menu_items[] = elgg_view("contextual_menu/item", array("id"=>$submenu_id, "href"=>"javascript:deleteCircle($id, \"$name\")", "text"=>elgg_echo("friends:contextmenu:delete")));
				}
				echo elgg_view("contextual_menu/menu", array("id"=>$submenu_id, "activator"=>$menu_activator, "items"=>$menu_items));
				// END CONTEXTUAL MENU
				
				// here is the actual TAB NAME
			echo "</div>";
			*/
				echo "<a href='{$url}pg/friends/{$encoded}'><span>" . $name . "</span></a>";
			
			if ($current) {
				echo "<div class='vertical_tab_items'>";
				foreach($friends as $friend) {
					echo "<div class=\"widget_friends_singlefriend\" >";
					echo elgg_view("profile/icon",array('entity' => get_user($friend->guid), 'size' => $size_value));
					echo "</div>";
				}
				echo "</div>";
				
				echo "<div class='vertical_tab_links'>";				
				echo "<a href='/pg/connections/{$owner->username}/{$encoded}'>" . elgg_echo("friends:contextlinks:list") . "</a>";
				if ($id) {
					echo "<a href='javascript:editCircle($id, \"$name\")'>" . elgg_echo("friends:contextlinks:edit") . "</a>";
					echo "<a href='javascript:deleteCircle($id, \"$name\")'>" . elgg_echo("friends:contextlinks:delete") . "</a>";
				}
				echo "</div>";
			}
			echo "</div>";
			return 1;
	    } else {
	    	return 0;
	    }
	}
		
	echo "<div class='vertical_tabs_wrapper'>";
	$num_printed = 0;
	
	$num_printed += print_friends_by_classifier($max, $num_printed, $owner, new Qlyfe_Classifier("friends"), $size_value, on_sub_context(""));
	$num_printed += print_friends_by_classifier($max, $num_printed, $owner, new Qlyfe_Classifier("friends/bf"), $size_value, on_sub_context("bf"));
	$num_printed += print_friends_by_classifier($max, $num_printed, $owner, new Qlyfe_Classifier("friends/f"), $size_value, on_sub_context("f"));
	$num_printed += print_friends_by_classifier($max, $num_printed, $owner, new Qlyfe_Classifier("friends/a"), $size_value, on_sub_context("a"));

	$circles = get_user_access_collections(get_loggedin_userid());
	foreach ($circles as $circle) {
		$num_printed += print_friends_by_classifier($max, $num_printed, $owner, new Qlyfe_Classifier("friends/" . $circle->name), $size_value, on_sub_context($circle->name), $circle->name, $circle->id);
	}

	$friends = $owner->getConnectedTo("", 1, 0, "friends");
	// if we have friends shoow the friends circle dialog
	if (is_array($friends) && sizeof($friends) > 0)
	{	
		echo "<div class='vertical_tab'>";
		echo "<a href='javascript:friendsCircleDialog()'><span style='font-color:#ccc;font-size:8pt;'>+ " . elgg_echo("friends:circle:create").  "</span></a>";
		echo "</div>";
	}	
	echo "</div>";
?>
	<div id="create-friends-circle" title="<?php echo elgg_echo("friends:circle:create"); ?>" style="display:none;">
		<center><img style='margin-top:100px;' src="/_graphics/ajax_loader.gif"/></center>
	</div>