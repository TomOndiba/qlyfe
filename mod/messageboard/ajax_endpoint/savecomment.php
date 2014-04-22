<?php


    // Load Elgg engine will not include plugins
     require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
     require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/lib/board.php");
    
    //get the required info
    
    //the actual message
    $message 	= get_input('c');
    $message_id = get_input('m');
    $page_owner = get_input('po');
    //get the full page owner entity
    $message_object	= get_entity( $message_id );
    $logged_user_id = get_loggedin_userid();
    $user = get_entity( $logged_user_id );
    
    //echo '<div class="comment_div">'.$message.'</div>';
    
    if( $message || ! $message_object->guid ){        
       // If posting the comment was successful, send message
	   	if( $annotation = $message_object->annotate( 'messageboard' , $message , 0 , $_SESSION['user']->getGUID())) {					
			global $CONFIG;
					
			if ($user->getGUID() != $_SESSION['user']->getGUID())
				notify_user($user->getGUID(), $_SESSION['user']->getGUID(), elgg_echo('messageboard:email:subject'), 
				sprintf(
					elgg_echo('messageboard:email:body'),
					$_SESSION['user']->name,
					$message,
					$CONFIG->wwwroot . "pg/messageboard/" . $user->username,
					$_SESSION['user']->name,
					$_SESSION['user']->getURL()
					)
				); 
       		
			// add to river
	    	add_to_river('river/object/messageboard/create','messageboard',$_SESSION['user']->guid,$user->guid);
   		}else{
	   		register_error(elgg_echo("messageboard:failure"));
		}
		
		$comment 	= get_board_comment( $annotation->id );
		$return_div = display_comment( $comment , 'none' );
		//'<div class="comment_div" id="comment_queue_'.$annotation->id.'" style="display:none">'.$message.'</div>';
		$values 	= array( 'rdiv'=>$return_div , 'comment_id'=>$annotation->id );		
    	echo json_encode($values); 
    	    
    } else {        
        echo elgg_echo('messageboard:somethingwentwrong');        
    }
    
    
    exit();    
?>

