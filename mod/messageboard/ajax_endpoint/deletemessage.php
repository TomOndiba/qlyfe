<?php


    // Load Elgg engine will not include plugins
     require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
     require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/lib/board.php");
    
    //get the required info    
    //the actual message
    $message_id = get_input('m');

    //get the full page owner entity
    $message_object	= get_entity( $message_id );
    $logged_user_id = get_loggedin_userid();
    $user = get_entity( $logged_user_id );
    
    //Only page owner and message owner can delete messages
     
    if( $message_object->owner_guid == $logged_user_id || $message_object->container_guid == $logged_user_id ){
    	$message_object->delete();
    	echo $message_id;         		    	
    } else {        
       //echo elgg_echo('messageboard:somethingwentwrong');        
    }        
    exit();    
?>

