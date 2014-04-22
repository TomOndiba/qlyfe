<?php
	/**
	 * Elgg Message board: add message action
	 * 
	 * @package ElggMessageBoard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.org/
	 */

	// Make sure we're logged in; forward to the front page if not
		if (!isloggedin()) forward();
		
		require_once(dirname(dirname(dirname(__FILE__))) . "/../engine/lib/board.php");
		
		//Get input
		
		$message_content = get_input('message_content'); // the actual message				
		$page_owner 	= get_input("pageOwner"); // the message board owner
				
		//$message_owner 	= get_input("guid"); // the user posting the message
		
		$message_owner 	= get_loggedin_userid();
		$page_owner_entity = get_entity($page_owner); // the user entity who owns the profile where message was posted 
		$message_owner_entity = get_entity( $message_owner ); // the user entity of the user who posted the message 		
		
		if( $message_owner_entity && ! empty( $message_content )){
    						
	        // If posting the comment was successful, say so
	        	if( $message_owner == $page_owner ){
					$accesslevel = get_input('accesslevel');
	        	}else{
	        		$r 	= get_relationship_to_page_owner( $message_owner, $page_owner );
	        		if( $r->classifier ){
	        			$accesslevel[] = $r->network.'/'.$r->classifier;
	        		}else{
	        			$accesslevel[] = $r->network;
	        		}		        					
	        	}
	        	
	        	if( ! is_array( $accesslevel )){
					$accesslevel = array();
				}	

				//$context =	get_clist_from_context();				
				$clist 	 = 	new Qlyfe_CList( $accesslevel[0] );
				//$connected_to 	= 	connected_to( $page_owner_entity, $accesslevel , $subtype = "" ,  0  );
				//$friends 		= 	$message_owner_entity->getConnectedTo( $subtype = "", 1000 , $offset = 0 , $clist );
				$connected_to 		= 	$page_owner_entity->getConnectedTo( $subtype = "", 1000 , $offset = 0 , $clist );

				$messageboard = new ElggObject();			  	
			  	$messageboard->description = $message_content;
			  	$messageboard->subtype = "messageboard";
			  	$messageboard->owner_guid = $message_owner;
			  	$messageboard->container_guid	= 	$page_owner;
			  	/**
			  	 * There is a problem of saving objects this way
			  	 * Clist are not properly save. All are set to Private
			  	 * 
			  	 */			 
  				$messageboard->save();
  				/**
  				 * $messageboard->save(); adds a classifier with 'Private' by default
  				 * we will remove that and change with the $clist values
  				 */
			  	insert_classifiers('entity', $messageboard->guid , $clist);
			  					
  				add_entity_relationship( $page_owner_entity->getGUID() , 'has_message', $messageboard->guid , $clist );
  				
  				if( $page_owner != $message_owner ){
  					// add a message to poster
  					$rel = get_relationship_to_page_owner( $page_owner , get_loggedin_userid() );   					   					  					  					
  					add_entity_relationship( $message_owner_entity->getGUID() , 'has_message', $messageboard->guid , $rel->network );
  				}
  				
				foreach( $connected_to as $f ){
					$rel = get_relationship_to_page_owner(   $f->guid , $message_owner);															
					add_entity_relationship( $f->guid , 'has_message', $messageboard->guid , $rel->network );		
				}				
				if( $page_owner == $message_owner ){
					//$url = "pg/home/";
					$url = $_SERVER['HTTP_REFERER'];
				}else{	
	  				//set the url to return the user to the correct message board
					//$url = "pg/profile/" . $page_owner_entity->username;
					$url = $_SERVER['HTTP_REFERER'];
				}	
				
		} else {
		
			register_error(elgg_echo("messageboard:blank"));			
			//set the url to return the user to the correct message board
			//$url = "pg/profile/" . $page_owner_entity->username;
			$url = $_SERVER['HTTP_REFERER'];
			
		}
		
	// Forward back to the messageboard
	    forward($url);

?>