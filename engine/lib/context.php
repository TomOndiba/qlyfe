<?php
/**
 * @author brian
 * 
 * New for Qlyfe is the concept of context... actually Elgg has context but we are expanding
 * it.  What we want to do is have context dependant on plugins... for example:
 * 
 * 		Adding the friends plugin creates a new context for friends
 * 		Adding the family plugin ... well you get the idea
 * 		The default context will be "home"
 * 
 * 	When you add a new context you will define:
 * 		its name ie "friends"
 * 		what page it goes to .. hopefully just pg/friends 
 * 		language stuff like "context:friends" => "Friends"
 * 		layout/widget information so it knows which widgets to lay out within this context
 * 
 *   There is a sub-context that can be set (this would be like "moms_side") moms side of the family
 *   	This should not need to be pre-defined
 * 
 *   Note: some widgets may choose not to display based on the context/sub-context
 */

/**
 * Add this to our list of active networks.. .should only be called once per network
 */
function qlyfe_add_network($name) {
	global $CONFIG;
	if (!isset($CONFIG->networks))  $CONFIG->networks= array();
	$CONFIG->networks[] = $name;	
}


/**
 * @return a list of all currently active networks
 */
function qlyfe_get_networks() {
	global $CONFIG;
	if (!isset($CONFIG->networks))  $CONFIG->networks= array();
	
	// this makes it so public is the last network
	if (!in_array("public", $CONFIG->networks)) 
		$CONFIG->networks[] = "public";	
	
	return $CONFIG->networks;
}
	
/**
 * @param string $name (like "friends" or "work" or "neighborhood"
 * @param string $widgets three columns values each value is of the form
 * 		widget1::widget2::widget3 .. etc
 * 		each column separated by %%
 */
function qlyfe_add_context($name, $widgets) {
	global $CONFIG;

	if (!$CONFIG->context_map) {
		$CONFIG->context_map = array();
	}
	
	// plugins will add context.. this mean whoever DISPLAYS the context
	// needs to be the last plugin or at least after all other context adding plugins
	$CONFIG->context_map[$name] = $widgets;
	
	register_page_handler($name, "context_page_handler");
}

/**
 * @return an array of strings which are available contexts
 */
function qlyfe_get_context_array() {
	global $CONFIG;
	return array_keys($CONFIG->context_map);
}

/**
 * Get a list of widgets given our context .. in standard stupid widget format
 * @param string $context
 */
function qlyfe_get_widgets($context) {
	global $CONFIG;
	if (!isset($CONFIG->context_map[$context])) return "";
	return $CONFIG->context_map[$context];
}

function qlyfe_get_default_context_name() {
	return "home";
}

function qlyfe_get_submenu() {
	global $CONFIG;
	return $CONFIG->qlyfe_submenu;
}
function qlyfe_set_submenu($submenu) {
	global $CONFIG;
	return $CONFIG->qlyfe_submenu = $submenu;
}

/**
 * Sets the functional context of a page
 * THIS IS AN ELGG FUNCTION
 * @param string $context The context of the page
 * @return string|false Either the context string, or false on failure
 */
function set_context($context) {
	global $CONFIG;
	if (!empty($context)) {
		$context = trim($context);
		$context = strtolower($context);
		$CONFIG->context = $context;
		return $context;
	} else {
		return false;
	}
}

/**
 * Returns the functional context of a page
 * THIS IS AN ELGG FUNCTION
 * @return string The context, or 'main' if no context has been provided
 */
function get_context() {
	global $CONFIG;
	if (isset($CONFIG->context) && !empty($CONFIG->context)) {
		return $CONFIG->context;
	}
	if ($context = get_plugin_name(true)) {
		return $context;
	}
	return "main";
}

/**
 * Sets the functional sub_context of a page
 *
 * @param string $sub_context The sub_context of the page
 * @return string|false Either the sub_context string, or false on failure
 */
function set_sub_context($sub_context) {
	global $CONFIG;
	if (!empty($sub_context)) {
		$sub_context = trim($sub_context);
		//$sub_context = strtolower($sub_context);
		$CONFIG->sub_context = $sub_context;
		return $sub_context;
	} else {
		return false;
	}
}

/**
 * Returns the functional sub_context of a page
 * Sub-context would be "bf" when you're on friends/bf
 * @return string The sub_context, or null if no sub_context has been provided
 */
function get_sub_context() {
	global $CONFIG;
	if (isset($CONFIG->sub_context) && !empty($CONFIG->sub_context)) {
		return $CONFIG->sub_context;
	}
	return "";
}

/**
 * See if we're on this particular sub context
 * @param string $sub_context
 */
function on_sub_context($sub_context) {
	return $sub_context == get_sub_context();
}

function get_classifier_from_context() {
	$sub_context = get_sub_context();
}

function context_page_handler($page, $handler) {
	// Set context and title
	gatekeeper();

	set_context($handler);
	set_page_owner(get_loggedin_userid());
	setup_widgets_for_context(get_loggedin_userid(), $handler);
	$title = elgg_echo("context:$handler:title");
	
	if ($page[0])
		set_sub_context(urldecode($page[0]));
	else
		set_sub_context("");
	
	// Try and get the user from the username and set the page body accordingly
	$body = elgg_view_layout('widgets',"","");
	
	page_draw($title, $body);
}

/**
 * Determine if we're on a page that's part of a context tab 
 */
function qlyfe_on_tabbed_page() {
	return in_array(get_context(), qlyfe_get_context_array());
}

/**
 * Add a context handler
 * @param string $network
 * @param function $handler
 */
function register_context_handler($network, $handler) {
	global $CONFIG;
	if (!$CONFIG->context_handlers)
		$CONFIG->context_handlers = array($network => array($handler));
	else		
		$CONFIG->context_handlers[$network][] = $handler; 
}


function get_clist_from_context() {
	global $CONFIG;
	if (isset($CONFIG->context_handlers)) {
		$array = $CONFIG->context_handlers[get_context()];
		if ($array) {
			foreach ($array as $function) {
				$result = $function(get_sub_context());
				if ($result) return $result;
			}
		}		
	}	
	return new Qlyfe_CList("public");
}


register_elgg_event_handler('init','system','qlyfe_add_home_context');
