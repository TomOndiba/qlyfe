<?php

	$message_id = $vars['message']->guid;
	$context 	= get_clist_from_context();
	$classifiers = getBoardClassifiers( $message_id );
	$user_profile_url	=	   $vars['url'].'/pg/profile/'.$vars['message']->username;
		
?>

<div class="messageboard" id="message_div_<?php echo $message_id ?>"><!-- start of messageboard div -->
	
    <!-- display the user icon of the user that posted the message -->
    <div class="message_sender"> 	            
        <?php echo elgg_view("profile/icon",array('entity' => get_entity($vars['message']->owner_guid), 'size' => 'tiny')); ?>
    </div>
    
    <!-- display the user's name who posted and the date/time -->
    <p class="message_item_timestamp">
        <?php         	
        	//echo "<b style=\"color:blue\">".get_entity($vars['message']->owner_guid)->name . "</b> " . friendly_time($vars['message']->time_created);
         	 
        	echo "<b style=\"color:blue\"><a href=\"$user_profile_url\">".getNickName($vars['message']->owner_guid , $context )."</b></a> " . friendly_time($vars['message']->time_created);
        ?>
    </p>
    		
	<!-- output the actual comment -->
	<div class="message">
		<p style="background-color:#EEEEED;padding:12px"><?php echo parse_urls($vars['message']->description); ?></p>		
	</div>
	<div class="message_buttons">
		    	
	
<img src="<?php echo $vars['url'].'/mod/messageboard/graphics/comment.png';  ?>" align="left" />
	<a href="javascript:open_comment(<?php echo $message_id ?>)" ><?php echo elgg_echo('messageboard:comment'); ?></a>
<?php if( isloggedin() && ( $vars['message']->owner_guid == get_loggedin_userid()  || $vars['message']->container_guid == get_loggedin_userid() ) ){ ?>
		- <a href="javascript:d(<?php echo $vars['message']->guid ?>)"><?php echo elgg_echo('messageboard:delete'); ?></a>
         
<?php } ?>		        
		  </div>
	<div class="clearfloat"></div>
<?php 	
	
	$comments = isset( $vars['comments']) ? $vars['comments'] :array();
	if( count( $comments ) > 5 ){
		echo '<div style="padding-left:44px"><a href="javascript:view_all('.$message_id.')"  >View all '.count( $comments ).' comments </a></div> ';
	}
?>
	<div class="a" id="comment_list_div_<?php echo $message_id ?>">
<?php 	
	echo display_comments(	$comments );	
	$display  = count($comments) ? 'block':'none';	
?>		
	</div><!-- end of comment_list_div -->
	<div id="comment_div_<?php echo $message_id ?>" style="display:<?php echo $display ?>">
	<table  border="1">	
	<tr>
		<td style="width:80px;text-align:right;padding-right:4px">			
			<?php echo elgg_view("profile/icon",array('entity' => get_entity($vars['message']->owner_guid), 'size' => 'tiny')); ?>
		</td>
		<td>
			<img src="<?php echo $vars['url'].'/mod/messageboard/graphics/quote.png';  ?>" />		
		</td>
		<td>
			<blockquote class="comment_div" >			
				<?php //echo elgg_view("input/longtext",array("value" => "" , 'name'=>'' , "id"=>"comment_".$vars['message']->id,"class"=>"comment_box" )); ?>	
				<textarea class="comment_box" id="comment_text_<?php echo $message_id ?>" name="comment_text_<?php echo $message_id ?>" ></textarea>		
				<br />
				<?php //echo elgg_view("input/submit",array("class"=>"comment_class" , "name"=>"$message_id" ,"value" => " Post Comment" )); ?>
				<input type="button" style="height:24px;padding:2px" name="<?php echo $message_id ?>"  class="comment_button" value=" Post Comment"  />		
			</blockquote>	
		</td>	
	</tr>	
	</table>
	</div>
</div>

<!-- end of messageboard div -->
