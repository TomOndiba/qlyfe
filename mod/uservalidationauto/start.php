<?php
/**
 * Email user validation plugin.
 * Non-admin or admin created accounts are invalid until their email address is confirmed.
 *
 * @package ElggUserValidationByEmail
 * @author Curverider Ltd
 * @link http://elgg.com/
 */

function uservalidationauto_init() {
	global $CONFIG;

	// Register hook listening to new users.
	register_elgg_event_handler('create', 'user', 'uservalidationauto_validate');
	register_elgg_event_handler('validate', 'user', 'uservalidationauto_validate');
}

/**
 * Request email validation.
 */
function uservalidationauto_validate($event, $object_type, $object) {
	
	// temporarily change access permissions so we can update the user info.
	$access_status = access_get_show_hidden_status();
	access_show_hidden_entities(true);
	
	enable_entity($object->guid); // $object->enable() .. .don't want to bother testing this agian though
	set_user_validation_status($object->guid, true);
	
	access_show_hidden_entities($access_status);
	
	return true;
}

// Initialise
register_elgg_event_handler('init', 'system', 'uservalidationauto_init');