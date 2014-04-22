<?php

    /**
	 * Elgg Message board index page
	 * 
	 * @package ElggMessageBoard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */
		 
	 // Load Elgg engine
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
		require_once(dirname(dirname(dirname(__FILE__))) . "/engine/lib/board.php");
		if( ! page_owner() ) forward();
		
		// Get the user who is the owner of the message board
	    $entity = get_entity(page_owner());
	    
		//$contents = $entity->getAnnotations('messageboard', 10, 0, 'desc');
		$user_guid = get_loggedin_userid();
		$clist 	= get_clist_from_context();
		
		// fetching friends list will work. I'll apply after alpha
		// $friends  = $entity->getConnectedTo($subtype = "",1000, $offset = 0, $clist = null);				
		// $friends  = $entity->getConnectedFrom($subtype = "",1000, $offset = 0, $clist );
		
		$page_owner_id = $entity->getGUID();
		$user_entity = get_user($user_guid);
		 			
		$network_array  = array();
						
		if( $user_guid == $page_owner_id ){
			
			$network_array[] = $clist;
			// user is on his own profile page			
			if( $clist == 'public' || $clist == 'friends,family' ){
				$network_array[] = 'friends';
				$network_array[] = 'family';
				$network_array[] = 'private';
				$network_array[] = 'public';
			}
					
			foreach( $clist->list as $list ){
				if( ! in_array( $list , $network_array  )){				
					$network_array[] = $list->network;
				}	
			}
			
		}else{
			$network_array[] = 'public';			
		}
		
		/**
		 * TODO
		 * Need to pass $cList here instead of network_array
		 */
		$messages = get_board_messages( $page_owner_id , $network_array );				
		//$messages = get_board_messages_rev( $page_owner_id , $clist );
		
    	// Get the content to display
        $area2 = elgg_view_title(elgg_echo('messageboard:board'));
        	    	    			
    	foreach( $messages as $m ){
			$m_ids[] = $m->guid;			
		}
		
		$comments  = get_board_comments( $m_ids );
		//$comments =array();
    	if(isloggedin()){
			$area2 .= elgg_view("messageboard/forms/add" , array( 'page_owner_id'=> $page_owner_id , 'loggedin_userid' => $user_guid ));
			$area2 .= elgg_view("messageboard/messageboard", array('messages' => $messages , 'comments'=> $comments,  'page_owner_id'=> $page_owner_id ,'user_entity'=> $user_entity));
		}
		
    	if( isset( $is_widget ) && $is_widget ){
    		echo $area2;
    	}else{
	    	$body = elgg_view_layout("two_column_left_sidebar", '', $area2);		
			// Display page
			page_draw(sprintf(elgg_echo('messageboard:user'),$entity->name),$body);    		    		
    	}
?>