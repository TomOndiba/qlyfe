<?php

	$english = array(
	
		'context:friends' => 'Friends',
		'context:friends:title' => 'Friends',
	
		/**
		 * Friends widget
		 */
			'friends:widget:description' => "Displays some of your friends.",
			'friends:friend' => "Friend",

			'friends:connectdialog:choose_closeness' => "%s is my (please choose one):",	
			'friends:connectdialog:add_to_circle' => "Would you like to add her to a friends circle?",	
			'friends:connectdialog:no_more_circles' => "Done",
			'friends:connectdialog:yes_circle' => "yes",
			'friends:connectdialog:no_circle' => "no",
	
		'friends:contextlinks:list' => 'show all',
		'friends:contextlinks:edit' => 'edit',
		'friends:contextlinks:delete' => 'delete',
	
		/**
		 * Circles
		 */
		'friends:circle:create' => "New Friends Circle",
		'friends:circle' => "Friends Circle",
		'friends:circle:share' => "share this with other members of the circle",
		'friends:circle:outside' => "Outside this Circle",
		'friends:circle:inside' => "Inside this Circle",
		'friends:circle:successfully_created' => "Friends circle '%s' successfully created",
		'friends:circle:successfully_updated' => "Friends circle '%s' successfully updated",
		'friends:circle:successfully_deleted' => "Friends circle '%s' successfully deleted",
		'friends:circle:error:reserved' => "The names 'bf', 'f', and 'a' are reserved",
		'friends:circle:error:nousers' => "You need to select at least one user",
		'friends:circle:error:exists' => "The friends circle named '%s' already exists",
		'friends:circle:error:empty' => "Empty circle names are not permitted",
		'friends:circle:error:badcharacters' => "Only a-z A-Z 0-9 - _ and ' are permitted in your circle name",
		'friends:circle:button:create' => 'Create',
		'friends:circle:button:update' => 'Update',
		'friends:circle:button:cancel' => 'Cancel',
	
		/**
		 * Classifiers
		 */
		'classifier:friends/bf' => 'Close Friends',
		'classifier:friends/f' => 'Normal Friends',
		'classifier:friends/a' => 'Acquaintances',
		'classifier:friends' => 'All Friends',
		
		'classifier:friends/bf:singular' => 'Close Friend',
		'classifier:friends/f:singular' => 'Normal Friend',
		'classifier:friends/a:singular' => 'Acquaintance',
		'classifier:friends:singular' => 'Friend',

	
		'friends:add:successful' => "You have successfully added %s as a friend.",
		'friends:add:failure' => "We couldn't add %s as a friend. Please try again.",
	
		/**
		 * Email notifications
		 */
	'friends:connect:notification:subject' => "%s has made you a friend!",
	'friends:connect:notification:body' => "%s has made you a friend!

To view their profile, click here:

%s

You cannot reply to this email.",


	
	
	'friends' => "Friends",
	'friends:yours' => "Your friends",
	'friends:owned' => "%s - %s",
	'friend:add' => "Add friend",
	'friend:remove' => "Remove friend",


	'friends:none' => "This user hasn't added anyone as a friend yet.",
	'friends:none:you' => "You haven't added anyone as a friend! Search for your interests to begin finding people to follow.",

	'friends:none:found' => "No friends were found.",

	'friends:of:none' => "Nobody has added this user as a friend yet.",
	'friends:of:none:you' => "Nobody has added you as a friend yet. Start adding content and fill in your profile to let people find you!",

	'friends:of:owned' => "People who have made %s a friend",

	'friends:num_display' => "Number of friends to display",
	'friends:icon_size' => "Icon size",
	'friends:tiny' => "tiny",
	'friends:small' => "small",
	'friends:of' => "Friends of",
	'friends:collections' => "Collections of friends",
	'friends:collections:add' => "New friends collection",
	'friends:addfriends' => "Add friends",
	'friends:collectionname' => "Collection name",
	'friends:collectionfriends' => "Friends in collection",
	'friends:collectionedit' => "Edit this collection",
	'friends:nocollections' => "You do not yet have any collections.",
	'friends:collectiondeleted' => "Your collection has been deleted.",
	'friends:collectiondeletefailed' => "We were unable to delete the collection. Either you don't have permission, or some other problem has occurred.",
	'friends:collectionadded' => "Your collection was successfuly created",
	'friends:nocollectionname' => "You need to give your collection a name before it can be created.",
	'friends:collections:members' => "Collection members",
	'friends:collections:edit' => "Edit collection",

	'friends:river:created' => "%s added the friends widget.",
	'friends:river:updated' => "%s updated their friends widget.",
	'friends:river:delete' => "%s removed their friends widget.",
	'friends:river:add' => "%s is now a friend with",

	'friendspicker:chararray' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	
	
	
	);
					
	add_translation("en",$english);

?>