<?php

	/**
	 * Elgg invite page
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @link http://elgg.org/
	 */
	

?>
	<script language="javascript1.2">
	var options2 = { 
        beforeSubmit:  inviteRRequest,  // pre-submit callback 
        success:       inviteRResponse  // post-submit callback 
    }; 
	function inviteRRequest(formData, jqForm, options2) { 
		if($("#from_name").val() == "" ){
			alert('Please enter From Name');
			$("#from_name").focus();
			return false;
		}
		$("#iconsubmit").hide();
		$("#iconsubmitting").show();
//    	var queryString = $.param(formData); 
    	return true; 
	} 

	function inviteRResponse(responseText, statusText, xhr, $form)  { 
		if(statusText == "success"){
			alert(responseText);
			 $("#invitefriends-dialog" + '<?php echo $_SESSION['user']->guid?>' ).dialog("close");
			$("#iconsubmit").show();
			$("#iconsubmitting").hide();
		}	
	} 
	function inviteformsubmit(){
		$('#invitefriends_form').ajaxForm(options2); 
	}

</script>

<div class="contentWrapper notitle">
<form action="<?php echo $vars['url']; ?>action/invitefriends/invitecontacts" method="post"  id='invitefriends_form' >
	<?php echo elgg_view('input/securitytoken'); ?>
<h2><?php echo elgg_echo('invitefriends:heading'); ?></h2>
<br />
<p><label>
	<?php echo elgg_echo('invitefriends:from_name'); ?>
</label>
<input type='text' name='from_name' id='from_name' class="input-text" />
</p>
<p><label>
	<?php echo elgg_echo('invitefriends:from_email'); ?>
</label>
<textarea class="input-textarea" name="emails" ></textarea></p>
</p>
		<div id="iconsubmitting" style="display:none">
			 Please wait.<img style='margin:10px;' src="<?php echo $vars['url']?>_graphics/ajax_loader.gif" />
		</div>
		<div id='iconsubmit'>		
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("send"); ?>" onclick="inviteformsubmit();"  />
		</div>
</form>
</div>