<?php
	/**
	 * Elgg profile plugin language pack
	 *
	 * @package ElggProfile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	$english = array(

	/**
	 * Profile
	 */

		'profile' => "Profile",
		'profile:edit:default' => 'Replace profile fields',
		'profile:preview' => 'Preview',
		'profile:about' => 'About',
		'profile:aboutme' => 'About me',
	
	/**
	 * Identity
	 */
		'profile:identity' => 'My Identity',
		'profile:identity:notyou' => '%s Identity',
		'profile:identity:generic' => 'Identity',
	
	/**
	 * Profile menu items and titles
	 */

		'profile:yours' => "Your profile",
		'profile:user' => "%s's profile",

		'profile:editprofile' => "Edit your profile information<br/>And control who is allowed to see it",
		'profile:edit' => "Edit Profile Info",		
		'profile:edit:whocansee' => 'Who can see this?',
		'profile:profilepictureinstructions' => "The profile picture is the image that's displayed on your profile page. <br /> You can change it as often as you'd like. (File formats accepted: GIF, JPG or PNG)",
		'profile:icon' => "Profile picture",
		'profile:createicon' => "Create your avatar",
		'profile:currentavatar' => "Current avatar",
		'profile:profilepicturecroppingtool' => "Profile picture cropping tool",
		'profile:createicon:instructions' => "Click and drag a square below to match how you want your picture cropped.  A preview of your cropped picture will appear in the box on the right.  When you are happy with the preview, click 'Create your avatar'. This cropped image will be used throughout the site as your avatar. ",

		'profile:editdetails' => "Edit Profile Info",
		'profile:editicon' => "Edit Profile",

		'profile:personal_details' => "Personal Details",	
		'profile:firstname' => "First Name",
		'profile:lastname' => "Last Name",		
		'profile:gender' => "Gender",
		'profile:birthdate' => "Birth Date",
		'profile:description' => "About me",
		'profile:briefdescription' => "Brief description",
		'profile:location' => "Location",
		'profile:skills' => "Skills",
		'profile:interests' => "Interests",
		'profile:contactemail' => "Contact Email",
		'profile:phone' => "Home Phone",
		'profile:mobile' => "Mobile phone",
		'profile:website' => "Websites",

		'profile:banned' => 'This user account has been suspended.',
		'profile:deleteduser' => 'Deleted user',

		'profile:river:update' => "%s updated their profile",
		'profile:river:iconupdate' => "%s updated their profile icon",

		'profile:label' => "Profile label",
		'profile:type' => "Profile type",

		'profile:editdefault:fail' => 'Default profile could not be saved',
		'profile:editdefault:success' => 'Item successfully added to default profile',


		'profile:editdefault:delete:fail' => 'Removed default profile item field failed',
		'profile:editdefault:delete:success' => 'Default profile item deleted!',

		'profile:defaultprofile:reset' => 'Default system profile reset',

		'profile:resetdefault' => 'Reset default profile',
		'profile:explainchangefields' => 'You can replace the existing profile fields with your own using the form below. First you give the new profile field a label, for example, \'Favourite team\'. Next you need to select the field type, for example, tags, url, text and so on. At any time you can revert back to the default profile set up.',

		'profile:male' => 'male',
		'profile:female' => 'female',
		'profile:unknown_gender' => 'unknown',
	
	/**
	 * Profile status messages
	 */

		'profile:saved' => "Your profile was successfully saved.",
		'profile:contactsaved' => "Your contact details were successfully saved.",		
		'profile:icon:uploaded' => "Your profile picture was successfully uploaded.",
		'profile:identitysaved' => "Your identity information was successfully saved.",	

	/**
	 * Profile error messages
	 */

		'profile:noaccess' => "You do not have permission to edit this profile.",
		'profile:notfound' => "Sorry, we could not find the specified profile.",
		'profile:icon:notfound' => "Sorry, there was a problem uploading your profile picture.",
		'profile:icon:noaccess' => 'You cannot change this profile icon',
		'profile:field_too_long' => 'Cannot save your profile information because the "%s" section is too long.',

		'profile:editcontact' => 'Control who sees what',
		'profile:contact' => 'Edit Contact Info',		
		'profile:locationinfo' => "Current Location Info",	
		'profile:firstname' => "First Name",
		'profile:lastname' => "Last Name",		
		'profile:gender' => "Gender",
		'profile:birthdate' => "Birth Date",
		'profile:description' => "About Yourself",

		'profile:hometown' => "Home Town",	
		'profile:street1' => "Street Line 1",
		'profile:street2' => "Street Line 2",		
		'profile:city' => "City/Town",
		'profile:state' => "State Province",
		'profile:zip' => "Zip/Postal Code",		
		'profile:country' => "Country",				
		'profile:homecity' => "City/Town",
		'profile:homestate' => "State Province",
		'profile:homecountry' => "Country",				
		'profile:editidentity' => "Control how you want to be known to your friends, family, work and to the public",
		'profile:friendsknows' => 'Your friends know you as',
/*		'profile:bestfriendsknows' => 'Best Friends Knows You as',		
		'profile:normalfriendsknows' => 'Normal Friends Knows You as',		
		'profile:acquaintanceknows' => 'Acquaintance Knows You as',		
*/		'profile:familyknows' => 'Your family knows you as',
		'profile:publicknows' => 'The public knows you as',		
		'profile:save' => "Your profile information has been saved.",
		'profile:dialog:title' => "Your Picture",				

		'profile:addicon' => "Identity",						
		'profile:addicontitle' => "Upload your profile picture",								
		'profile:addiconmsg' => "Lets face it, in real life we interact with multiple group of people with multiple identity. Here in qlyfe you can do the same. You can use your nick name to interact with your best friends and your Real Name to interact with your family. Show different profile pictures for different groups of people. But first lets start by creating a default profile picture which will be used in all networks that you choose to.",										
		'profile:replaceallphoto' => "Replace all identity photos with this photo",
	);

	add_translation("en",$english);