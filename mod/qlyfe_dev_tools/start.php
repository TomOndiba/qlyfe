<?php
 
    /**
     * Qlyfe DevTools Plugin
     * Activate if you're a qlyfe developer
     **/
 
    function qlyfe_dev_tools_init() {
    	global $CONFIG;
    	
		register_notification_handler("email", "qlyfe_dev_email_notify_handler");
		
		// this is for writing stuff to the error log.. javascript stuff to be exact
		// by default the action goes 
		elgg_extend_view("metatags", 'js_includes');
    }
    
    
     // Make sure the qlyfe_dev_tools initialisation function is called on initialisation
    register_elgg_event_handler('init','system','qlyfe_dev_tools_init');
    
	
	/**
	 * We're just capturing email events and writing them to the default error log
	 * Enter description here ...
	 * @param ElggEntity $from
	 * @param ElggUser $to
	 * @param unknown_type $subject
	 * @param unknown_type $message
	 * @param array $params
	 */
	function qlyfe_dev_email_notify_handler(ElggEntity $from, ElggUser $to, $subject, $message, array $params = NULL) {
		
		// BAP: copied most of this from /engine/lib/notification.php email_notify_handler()
		global $CONFIG;
		$site = get_entity($CONFIG->site_guid);
		// If there's an email address, use it - but only if its not from a user.
		if ((isset($from->email)) && (!($from instanceof ElggUser))) {
			$from = $from->email;
		} else if (($site) && (isset($site->email))) {
			// Has the current site got a from email address?
			$from = $site->email;
		} else if (isset($from->url))  {
			// If we have a url then try and use that.
			$breakdown = parse_url($from->url);
			$from = 'noreply@' . $breakdown['host']; // Handle anything with a url
		} else {
			// If all else fails, use the domain of the site.
			$from = 'noreply@' . get_site_domain($CONFIG->site_guid);
		}
		$sitename = $site->name;
		$from_email = "\"$sitename\" <$from>";
		$to_email = $to->email;
		
		
		error_log("EMAIL from=" . $from_email . ", to=" . $to_email . 
			", subject=" . $subject . ", message=" . $message);
	}
	
?>

