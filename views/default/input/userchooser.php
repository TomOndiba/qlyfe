<?php 
	/**
	 * Choose users to do something with
	 * @users $vars['classifier']
	 */
	$classifier = $vars['classifier'];
	
	$header1 = $vars['header1'];
	$header2 = $vars['header2'];
	
	$users = $vars['users'];
	
	$user = get_loggedin_user();
	
	$connections = $user->getConnectedTo($classifier);
	
	$inside_guids = "";
	foreach ($users as $inside)
		$inside_guids .= $inside->guid . ",";
	
	function userchooser_inside_users_list($user1, $list) {
		if (!$list) return false;
		foreach ($list as $user2) {
			if ($user1->guid == $user2->guid) return true;
		}
		return false;
	}
?>

<input id="userchooser-value" type="hidden" name="userchooser" value="<?php echo $inside_guids?>"/>

<script language="javascript">
function userchooser_move(guid) {
	var user = $("#user-" + guid);

	var value = $("#userchooser-value").val();
	
	if (user.parent().attr("id") == "userchooser-from") {
		value = value + guid + ",";
		user.remove();
		user.appendTo($("#userchooser-to"));
	} else {
		value = value.replace(guid + ",", "");
		user.remove();
		user.appendTo($("#userchooser-from"));
	}

	// set the new value
	$("#userchooser-value").val(value);
}
</script>

<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
	<td>
		<center><h4><?php echo $header1?></h4></center>
		<div id='userchooser-from' class="userchooser_box">
		<?php 
			foreach ($connections as $connection) {
				if (!userchooser_inside_users_list($connection, $users)) {
					echo "<div class='userchooser_user' id='user-{$connection->guid}'>";
					echo elgg_view("profile/icon",array('href'=>"javascript:userchooser_move('{$connection->guid}')", 'entity' => get_user($connection->guid), 'label'=> $connection->username, 'size' => 'tiny'));
					echo "</div>";
				}
			}
		?>
		</div> 
	</td>
	<td valign="middle" style='font-size:40pt;'>
		=&gt;
		<br/><br/>
		&lt;=
	</td>
	<td>
		<center><h4><?php echo $header2?></h4></center>
		<div id='userchooser-to' class="userchooser_box">
		<?php 
			foreach ($connections as $connection) {
				if (userchooser_inside_users_list($connection, $users)) {
					echo "<div class='userchooser_user' id='user-{$connection->guid}'>";
					echo elgg_view("profile/icon",array('href'=>"javascript:userchooser_move('{$connection->guid}')", 'entity' => get_user($connection->guid), 'label'=> $connection->username, 'size' => 'tiny'));
					echo "</div>";
				}
			}
		?>
		</div>
	</td>
</tr>
</table>