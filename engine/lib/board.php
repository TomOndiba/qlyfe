<?php

/**
 * 
 * @param unknown_type $user_object
 * @param unknown_type $accesslist
 * @param unknown_type $subtype
 * @param unknown_type $offset
 */
function connected_to( $user_object, $accesslist = array() , $subtype = "" , $offset = 0 ){
	global $CONFIG;
	/**
	 * Temporary limit of number of friends , 
	 * will find a better solution after Alpha
	 */
	$limit = 1000;
	
	if( ! $user_object->guid ){
		return array();	
	}
	
	if( ! count( $accesslist ) ){
		return array();
	}
	
	$access_array  = array();
	
	foreach( $accesslist as $a){
		if( $a == 'public' ){
			$access_array[] = 'friends';
			$access_array[] = 'family';		
		}elseif( $a == 'private' ){
			//do nothing... save message for self  
			return array();			
		}else{	
			$access_array[] = $a;
		}
		
	}
	
	$networks	=	implode( '\',\'' , $access_array );
		
	/**
	 * @TODO
	 * Need to get all relationship values for friends and families
	 * Need to fix this sql without the -- relationship != 'has_message' line
	 * since it will cause problems later on
	 * 	 
	 */
	/** Original sql 
	$sql = " SELECT r.* from {$CONFIG->dbprefix}entity_relationships as r "
	//." INNER JOIN {$CONFIG->dbprefix}users_entity as u ON r.guid_one"
	." WHERE guid_one =  $user_object->guid AND network IN ( '$networks' )"
	." AND relationship != 'has_message' "
	."\n LIMIT $offset , $limit  ";
	**/
	
	$sql = " SELECT r.* from {$CONFIG->dbprefix}entity_relationships as r "
	." WHERE guid_two =  $user_object->guid AND network IN ( '$networks' )"
	." AND relationship != 'has_message' "
	."\n LIMIT $offset , $limit  ";
	
	$connections = get_data( $sql );
	//echo $sql;
	return $connections;
}

function get_board_messages_rev( $page_owner_id , $context , $limit = 20 , $offset = 0 ){
	global $CONFIG;
	$logged_userid = get_loggedin_userid();
	
	//add single quotes to context 
	$context_array	=	explode(',', $context);
	$context  = implode( '\',\'' , $context_array );
	
	if( $page_owner_id  == $logged_userid ){
		$sql = " SELECT e.*,o.description, u.username   from {$CONFIG->dbprefix}objects_entity as o "
		."\n INNER JOIN {$CONFIG->dbprefix}classifiers as c ON o.guid = c.id "
		."\n INNER JOIN {$CONFIG->dbprefix}entities as e ON o.guid = e.guid "
		."\n INNER JOIN {$CONFIG->dbprefix}users_entity as u ON e.owner_guid = u.guid "
		."\n INNER JOIN {$CONFIG->dbprefix}entity_relationships as r ON c.network = r.network "
		."    "
		." WHERE  c.network = r.network AND u.guid IN ( SELECT guid_one FROM {$CONFIG->dbprefix}entity_relationships "
		." WHERE guid_two = $logged_userid AND network IN ( '$context' ) )  "
		."\n GROUP BY o.guid ORDER BY time_updated DESC	LIMIT $offset ,$limit  ";
	}else{
		$sql = " SELECT e.*, o.guid as guid,o.description, u.username from {$CONFIG->dbprefix}objects_entity as o "
		."\n INNER JOIN {$CONFIG->dbprefix}classifiers as c on o.guid = c.id "
		."\n INNER JOIN {$CONFIG->dbprefix}entities as e on o.guid = e.guid "
		."\n INNER JOIN {$CONFIG->dbprefix}users_entity as u on e.owner_guid = u.guid "
		." WHERE c.network IN ( '$context' )  "
		." AND  u.guid IN ( SELECT guid_one FROM {$CONFIG->dbprefix}entity_relationships "
		." WHERE guid_two = $page_owner_id AND network IN ( '$context' ) )  "
		."\n GROUP BY o.guid ORDER BY time_updated DESC	LIMIT $offset ,$limit  ";
	}

	$messages = get_data( $sql );
	echo $sql;
	return $messages;			
}

