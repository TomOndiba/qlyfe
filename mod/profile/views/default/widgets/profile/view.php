<?php 

	$on_loggedin_user = false;
	
	$user = get_user_by_username(get_input('username'));
	if ($user->guid == get_loggedin_userid()) {
		$on_loggedin_user = true;
	}
	
	if ($on_loggedin_user)
		$url = "{$vars['url']}pg/profile/{$user->username}/editicon";
	else
		$url = "javascript:showuser()";

?>

<div style="position:relative;top:-31px;">

<div id="identity_tab" style='border-bottom: 1px solid #ffffff;'>
	<?php if ($on_loggedin_user) {
	    echo elgg_echo("profile:identity");
	} else if ($user->gender) {
    	echo sprintf(elgg_echo("profile:identity:notyou"), elgg_echo("gender:{$user->gender}:posessive"));
	} else {
    	echo elgg_echo("profile:identity:generic");
	} ?>
</div>

<?php

	/**
	 * @uses $vars['entity'] The user entity
	 */

	echo "<div id='identity_widget'>";

	$tabcheck = get_context();

	function icon_td($url,$user,$size,$network,$name,$title, $right_line = false){
		if ($right_line)
			return "<td class='{$size}_icon_td' align='center' style='border-right: 1px dashed #ccc; text-align:center;padding-bottom:4px;padding-top:4px;'>" . getDisIcon($url, $user, $size, $network, $name, $title). "</td>";
		else
			return "<td class='{$size}_icon_td' align='center' style='text-align:center;padding-bottom:4px;padding-top:4px;'>" . getDisIcon($url, $user, $size, $network, $name, $title). "</td>";
	}
	
	function getDisIcon($url,$user,$size,$network,$name,$title){
		$string = "";
		
		if($title != "")
			$string .= "<h6 class='profile_networks'>$title</h6>";		
		$string .= "<a href='$url'>";	
		$string .= elgg_view("profile/icon", array(
										'entity' => $user,
										'size' => $size,
										'network' => $network,										
										'override' => true,
									));
		$string .= "</a>";								
		if($name != "")
			$string .= "<h5 class='profile_networks'>$name</h5>";		
		return $string;
	}

	echo "<center>";
if ($on_loggedin_user){

		// @todo QLYFE .. do this using qlyfe_get_networks()
		// whoever adds the next network is responsible to REWRITE THIS!
		//$networks = qlyfe_get_networks();
	
		$name_friends = $user->getName('friends');
		$name_family = $user->getName('family');
		$name_public = $user->getName('public');		
	if($tabcheck == "home"){
		$sh1 = compareIconFiles($_SESSION['user'],'friends','family');
		$sh2 = compareIconFiles($_SESSION['user'],'public','friends');				
		$sh3 = compareIconFiles($_SESSION['user'],'public','family');		
		
	 	echo "<table width='100%'><tr>";	
		if( ($name_friends == $name_family && $sh1) || ($name_friends == $name_public && $sh2) || ($name_public == $name_family  && $sh3 ) ){
			if($name_friends == $name_family && $name_friends == $name_public && $sh1 && $sh2 && $sh3){
				echo icon_td($url,$user,"large","friends",$name_friends,"Friends, Family & Public");
			}else if($name_friends == $name_family && $sh1 ){	
				echo icon_td($url,$user,"medium","friends",$name_friends,"Friends & Family", true);			
				echo icon_td($url,$user,"medium","public",$name_public,"Public");		
			}else if($name_friends == $name_public && $sh2){	
				echo icon_td($url,$user,"medium","friends",$name_friends,"Friends & Public", true);			
				echo icon_td($url,$user,"medium","family",$name_family,"Family");		
			}else if($name_public == $name_family  && $sh3 ){	
				echo icon_td($url,$user,"medium","friends",$name_friends,"Friends", true);			
				echo icon_td($url,$user,"medium","family",$name_family,"Family & Public");			
			}	
		}else{
			echo icon_td($url,$user,"medium","friends",$name_friends,"Friends", true);			
			echo icon_td($url,$user,"medium","family",$name_family,"Family");			
			echo "</tr><tr>";
			echo "<td style='border-top:1px dashed #ccc'></td>";					
			echo "<td style='border-top:1px dashed #ccc'></td>";					
			echo "</tr><tr>";
			echo icon_td($url,$user,"medium","public",$name_public,"Public", true);		
		}
		echo "</tr></table>";		
	}else if($tabcheck == "friends"){
		echo "<div class='large_icon_td'>" . getDisIcon($url,$user,"large","friends",$name_friends,"Friends") . "</div>";
	}else if($tabcheck == "family"){
		echo "<a href='$url'>";
		echo "<div class='large_icon_td'>" . getDisIcon($url,$user,"large","family",$name_family,"Family") . "</div>";		
    }else{
	 	$flag = 1;
	}
  }else{
	$flag = 1;	
  }

	if($flag == 1){
		//echo "username is {$user->name}";
		echo "<div class='large_icon_td'>" . getDisIcon($url,$user,"large","",$user->name,"") . "</div>";		
	}
	
	echo elgg_view("profile/profilelinks", array("entity" => $user));
	
	echo "</center>";
	echo "</div>";
?>	
</div>		
			
<div title='About <?php echo $user->name?>' style='display:none;' id='<?php echo $user->username?>'>
	<?php echo elgg_view_entity($user,true);?>
</div>
			
<script language='javascript'>
	$(document).ready(function () {
		$('#<?php echo $user->username?>').dialog({modal:true, width:'600px',autoOpen:false});
	});
	function showuser() {
		$('#<?php echo $user->username?>').dialog('open');
	}
</script>

<?php
// First time Login
	if (false) {
	//if($on_loggedin_user && $_SESSION['firstlogincheck'] == "yes"){
		global $_SESSION;
		$_SESSION['firstlogincheck'] = "";
		unset($_SESSION['firstlogincheck']);
		
?>

	<div id="importfriends-dialog<?php echo $user->guid?>" title="<?php echo elgg_echo("signupwizard:importfriends")?>" style='display:none;'>
		<div id="importfriends-dialog<?php echo $user->guid?>-contents">
		<?php echo elgg_view("signupwizard/importfriends", array('entity' => $user));?>
		</div>
	</div><!--  end of the dialog -->
<script language='javascript'>
	function importfriendsbox() {
		$("#importfriends-dialog" + '<?php echo $user->guid?>' ).dialog({modal: true,width: 700,autoOpen:false});		
		$("#importfriends-dialog" + '<?php echo $user->guid?>' ).dialog('open');
	}
	importfriendsbox();
</script>	

	<div id="firsttime-dialog<?php echo $user->guid?>" title="<?php echo elgg_echo("firsttime:identity")?>" style='display:none;'>
		<div id="firsttime-dialog<?php echo $user->guid?>-contents">
		<?php echo elgg_view("profile/editicon", array('entity' => $user,"firstlogin"=>"yes"));?>
		</div>
	</div><!--  end of the dialog -->
<script language='javascript'>
	function firsttimelogin() {
		$("#firsttime-dialog" + '<?php echo $user->guid?>' ).dialog({modal: true,width: 800,autoOpen:false});		
		$("#firsttime-dialog" + '<?php echo $user->guid?>' ).dialog('open');
	}
	function firsttimedialogclose() {
		$("#firsttime-dialog" + '<?php echo $user->guid?>' ).dialog('close');
	}
	firsttimelogin();
</script>
<?php
	}	

?>
