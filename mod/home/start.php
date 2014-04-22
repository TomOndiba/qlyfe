<?php

/**
 * Qlyfe home plugin
 */

/**
 * Profile init function; sets up the profile functions
 */
function home_init() {
	
    //add a widget
    add_widget_type('home',elgg_echo("home"),elgg_echo('home:widget:description'));

	
    // context handler			    
    register_context_handler("home", "home_context_handler");
    
	// define widgets to be shown from our home tab
	$widgets = 
		"profile::home%%" .
		"messageboard%%" .
		"discovery::members"; 
	
	qlyfe_add_context("home", $widgets);
	
}

/**
 * So our access input knows what to do
 * @param string $sub_context
 */
function home_context_handler($sub_context) {
	$array = array();
	
	if (is_plugin_enabled("friends")) $array[] = "friends";
	if (is_plugin_enabled("family")) $array[] = "family";
	if (empty($array)) return null;
		
	return new Qlyfe_CList($array);
}


register_elgg_event_handler('init','system','home_init',1);
