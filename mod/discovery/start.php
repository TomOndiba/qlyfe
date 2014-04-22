<?php

	/**
	 * Elgg Discovery widget
	 */
	
		function discovery_init() {
    		
    		//add a widget
			    add_widget_type("discovery",elgg_echo("discovery"), "");
			
		}
		
		register_elgg_event_handler('init','system','discovery_init');
