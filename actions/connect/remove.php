<?php
/**
 * Elgg remove friend action
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */

// Ensure we are logged in
gatekeeper();

if (validate_action_token()) {

	// Get the GUID of the user to friend
	$guid = get_input('guid');
	$user = get_entity($guid);
	$errors = false;
	
	// Get the user
	try{
		if ($user instanceof ElggUser) {
			$_SESSION['user']->disconnectFrom($guid);
		} else{
			register_error(sprintf(elgg_echo("connect:break:failure"), $user->name));
			$errors = true;
		}
	} catch (Exception $e) {
		register_error(sprintf(elgg_echo("connect:break:failure"), $user->name));
		$errors = true;
	}
	
	if (!$errors) {
		system_message(sprintf(elgg_echo("connect:break:successful"), $user->name));
	}
}

// Forward back to the page you made the friend on
forward($_SERVER['HTTP_REFERER']);
