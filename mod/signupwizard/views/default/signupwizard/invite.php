<?php

	/**
	 * Elgg Invite Friends
	 *
	 * @package ElggProfile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 *
	 * @uses $vars['entity'] The user entity
	 */

	// wrap all profile info
	echo "<div id=\"register-box\">";

?>

<table cellspacing="0">
<tr>
<td>



	<h3><?php echo elgg_echo("Connect with your Friends and Family")?></h3>

	<p><?php echo elgg_echo("Many of your friends and family members may already be here. Check who is on Qlyfe")?> </p>
	
	<br>
	
	
	<b><?php echo elgg_echo("Your Email")?></b> : 
<?php echo elgg_view('input/text' , array('internalname' => 'email', 'class' => "general-textarea", 'value' => $email))?>

<br />

<?php echo elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('Find Friends and Family'))) ?>

<br />

	
	<p><?php echo elgg_echo("Qlyfe does not store your password")?></p>
	
	<br />
	<p><b><a href="<?php echo $vars['url']; ?>pg/signupwizard/addicon/"><?php echo elgg_echo("Skip this step")?></a></b></p>	

<br />
	
	<p><b>Import Facebook Friends and put them in groups </b></p>

</td>
</tr>
</table>

</div><!-- /#profile_info -->