/**
 * Fetches all messages given a page owner and the networks in context
 * to who the current login user
 *  
 * @param $page_owner_id
 * @param $networks
 * @param $limit
 * @param $offset
 */

function get_board_messages( $page_owner_id , $networks =array(), $limit = 20 , $offset = 0 ){
	global $CONFIG;	
	
	$where_array[] 	= ' guid_one = '.(int)$page_owner_id;
	$where_array[] 	= " relationship = 'has_message' ";	
	$where_array_or	= array();
		
	$logged_userid = get_loggedin_userid();
	$network_or	=	'';	
	if( $logged_userid != $page_owner_id ){
				
		// Find the relationship between page owner and logged in user
		
		$rel 	= get_relationship_to_page_owner( $logged_userid, $page_owner_id );
						
		$networks[] = 'public';
		$networks[]	= $rel->network;
		
		if( $rel->classifier ){
			//classifiers will be integrated later
			//$where_array[] = " classifier ='$rel->classifier' ";	
		}
		  			
		$network_or = " OR ( network='private' AND guid_one = $logged_userid AND guid_two = r.guid_two ) ";
				
	}
			
	if( count($networks) ){
		$where_array[] = " ( network IN ( '".implode( '\',\'' , $networks )."' ) $network_or )";	
	}
	
	$where = ' WHERE '.implode( ' AND ' , $where_array );
	foreach( $where_array_or as $q){
		$where .=' OR '.$q;
	}
	$sql = " SELECT r.*,e.*,o.description, u.username from {$CONFIG->dbprefix}entity_relationships as r "
	."\n INNER JOIN {$CONFIG->dbprefix}objects_entity as o on r.guid_two = o.guid "
	."\n INNER JOIN {$CONFIG->dbprefix}entities as e on r.guid_two = e.guid "
	."\n INNER JOIN {$CONFIG->dbprefix}users_entity as u on e.owner_guid = u.guid "
	." $where "
	."\n Group by o.guid ORDER BY time_updated DESC	LIMIT $offset ,$limit  ";
	
	$messages = get_data( $sql );
	//echo $sql;
	return $messages;			
}

/**
 * Fetch all comments for one or more message_ids
 * @param array $message_ids
 */
function get_board_comments( $message_ids = array() ){
	global $CONFIG;
	if(!count( $message_ids )){
		return array();
	}
	
	$in = implode( ',' , $message_ids );
	
	$comments = get_data(" SELECT a.id as id, a.entity_guid , a.owner_guid, "
	."\n a.time_created, s.string , u.name , u.username from {$CONFIG->dbprefix}annotations as a "
	."\n INNER JOIN {$CONFIG->dbprefix}metastrings as s on a.value_id = s.id "	
	."\n INNER JOIN {$CONFIG->dbprefix}users_entity as u on a.owner_guid = u.guid "
	."\n WHERE a.entity_guid IN ( $in ) "
	."\n ORDER BY time_created DESC	LIMIT 0 , 1000  "
	);
	
	$comments_array = array();
	
	foreach( $comments as $comment ){
		$guid = $comment->entity_guid;
		$comments_array[ $guid ][] = $comment; 	
	}
	
	return $comments_array;
}

function get_board_comment( $comment_id ){
	global $CONFIG;
	if(! intval(  $comment_id )){
		return false;
	}
			
	$comment = get_data(" SELECT a.id as id, a.entity_guid , a.owner_guid, "
	."\n a.time_created, s.string , u.name from {$CONFIG->dbprefix}annotations as a "
	."\n INNER JOIN {$CONFIG->dbprefix}metastrings as s on a.value_id = s.id "	
	."\n INNER JOIN {$CONFIG->dbprefix}users_entity as u on a.owner_guid = u.guid "
	."\n WHERE a.id = $comment_id "	
	);
	
	return $comment[0];
}

