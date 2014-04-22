<?php

	/**
	 * Elgg upload new signupwizard icon
	 * 
	 * @package Elggsignupwizard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	// Load the Elgg framework
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
	// Make sure we're logged in
	if (!isloggedin()) {
		forward();
	}

	// Get owner of signupwizard - set in page handler
	$user = $_SESSION['user'];
	if (!$user) {
		register_error(elgg_echo("signupwizard:notfound"));
		forward();
	}

	// check if logged in user can edit this signupwizard icon
	if (!$user->canEdit()) {
		register_error(elgg_echo("signupwizard:icon:noaccess"));
		forward();
	}
	

	$area2 .= elgg_view("profile/addicon", array('entity' => $user,"actionurl"=>"signupwizard"));
	
	// Get the form and correct canvas area
	$body = elgg_view_layout("", '', $area2);
	
	// Draw the page
	page_draw(elgg_echo("profile:addicon"), $body);
