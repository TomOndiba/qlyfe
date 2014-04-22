<?php

    /**
	 * Family Widget
	 */

    //the page owner
	$owner = get_user($vars['entity']->owner_guid);

    //the number of files to display
	$num = (int) $vars['entity']->num_display;
	if (!$num)
		$num = 8;
		
	//get the correct size
	$size = (int) $vars['entity']->icon_size;
	if (!$size || $size == 1){
		$size_value = "small";
	}else{
    	$size_value = "tiny";
	}
	
	function print_family_by_classifier($owner, $classifier, $size_value, $current)
	{
		global $CONFIG;
		$url = $CONFIG->site->url;
		
		// Get the users close friends
		$friends = $owner->getConnectedTo("", $num, $offset = 0, $classifier);
				
		// If there are any $friend to view, view them
		if (is_array($friends) && sizeof($friends) > 0) {
	
			$class = $current ? "vertical_tab_current" : "vertical_tab";
			echo "<div class='$class'>";
			echo "<div class='vertical_tab_items'>";

			echo "<a href='{$url}pg/family/{$classifier->classifier}'><span>" . elgg_echo("classifier:" . $classifier) . "</span></a>";
		
			foreach($friends as $friend) {
				echo "<div class=\"widget_friends_singlefriend\" >";
				echo elgg_view("profile/icon",array('entity' => get_user($friend->guid), 'size' => $size_value));
				echo "</div>";
			}
	
			echo "</div>"; // end items
			
			echo "<div class='vertical_tab_links'>";				
			echo "<a href='/pg/connections/{$owner->username}/family'>" . elgg_echo("friends:contextlinks:list") . "</a>";
			echo "</div>";
		
			
			
			echo "</div>"; // end tab
				
	    }
	}
	
	echo "<div class='vertical_tabs_wrapper'>";
	echo "<div id='vertical_tabs_topline'></div>";
	print_family_by_classifier($owner, new Qlyfe_Classifier("family"), $size_value, true);
	echo "</div>"; // end wrapper
	/*
	print_family_by_classifier($owner, "family/immediate");
	print_family_by_classifier($owner, "family/children");
	print_family_by_classifier($owner, "family/moms_side");
	print_family_by_classifier($owner, "family/dads_side");
	print_family_by_classifier($owner, "family/partners_side");
	print_family_by_classifier($owner, "family/grandchildren");
	*/
?>