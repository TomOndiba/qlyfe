<?php

	/**
	 * Elgg signupwizard plugin
	 *
	 * @package Elggsignupwizard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	/**
	 * signupwizard init function; sets up the signupwizard functions
	 *
	 */
		function signupwizard_init() {

			// Get config
				global $CONFIG;
			// Register a page handler, so we can have nice URLs
				register_page_handler('signupwizard','signupwizard_page_handler');

		}

	/**
	 * signupwizard page handler
	 *
	 * @param array $page Array of page elements, forwarded by the page handling mechanism
	 */
		function signupwizard_page_handler($page) {

			global $CONFIG;

			if (isset($page[0])) {

				switch ($page[0])
				{
					case 'edit' : include($CONFIG->pluginspath . "signupwizard/edit.php"); break;
					case 'editicon' : include($CONFIG->pluginspath . "signupwizard/editicon.php"); break;
					case 'addicon' : include($CONFIG->pluginspath . "signupwizard/addicon.php"); break;					
					case 'importfriends' : include($CONFIG->pluginspath . "signupwizard/importfriends.php"); break;					
					case 'icondialog' : include($CONFIG->pluginspath . "signupwizard/icondialog.php"); break;										
					default : include($CONFIG->pluginspath . "signupwizard/index.php");
				}
			}else{
				include($CONFIG->pluginspath . "signupwizard/index.php");			
			}
			
		}


	// Make sure the signupwizard initialisation function is called on initialisation
		register_elgg_event_handler('init','system','signupwizard_init',1);
		register_elgg_event_handler('signupwizardupdate','all','object_notifications');

	// Register actions
		global $CONFIG;

	// Define widgets for use in this context
		use_widgets('signupwizard');
		
?>