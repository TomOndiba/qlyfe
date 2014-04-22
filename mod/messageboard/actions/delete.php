<?php

	
	if (!isloggedin()) forward();
		
	// Make sure we can get the comment in question
		$message_id = (int) get_input('message_id');
		
		//make sure that there is a message on the message board matching the passed id
		if ($entity = get_entity( $message_id )) {
    		
    		//grab the user or group entity
    		//$entity = get_entity($message->entity_guid);
    		    		
            //check to make sure the current user can actually edit the message board
            $owner = $entity->getOwnerEntity();
           
            if( isloggedin() && $owner->getGUID() == get_loggedin_userid()){			
    			//delete the comment
				$entity->delete();
				//display message
				system_message(elgg_echo("messageboard:deleted"));
				//generate the url to forward to 
				$url = "pg/profile/" . $owner->username;
				//forward the user back to their message board						
				forward($url);
			}
			
		} else {		
			$url = "";
			 
			system_message(elgg_echo("messageboard:notdeleted"));
		}
		
		forward($url);

?>