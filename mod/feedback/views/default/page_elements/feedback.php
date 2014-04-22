<?php
    /**
     * Qlyfe Feedback plugin
     * Feedback for Qlyfe
     * 
     * @package Feedback
     * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
     * @author Eder Weber
     * @copyright Qlyfe
     * @link http://www.qlyfe.com
     */

	global $CONFIG;

  $user_ip = $_SERVER[REMOTE_ADDR];
  
  $user_id = elgg_echo('feedback:default:id');
  if ( isloggedin () ) 
  {
    $user_id = $_SESSION['user']->name . " (" . $_SESSION['user']->email .")";
  }
  
  $feedback_url = $CONFIG->wwwroot.'mod/feedback/actions/submit_feedback.php';
  
  $progress_img = '<img src="'.$CONFIG->wwwroot.'_graphics/ajax_loader.gif" alt="'.elgg_echo('feedback:submit_msg').'" />';
  $open_img = '<img src="'.$CONFIG->wwwroot.'mod/feedback/_graphics/slide-button-open.gif" alt="'.elgg_echo('feedback:label').'" title="'.elgg_echo('feedback:label').'" />';
  $close_img = '<img src="'.$CONFIG->wwwroot.'mod/feedback/_graphics/slide-button-close.gif" alt="'.elgg_echo('feedback:label').'" title="'.elgg_echo('feedback:label').'" />';
?>

  <div id="feedbackWrapper">

  <div id="feedBackToggler">
    <a id="feedBackTogglerLink" href="javascript:void(0)" onclick="FeedBack_Toggle();this.blur();" style="float:left;position:relative;left:-1px;">
      <?php echo $open_img ?>
    </a>
  </div>
		
  <div id="feedBackContent">
    <div style="padding:10px;">
        
      <h1 style="padding-bottom:10px;">
        <?php echo elgg_echo('feedback:title'); ?>
      </h1>

      <div style="padding-bottom:10px;">
        <?php echo elgg_echo('feedback:message'); ?>
      </div>

      <div id="feedBackFormInputs">
        <form action="" method="post" onsubmit="FeedBack_Send();return false;">
        	<!-- 
          <div>
            <div style="float:left"><b><?php echo elgg_echo('feedback:mood:label')?>:&nbsp;&nbsp;&nbsp;&nbsp;</b></div>
            <div style="float:left">
              <input type="radio" name="mood" value="angry"> <?php echo elgg_echo('feedback:mood:angry')?>
              <input type="radio" name="mood" value="neutral" checked> <?php echo elgg_echo('feedback:mood:neutral')?>
              <input type="radio" name="mood" value="happy"> <?php echo elgg_echo('feedback:mood:happy')?>
            </div>
            <div style="clear:both;"></div>
          </div>
           -->
          <br />
          <div>
            <div style="float:left"><b><?php echo elgg_echo('feedback:list:about')?>:&nbsp;&nbsp;&nbsp;&nbsp;</b></div>
            <div style="float:left">
              <input type="radio" name="about" value="suggestions" checked> <?php echo elgg_echo('feedback:about:suggestions')?>
              <input type="radio" name="about" value="bug_report"> <?php echo elgg_echo('feedback:about:bug_report')?>
              <input type="radio" name="about" value="content"> <?php echo elgg_echo('feedback:about:content')?><br />
              <input type="radio" name="about" value="compliment"> <?php echo elgg_echo('feedback:about:compliment')?>
              <input type="radio" name="about" value="other"> <?php echo elgg_echo('feedback:about:other')?>
            </div>
            <div style="clear:both;"></div>
          </div>
          <br />
          <div>
						<input type="text" name="feedback_id" value="<?php echo $user_id?>" id="feedback_id" size="30" onfocus="if (this.value == '<?php echo elgg_echo('feedback:default:id')?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo elgg_echo('feedback:default:id')?>';}" class="feedbackText" />
          </div>
					<div style="padding-top:5px;">
						<textarea name="feedback_txt" cols="34" rows="10" id="feedback_txt" onfocus="if (this.value == '<?php echo elgg_echo('feedback:default:txt')?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo elgg_echo('feedback:default:txt')?>';}" class="feedbackTextbox mceNoEditor"><?php echo elgg_echo('feedback:default:txt')?></textarea>
					</div>
          <div>
            <?php 
            	// if captcha functions are loaded, then use captcha
	            //if ( function_exists ( "captcha_generate_token" ) ) {
                //echo elgg_view('input/captcha'); 
              //}
            ?>
          </div>
				  <div style="padding-top:10px;">
					  <input id="feedback_send_btn"   name="<?php echo elgg_echo('send'); ?>"   value="Send"   type="button" class="Button" onclick="FeedBack_Send();"  />
					  &nbsp;
					  <input id="feedback_cancel_btn" name="<?php echo elgg_echo('cancel'); ?>" value="Cancel" type="button" class="Button" onclick="FeedBack_Toggle();" />
					  &nbsp;
				  </div>
        </form>
      </div>
      <div id="feedBackFormStatus"></div>
		  <div id='feedbackClose' style="padding-top:10px;">
			  <input id="feedback_close_btn"   name="<?php echo elgg_echo('close'); ?>"   value="Close"   type="button" class="Button" onclick="FeedBack_Toggle();"  />
      </div>
    </div>
  </div>

  <div style="clear:both;"></div>
    
