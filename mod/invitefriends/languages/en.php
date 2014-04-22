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

	$english = array(

		'invitefriends:invite' => 'Invite friends',
		'friends:invite' => 'Invite friends',
		'invitefriends:from_name' => 'From Name',		
		'invitefriends:from_email' => 'Enter Email addresses below (one per line):',				
		'invitefriends:heading' => 'To invite friends to join Qlyfe as a beta tester',
		'invitefriends:introduction' => 'To invite friends to join you on this network, enter their email addresses below (one per line):',
		'invitefriends:message' => 'Enter a message they will receive with your invitation:',
		'invitefriends:subject' => 'Qlyfe Invitation %s',
	
		'invitefriends:success' => 'Your friends were invited.',
		'invitefriends:email_error' => 'Invitations were sent, but the following addresses are not valid: %s',
		'invitefriends:subemail_error' => 'Invitations were sent, but the following email addresses are already sent : %s',		
		'invitefriends:failure' => 'Your friends could not be invited.',
		'invitefriends:enteremails' => 'Please enter Emails.',		
		'invitefriends:enterfromname' => 'Please enter From Name.',				
		'invitefriends:invitecode' => 'Please enter valid invite code.',						
		'invitefriends:invite_by_code' => 'Invite By Code',

		'invitefriends:emailmessage:default' => '
%s has invited you to join Qlyfe as a beta tester.  Click on the link below to register:

%s

Your invite code is: %s
		
',
		'invitefriends:message:default' => '
Hi,

I want to invite you to join my network here on %s.',
		'invitefriends:email' => '
You have been invited to join %s by %s. They included the following message:

%s

To join, click the following link:

%s

You will automatically add them as a friend when you create your account.',


	
	);
					
	add_translation("en",$english);
?>
