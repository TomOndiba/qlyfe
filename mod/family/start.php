<?php

	/**
	 * Elgg Family widget
	 * This plugin allows users to put a list of their family, on their profile
	 * 
	 * @package QlyfeFamily
	 */
	
		function family_init() {
    		
    			// Load system configuration
				global $CONFIG;
    		
    			//add a widget
			    add_widget_type('family',elgg_echo("family"),elgg_echo('family:widget:description'));
			
			   	// extend our NOP plugin by adding to their classifier list
			    elgg_extend_view("input/classifier_list", "input/family_classifier_list", 10);
			   	
			    // extend the connect dialog
			    elgg_extend_view("connect/dialog", "connect/family", 600);
			    
				elgg_extend_view('connect/vertical_tabs', 'connect/family_vertical_tabs');
				
			    // context handler			    
			    register_context_handler("family", "family_context_handler");

			    // set up the family context
			    $widgets = 
					"profile::family%%" .
					"messageboard%%" .
					"discovery::members"; 
	
				qlyfe_add_context("family", $widgets);
				qlyfe_add_network("family");
			    
			    
		}

		/**
		 * So our access input knows what to do
		 * @param string $sub_context
		 */
		function family_context_handler($sub_context) {
			if (empty($sub_context)) return new Qlyfe_CList("family");
			//if ($sub_context == "bf") return new Qlyfe_CList("bf");
			//if ($sub_context == "f") return new Qlyfe_CList("friends/f");
			//if ($sub_context == "a") return new Qlyfe_CList("friends/a");
			return new Qlyfe_CList("family/$sub_context");
		}
		
		
		register_elgg_event_handler('init','system','family_init');
		

		/**
		 * The relationship is the middle section up there (for example "cousin" or "partner:married")
		 * Use this for connections... for example if someone is trying to connect to you as a 
		 * child you will be asked to connect to them as a parent
		 * 
		 * For all relationsip types
		 * @see languages/en.php
		 */
		function reverse_family_relationship($relationship)
		{
			switch ($relationship) {
				case "child": return "parent";
				case "step-child": return "step-parent";
				case "child-inlaw": return "parent-inlaw";
				case "grandchild": return "grandparent";
				case "parent": return "child";
				case "step-parent": return "step-child";
				case "parent-inlaw": return "child-inlaw";
				case "grandparent": return "grandchild";
				case "aunt_uncle": return "niece_nephew";
				case "niece_nephew" : return "aunt_uncle";
			}
			
			// by default just return the original relationship
			//  holds true for married, engaged, sibling, cousin etc...
			return $relationship;
		}
		
?>