<?php

	/**
	 * Elgg signupwizard index
	 * 
	 * @package Elggsignupwizard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	// Get the Elgg engine
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

		$body = "";
		
	// Try and get the user from the username and set the page body accordingly
		if ($user = $_SESSION['user']) {
			
			if ($user->isBanned() && !isadminloggedin()) {
				forward(); exit;
			}
			
	//		$body = elgg_view_entity($user,true);
	
			$body = elgg_view("signupwizard/invite");

			$title = $user->name;

			$body = elgg_view_layout('',$body);
			
		} else {
			
			$body = elgg_echo("signupwizard:notfound");
			$title = elgg_echo("signupwizard");
			
		}

		page_draw($title, $body);
		
?>