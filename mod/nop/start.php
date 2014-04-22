<?php
 
    /**
     * NOP (NetworkObjectProtocol) Plugin
     * Adds an extra dimension to the traditional ELGG access levels
     * We override input/access.php
     **/
 
    function nop_init() {
 
		// extend the css with our css
		elgg_extend_view('css','nop/css');

		register_page_handler("connections", "nop_connections_page_handler");
		
		// extend our javascript includes
		// @see mod/nop/javascript/nop.js
		elgg_extend_view('metatags', 'nop/js_includes');
    }
    
         // Make sure the nop initialisation function is called on initialisation
	register_elgg_event_handler('init','system','nop_init');


	function nop_connections_page_handler($page) {
		$username = $page[0];
		$context = $page[1];
		$sub_context = urldecode($page[2]);
		
		global $vars;
		$vars['user'] = get_user_by_username($username);
		set_page_owner($vars['user']->guid);
		
		set_context($context);
		set_sub_context($sub_context);
		
		include(dirname(__FILE__) . "/connections.php"); 
	}