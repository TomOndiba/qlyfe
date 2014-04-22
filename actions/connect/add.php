<?php
/**
 * Elgg add friend action
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */

// Ensure we are logged in
gatekeeper();

if (validate_action_token())
{

	// Get the GUID of the user to friend
	$connect_to = get_input('guid');
	$errors = "";
	$entity = get_entity($connect_to);
	$success = "";
	
	// @todo QLYFE BAP .. make this a plugin type thing
	$networks = explode(",",get_input("networks"));	
	
	// first try friends
	if (in_array("friends", $networks)) {
	
		$friends_clist = get_input('friends_clist');
		// Get the user
		try {
			if (!$_SESSION['user']->connectTo($connect_to, 'friend', $friends_clist)) {
				$errors .= sprintf(elgg_echo("friends:add:failure"),$entity->name) . "<br/>";
			} else {
				add_to_river('friends/river/create','friend',$_SESSION['user']->guid,$connect_to);
				$success .= sprintf(elgg_echo("friends:add:successful"),$entity->name) . "<br/>";
			}
		} catch (Exception $e) {
			error_log($e);
			$errors .= sprintf(elgg_echo("friends:add:failure"),$entity->name) . "<br/>";
		}
	} 
	
	// don't do else if because we can have two relationships
	if (in_array("family", $networks)) {
		
		$family_clist = get_input('family_clist');
		$family_relationship = get_input('family_relationship');
		
		//error_log("connect as family $family_clist $family_relationship");
		
		// Get the user
		try {
			if (!$_SESSION['user']->connectTo($connect_to, $family_relationship, $family_clist)) {
				$errors .= sprintf(elgg_echo("family:add:failure"),$entity->name) . "<br/>";
			} else {
				add_to_river('friends/river/create','family',$_SESSION['user']->guid,$connect_to);
				$success .= sprintf(elgg_echo("family:add:successful"),$entity->name) . "<br/>";
			}
		} catch (Exception $e) {
			error_log($e);
			$errors .= sprintf(elgg_echo("family:add:failure"),$entity->name) . "<br/>";
		}
	}
	
	if ($errors) {
		register_error($errors);
	}
}
// Forward back to the page you friended the user on
forward($_SERVER['HTTP_REFERER']);
