<?php 
	$entity = $vars['entity'];
	$currentuser = $_SESSION['user'];
	$network = $vars['network'];
	$iscrop = $vars['iscrop'];
	$isall = $vars['isall'];	
				
	$user_avatar = $currentuser->getIcon('medium',$network);

		$ts = time();
		$token = generate_action_token($ts);
		$t_url = "&__elgg_token=$token&__elgg_ts=$ts";
	
?>
<div class="contentWrapper">
<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/profile/views/default/js/jquery.imgareaselect-0.8.min.js"></script>
<?php if($iscrop != 1) { ?>	
	<script language="javascript1.2">
	var options2 = { 
        beforeSubmit:  uploadRequest,  // pre-submit callback 
        success:       uploadResponse  // post-submit callback 
    }; 

	function uploadRequest(formData, jqForm, options2) { 
		if($("#profileicon").val() == "" ){
			alert('Please select file to upload');
			$("#profileicon").focus();
			return false;
		}
		$("#iconsubmit").hide();
		$("#iconsubmitting").show();
//    	var queryString = $.param(formData); 
    	return true; 
	} 

	function uploadResponse(responseText, statusText, xhr, $form)  { 
		if(statusText == "success"){
    	    //alert('Picture successfully uploaded' ); 
//			alert(responseText);
			var src2 = $("#icon_" + "<?php echo $network?>").attr("src");
			src2 = responseText;
			src2= src2.replace(/\&amp;/g,'&');
			$("#icon_" + "<?php echo $network?>").attr("src", src2); 			
//			 $("#signup-dialog" + '<?php echo $currentuser->guid?>' ).dialog("close");
			$("#signup-dialog" + '<?php echo $currentuser->guid?>' + "-contents").load("<?php echo $vars['url']?>connect/icondialog.php?iscrop=1&network=" + '<?php echo $network?>' + '&isall=' + '<?php echo $isall?>');
		}	
	} 
	function uploadIcon(){
		$('#signup_icon_upload').ajaxForm(options2); 
	}

</script>
<div id="picture_upload_form">
<div id="current_user_avatar">

	<label><?php echo elgg_echo('profile:currentavatar'); ?></label>
	<?php 
		echo "<img src=\"{$user_avatar}\" alt=\"avatar\" />";
	?>

</div>
<div id="profile_picture_form">
	<form action="<?php echo $vars['url']; ?>action/profile/iconupload" method="post" enctype="multipart/form-data" id='signup_icon_upload' >
	<?php echo elgg_view('input/securitytoken'); ?>
	<p><label><?php echo elgg_echo("profile:editicon"); ?></label><br />
		<?php
			echo elgg_view("input/file",array('internalname' => 'profileicon','internalid' => 'profileicon'));
		?>
	
		<br />
		<div id="iconsubmitting" style="display:none">
			Picture Uploading. Please wait.<img style='margin:10px;' src="<?php echo $vars['url']?>_graphics/ajax_loader.gif" />
		</div>
		<div id='iconsubmit'>		
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("upload"); ?>" onclick="uploadIcon();"  />
		<input id="signup_cancel_button" onclick='signupDialog.cancel()' type='button' class='cancel_button' value="<?php echo elgg_echo("cancel")?>">
		</div>
	</p>
	<input type='hidden' name='network' value="<?php print $network?>">
	<input type='hidden' name='isall' value="<?php print $isall?>">	
	</form>
</div>
</div>

<? } 
if(strstr($user_avatar,"icondirect")){
?>

<div id="profile_picture_croppingtool">	
<label><?php echo elgg_echo('profile:profilepicturecroppingtool'); ?></label><br />
<p>	
<?php
    echo elgg_echo("profile:createicon:instructions");
    $user_master_image = $currentuser->getIcon('master',$network);
?>
</p>
<script type="text/javascript">
    //function to display a preview of the users cropped section
    function preview(img, selection) {
		// catch for the first click on the image
		if (selection.width == 0 || selection.height == 0) {
			return;
		}
		
        var origWidth = $("#user_avatar").width(); //get the width of the users master photo
        var origHeight = $("#user_avatar").height(); //get the height of the users master photo
        var scaleX = 100 / selection.width; 
        var scaleY = 100 / selection.height; 
        $('#user_avatar_preview > img').css({ 
            width: Math.round(scaleX * origWidth) + 'px', 
            height: Math.round(scaleY * origHeight) + 'px', 
            marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
            marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
         }); 
    } 
        
    //variables for the newly cropped avatar
    //var $x1, $y1, $x2, $y2, $w, $h;
        
        function selectChange(img, selection){
           
           //populate the form with the correct coordinates once a user has cropped their image
           $('#x_1').val(selection.x1);
           $('#x_2').val(selection.x2);
           $('#y_1').val(selection.y1);
           $('#y_2').val(selection.y2);
           
         }     
         
        $(document).ready(function () {
            
            //get the coordinates from the form
            /*
            var x_1 = $('#x_1').val();
            var x_2 = $('#x_2').val();
            var y_1 = $('#y_1').val();
            var y_2 = $('#y_2').val();
            var w = x_2 - x_1;
            var h = y_2 - y_1;
            selection = { x1: x_1, y1: y_1, x2: x_2, y2: y_2, width: w, height: h };
            */
            
            $('<div id="user_avatar_preview"><img src="<?php echo $user_master_image; ?>" /></div>') 
            .insertAfter($('#user_avatar'));
            
            $('<div id="user_avatar_preview_title"><label><?php echo elgg_echo('profile:preview'); ?></label></div>').insertBefore($('#user_avatar_preview'));

// new added
            $('#user_avatar').imgAreaSelect({ selectionOpacity: 0,onSelectEnd: selectChange });
//            $('#user_avatar').imgAreaSelect({ selectionOpacity: 0,x1:50,y1:50,x2:$('#user_avatar').width()-50,y2:$('#user_avatar').height()-50 , onSelectEnd: selectChange });
			
            //show the preview
            $('#user_avatar').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview });
		
/*	        var selection2 = { x1: 50, y1: 50, x2: $('#user_avatar').width()-50, y2: $('#user_avatar').height()-50, width: $('#user_avatar').width(), height: $('#user_avatar').height() };
			
			selectChange($('#user_avatar'),selection2);
			preview($('#user_avatar'),selection2);
*/
        }); 
        
 	var options3 = { 
        beforeSubmit:  cropRequest,  // pre-submit callback 
        success:       cropResponse  // post-submit callback 
    }; 

	function cropRequest(formData, jqForm, options2) { 
		$("#cropsubmit").hide();
		$("#cropsubmitting").show();
    	return true; 
	} 

	function cropResponse(responseText, statusText, xhr, $form)  { 
		if(statusText == "success"){
			var src2 = $("#icon_" + "<?php echo $network?>").attr("src");
			var currentTime = new Date();
			src2 = src2 + "&lastcache="+currentTime;
			$("#icon_" + "<?php echo $network?>").attr("src", src2); 
			 $("#signup-dialog" + '<?php echo $currentuser->guid?>' ).dialog("close");
		}	
	} 
	function cropIcon(){
		$('#signup_icon_crop').ajaxForm(options3); 
	}