function display_comment( $comment , $display = 'block' , $context ='public'){
	
	//$user_entity	=	get_user($comment->owner_guid);
	$user_profile_url	=	   $vars['url'].'/pg/profile/'.$comment->username;
	$html ='';
	$html .= '<blockquote class="comment_div_'.$comment->entity_guid.'" 	id="comment_queue_'.$comment->id.'" style="display:'.$display.'" >';
	$html .= '	<table><tr><td style="width:32px">'.elgg_view("profile/icon",array('entity' => get_entity($comment->owner_guid), 'size' => 'tiny')).'</td>';						 		     
	$html .= '	<td><b><a href="'.$user_profile_url.'">'.getNickName( $comment->owner_guid , $context).'</b></a> - '.$comment->string.'<br />';		
	$html .= '	<span class="time"><i> '.friendly_time( $comment->time_created ).'</i></span>';
	$html .= '	</td></tr></table>';
	$html .= '</blockquote>';
	return $html;
}

function display_comments( $comments ){	
	$html	=	'';
	$i = 1;
	$context = get_clist_from_context();
	
	foreach( $comments as $comment ){
		// limit the comments to the latest 30
		if( $i > 30 ) break;
		//hide some of the comments 
		$display =	$i > 3 ? 'none':'block'; 		
		$html .= display_comment( $comment , $display , $context );
		$i++;
	}					
	
						        				
	return $html;						        			
}
/**
 * This might be a duplicate function on users
 * Using this just for alpha release
 * $user1 is the poster and $user2 is the page owner
 *  
 * @param int $user_id1  
 * @param inte $user_id2
 */
 
function get_relationship_to_page_owner( $user1 , $user2 ){
	global $CONFIG;
	$user1  = intval( $user1 );
	$user2  = intval( $user2 );
	$sql = " SELECT * from {$CONFIG->dbprefix}entity_relationships as r "
	."\n WHERE guid_one = $user1 AND guid_two = $user2 ";
	$r =  get_data( $sql );
	
	return $r[0];
}

$nn_instance = array();

function getNickName( $user_id , $current_network  ){
	global $nn_instance;
	
	if( isset( $nn_instance[$user_id] ) ){
		if( isset( $nn_instance[$user_id][$current_network] ) ){
			return $nn_instance[$user_id][$current_network];
		}	
	}
		
	$metadata = get_metadata_byname( $user_id, "nickname");	
	$narr = array();
	
	if (is_array($metadata)) {
		foreach($metadata as $md) {
			$clist = $md->access_id;
			
			foreach ($clist->list as $classifier){				
				$network = $classifier->network;	
			}
			
			$nn_instance[ $user_id ][ $network ] = $md->value;				
		}
		// there is a problem with returning
		// $nn_instance[$user_id][$current_network]
		switch($current_network){
			case 'friends':
				return $nn_instance[ $user_id ]['friends'];	
			break;		
			case 'family':
				return $nn_instance[ $user_id ]['family'];	
			break;
			default:
			case 'public':
				return $nn_instance[ $user_id ]['public'];	
			break;
		};
						
	}else{
		$metadata = get_metadata_byname($user_id,"firstname");
		$metadata2 = get_metadata_byname($user_id,"lastname");
						
		return $metadata->value." ".$metadata2->value;
	}						
}	

function getBoardClassifiers( $message_id ){
	$classifiers = select_entity_classifiers( $message_id );
	$c_array =	array();
	
	//print_r( $classifiers->list );
	foreach( $classifiers->list as $c ){
		if( strtolower( $c->network ) == 'private' ){
			$c_array[] = 'Self';
		}elseif( strtolower( $c->network ) == 'public' ){
			$c_array[] = 'Everybody';
		}else{
			$c_array[] =  ucfirst( $c->network );
		}	  
	}
	return implode( ',' , $c_array );
}

