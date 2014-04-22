<?php

	/**
	 * Elgg signupwizard editor
	 * 
	 * @package Elggsignupwizard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	// Get the Elgg engine
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	// If we're not logged on, forward the user elsewhere
	if (!isloggedin()) {
		forward();
	}
	
	// Get owner of signupwizard - set in page handler
	$user = $_SESSION['user'];
	if (!$user) {
		register_error(elgg_echo("signupwizard:notfound"));
		forward();
	}

	// check if logged in user can edit this signupwizard
	if (!$user->canEdit()) {
		register_error(elgg_echo("signupwizard:noaccess"));
		forward();
	}
	
	// Get edit form
	$area2 = elgg_view_title(elgg_echo('signupwizard:importfriends'));
	$area2 .= elgg_view("signupwizard/importfriends",array('entity' => $user)); 
	
	$area1 = "";
	
	// get the required canvas area
	$body = elgg_view_layout("", $area1, $area2);
	
	// Draw the page
	page_draw(elgg_echo("signupwizard:importfriends"),$body);