</script>

<p>
<img id="user_avatar" src="<?php echo $user_master_image; ?>" alt="<?php echo elgg_echo("profile:icon"); ?>" />
</p>

<div class="clearfloat"></div>

<form action="<?php echo $vars['url']; ?>action/profile/cropicon" method="post" id='signup_icon_crop' >
	<?php echo elgg_view('input/securitytoken'); ?>
	<input type="hidden" name="x_1" value="<?php echo $vars['user']->x1; ?>" id="x_1" />
    <input type="hidden" name="x_2" value="<?php echo $vars['user']->x2; ?>" id="x_2" />
    <input type="hidden" name="y_1" value="<?php echo $vars['user']->y1; ?>" id="y_1" />
    <input type="hidden" name="y_2" value="<?php echo $vars['user']->y2; ?>" id="y_2" />
	<input type='hidden' name='network' value="<?php echo $network; ?>">	
	
	<?php if($isall == "yes"){ ?>
		<input type='hidden' name='isall' value="<?php print $isall?>">			
	<? }else{ ?>	
		<input type='checkbox' name='isall' value="yes"> <?php echo elgg_echo("profile:replaceallphoto"); ?>		
	<? } ?>	
	
	<div id='cropsubmit'>		
	<input type="submit" class="submit_button"  value="<?php echo elgg_echo("profile:createicon"); ?>" onClick='cropIcon();' />
&nbsp;
	<input id="signup_cancel_button" onclick='signupDialog.cancel()' type='button' class='cancel_button' value="<?php echo elgg_echo("cancel")?>">	
	</div>
		<div id="cropsubmitting" style="display:none">
			Picture Uploading. Please wait.<img style='margin:10px;' src="<?php echo $vars['url']?>_graphics/ajax_loader.gif" />
		</div>
	
</form>

</div>
<? } ?>
<div class="clearfloat"></div>

</div>


