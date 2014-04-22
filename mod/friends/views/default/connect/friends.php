<script language='javascript'>
/** connect dialog **/
function connectAsFriends() {
	if ($("#friends_connect_cb").is(":checked")) {
		$('#connect_as_friends').slideDown();
		connectDialog.showing('friends');
	} else {
		$('#connect_as_friends').slideUp();
		connectDialog.not_showing('friends');
	}
}
function classifyFriendship(cls, circles) {
	$('#friend_label').text($("#classify_" + cls.replace("/", "_")).text());
	$('#connect_as_friends').slideUp();
	$("#friends_classifier").val(cls);
	if (circles) {
		$('#friends_circle_connect').slideDown();
	} else {
		connectDialog.not_showing('friends');
	}
}
function classifyFriendshipCircle(id, name) {
	var circletext = $("#" + id).text();
	$('#friend_label').html($('#friend_label').html() + " <span id='add_circle_" + id + "' style='padding-left:20px;font-size:8pt;'>(" + name + ")</span>");
	$('#connect_as_friends').slideUp();
	$("#friends_classifier").val($("#friends_classifier").val() + ",friends/" + name);

	
}
function declassifyFriendshipCircle(id, name) {
	$("#add_circle_" + id).remove();
	$("#friends_classifier").val($("#friends_classifier").val().replace(",friends/" + name, ""));
}
function classifyFriendshipDone() {
	$('#friends_circle_connect').slideUp();
	connectDialog.not_showing('friends');
}

</script>

<?php 
	$circles = get_user_access_collections(get_loggedin_userid());
	$ifcircles = $circles ? "true" : "false";
?>

<div><!-- friends -->
	<input type="hidden" id="friends_classifier" name="friends_classifier" value=""/>
	<label><input type="checkbox" id="friends_connect_cb" name="connect_as" value="friends" onclick="connectAsFriends()"/><span id='friend_label'><?php echo elgg_echo("friends:friend")?></span></label><br/>

	<div style='margin-left:15px;display:none;' id='connect_as_friends'>
		<?php echo sprintf(elgg_echo("friends:connectdialog:choose_closeness"), $entity->name)?><br/>
		<div style='margin-left:15px;'>
		a) <a id='classify_friends_bf' href="javascript:classifyFriendship('friends/bf', <?php echo $ifcircles?>)"><?php echo elgg_echo("classifier:friends/bf:singular")?></a><br/>
		b) <a id='classify_friends_f' href="javascript:classifyFriendship('friends/f', <?php echo $ifcircles?>)"><?php echo elgg_echo("classifier:friends/f:singular")?></a><br/>
		c) <a id='classify_friends_a' href="javascript:classifyFriendship('friends/a', <?php echo $ifcircles?>)"><?php echo elgg_echo("classifier:friends/a:singular")?></a><br/>
		</div>
		<br/>
	</div>

<?php if ($circles) { ?>
	<div style='margin-left:15px;display:none;' id='friends_circle_connect'>
	<?php echo sprintf(elgg_echo("friends:connectdialog:add_to_circle"), $entity->name)?>
	<br/>
	<table style='margin-left:10px;' cellpadding="0" cellspacing="0">
	<?php 
		foreach ($circles as $circle) {
			$classifier = "friends/{$circle->name}";
			$id = "classify_" . js_friendly_classifier($classifier);
	?>
			<tr>
			<td style='padding-right:10px;'><b><?php echo $circle->name; ?></b></td>
			<td style='padding-right:10px;'>
				<label id='<?php echo $id?>' style="font-size:8pt;font-weight:normal;">
				<input type="radio" name="<?php echo $id?>" onchange='classifyFriendshipCircle("<?php echo $id?>","<?php echo $circle->name?>")' value="yes">
				<?php echo elgg_echo("friends:connectdialog:yes_circle")?>
				</label>
			</td>
			<td style='padding-right:10px;font-size:8pt;'>
				<label id='<?php echo $id?>' style="font-size:8pt;font-weight:normal;">
				<input checked="true" type="radio" name="<?php echo $id?>" onchange='declassifyFriendshipCircle("<?php echo $id?>","<?php echo $circle->name?>")' value="no">
				<?php echo elgg_echo("friends:connectdialog:no_circle")?>
				</label>
			</td>
			</tr>
	<?php 
		}
	?>
	<tr><td></td><td></td>
	<td align="right">
	<input type="button" class="submit_button" onclick='classifyFriendshipDone()' value='<?php echo elgg_echo("friends:connectdialog:no_more_circles")?>'/>
	</td>
	</tr>
	</table>
	</div>
<?php } ?>	
	
</div>
