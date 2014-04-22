<?php

    /**
	 * Elgg Message board display page
	 * 
	 * @package ElggMessageBoard
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */
	 
		$user_entity = 	$vars['user_entity'];
		
	 // If there is any content to view, view it
		if (is_array($vars['messages']) && sizeof($vars['messages']) > 0) {
    		
    		//start the div which will wrap all the message board contents
    		echo "<div id=\"messageboard_wrapper\">";
    		
    		$comments = isset( $vars['comments'][ $message_id ] ) ? $vars['comments'][ $message_id ] :array();    					
    		//loop through all annotations and display
			foreach( $vars['messages'] as $message ){
				$message_id = $message->guid;				
				$comments = isset( $vars['comments'][ $message_id ] ) ? $vars['comments'][ $message_id ] :array();
				
				echo elgg_view("messageboard/messageboard_content", array('message' => $message , 'comments'=>$comments , 'user_entity'=>$user_entity));				
			}
			
			//close the wrapper div
			echo "</div>";
			
		} else {
    		
    		echo "<div class='contentWrapper'>" . elgg_echo("messageboard:none") . "</div>";
    		
		}
	  	
		
	 
?>
<form>
<input type="hidden" name="page_owner" id="page_owner" value="<?php echo $vars['page_owner_id'] ?>" />
</form> 		
<style>
	textarea.comment_box{
		width:420px;
		height:24px;
	}
	.input_textarea{
		width:520px;
		height:24px;
	}
	div.a blockquote{
		padding:6px;
		border-bottom:1px #B8D2F5 solid;
		margin-left:44px;
		background:#D8E2F5;
		width:320px;
		margin-bottom:2px;
	}
	.comment_div{
		padding:6px;
		border-bottom:1px #B8D2F5 solid;		
		background:#D8E2F5;
		width:432px;
		margin-bottom:2px;
	}
	
	.time{
		color:#888;
	}
</style>
<script>
function open_comment( i ){		
	$('#comment_div_'+i).css( 'display','block');
}

$('.comment_button').click(
	function(){		
		message_id = this.name;				
		message 	= $('textarea#comment_text_'+message_id).val();
		page_owner	= $('#page_owner').val();
		
		$.ajax({
			type:"POST",
			url:"<?php echo $vars['url']; ?>mod/messageboard/ajax_endpoint/savecomment.php",
			data: "m="+message_id+"&c="+message+'&po='+page_owner,
			success: function( v ){
				var myObject = eval('(' + v + ')');								
				comment_id = myObject.comment_id;
																
				$('#comment_list_div_'+message_id).prepend( myObject.rdiv );				
				$('#comment_text_'+message_id).val( '' );				
				$('#comment_queue_'+comment_id).fadeIn(1500);				
			}		
		})	
		
	}			
);

function view_all( message_id ){	
	$('.comment_div_'+message_id).fadeIn(1500);			
}


function d( message_id ){
	
	if( confirm( '<?php echo elgg_echo( 'messageboard:confirmdeletion' )?>' )){
		$.ajax({
			type:"POST",
			url:"<?php echo $vars['url']; ?>mod/messageboard/ajax_endpoint/deletemessage.php",
			data: 'm='+message_id,
			success: function( m ){
				if( m ){				
					$('#message_div_'+message_id).fadeOut(1500);
				}					
			}		
		})
	}				
}

</script>