<?php 

// Get the Elgg engine
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

// Ensure that only logged-in users can see this page
gatekeeper();

$user = $_SESSION['user'];

$id = get_input("id");
$name = get_input("name");

if ($id) {
	$circle = $user->getConnectedTo("", 9999, 0, "friends/$name");
}

?>
<input type="hidden" name="id" value="<?php echo $id?>"/>
<center>
	<label>Name: <input type="text" name="name" value="<?php echo ($name ? $name : elgg_echo('friends:circle')) ?>"/></label>
	<br/><br/>

	<?php echo elgg_view("input/userchooser", array("header1"=>elgg_echo("friends:circle:outside"), "header2"=>elgg_echo("friends:circle:inside"), "users"=>$circle))?>

	<br/>
	<label style='font-size:9pt;font-weight:normal;'><input type="checkbox" name="share" value="true"></input> <?php echo elgg_echo("friends:circle:share")?></label>
	<br/>
	<?php if ($id) { ?>
	<input value="<?php echo elgg_echo("friends:circle:button:update")?>" type="button" class="submit_button" onclick="createFriendsCircle()"/>
	<?php } else  { ?>
	<input value="<?php echo elgg_echo("friends:circle:button:create")?>" type="button" class="submit_button" onclick="createFriendsCircle()"/>
	<?php } ?>
	<input value="<?php echo elgg_echo("friends:circle:button:cancel")?>" type="button" class="cancel_button" onclick="$('#create-friends-circle').dialog('close');"/>
</center>