</div>

<script type="text/javascript">

<?php 
  // if user is logged in then disable the feedback ID
  if ( isloggedin () ) { 
    echo "$('#feedback_id').attr ('disabled', 'disabled');";
  }
?>
$("#feedbackWrapper").width("50px");
$('#feedbackClose').hide();

var toggle_state = 0;

function FeedBack_Toggle()
{
    if ( toggle_state ) 
    {
      toggle_state = 0;
      $("#feedbackWrapper").width("50px");
      $("#feedBackTogglerLink").html('<?php echo $open_img?>');
      $('#feedBackFormInputs').show();
			$("#feedBackFormStatus").html("");
      $('#feedbackClose').hide();
    }
    else 
    {
      toggle_state = 1;
      $("#feedbackWrapper").width("450px");
      $("#feedBackTogglerLink").html('<?php echo $close_img?>');
    }

    $("#feedBackContent").toggle();
}

function FeedBack_Send()
{
  var page = '<?php echo $_SERVER["REQUEST_URI"] ?>';
  //var mood = $('input[name=mood]:checked').val();
  var about = $('input[name=about]:checked').val();
  var id = $("#feedback_id").val().replace(/^\s+|\s+$/g,"");
  var txt = encodeURIComponent( $("#feedback_txt").val().replace(/^\s+|\s+$/g,"") );

  var captcha_token = $('input[name=captcha_token]').val();
  var captcha_input = $('input[name=captcha_input]').val();
  if ( captcha_token != '' && captcha_input == '' ) 
  {
    alert ( "<?php echo elgg_echo('feedback:captcha:blank')?>" );
    return;
  }

  // if no address provided...
  if ( id == '' || id == "<?php echo elgg_echo('feedback:default:id')?>" )
  {
    id = "<?php echo $user_ip ?>";
  }

  // if no text provided...
  if ( txt == '' || txt == encodeURIComponent("<?php echo elgg_echo('feedback:default:txt')?>") )
  {
    alert ( "<?php echo elgg_echo('feedback:default:txt:err')?>" );
    return;
  }

  // show progress indicator
  $('#feedBackFormStatus').html('<?php echo $progress_img?>');

  // disable the send button while we are submitting
  $('#feedBackFormInputs').hide();
  
	// fire the AJAX query
	jQuery.ajax({
		url: "<?php echo $feedback_url?>",
		type: "POST",
		data: "captcha_input="+captcha_input+"&captcha_token="+captcha_token+"&page="+page+"&mood="+mood+"&about="+about+"&id="+id+"&txt="+txt,
		cache: false,
		dataType: "html",
		error: function() {
      //$('#feedBackFormInputs').show();
			$("#feedBackFormStatus").html("<div id='feedbackError'><?php echo elgg_echo('feedback:submit_err')?></div>");
      $('#feedbackClose').show();
		},
		success: function(data){
      //$('#feedBackFormInputs').show(); // show form
			$("#feedBackFormStatus").html(data);
      $('#feedbackClose').show();
		}
	});
}

</script>
