<?php

	/**
	 * Elgg profile plugin upload new user icon action
	 * 
	 * @package ElggProfile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	gatekeeper();
	
	$user = $_SESSION['user'];
	
	$network = get_input('network');
	$isall = get_input('isall');	
	
	// If we were given a correct icon
		if (
				(isloggedin()) &&
				($user) &&
				($user->canEdit())
			) {
				
				$topbar = get_resized_image_from_uploaded_file('profileicon',16,16, true);
				$tiny = get_resized_image_from_uploaded_file('profileicon',25,25, true);
				$small = get_resized_image_from_uploaded_file('profileicon',40,40, true);
				$medium = get_resized_image_from_uploaded_file('profileicon',100,100, true);
				$large = get_resized_image_from_uploaded_file('profileicon',200,200);
				$master = get_resized_image_from_uploaded_file('profileicon',500,500);
				
				if ($small !== false
					&& $medium !== false
					&& $large !== false
					&& $tiny !== false) {

					$icontime = time();
					
					$filehandler = new ElggFile();
					$filehandler->owner_guid = $user->getGUID();
					$path = $filehandler->getFilenameOnFilestore("profile/" . $user->username .$network. "master.jpg");					
					$filehandler->setFilename("profile/" . $user->username .$network. "large.jpg");
					$filehandler->open("write");
					$filehandler->write($large);
					$filehandler->close();
					$filehandler->setFilename("profile/" . $user->username .$network. "medium.jpg");
					$filehandler->open("write");
					$filehandler->write($medium);
					$filehandler->close();
					$filehandler->setFilename("profile/" . $user->username .$network. "small.jpg");
					$filehandler->open("write");
					$filehandler->write($small);
					$filehandler->close();
					$filehandler->setFilename("profile/" . $user->username .$network. "tiny.jpg");
					$filehandler->open("write");
					$filehandler->write($tiny);
					$filehandler->close();
					$filehandler->setFilename("profile/" . $user->username .$network. "topbar.jpg");
					$filehandler->open("write");
					$filehandler->write($topbar);
					$filehandler->close();
					$filehandler->setFilename("profile/" . $user->username .$network. "master.jpg");
					$filehandler->open("write");
                    $filehandler->write($master);
					$filehandler->close();

					if($isall == "yes"){
						$arr = array("large","medium","small","tiny","topbar","master");
						copyIconFiles($arr,$path."profile/" . $user->username,$network,"friends");
						copyIconFiles($arr,$path."profile/" . $user->username,$network,"family");						
					}	
					
					$user->icontime = $icontime;
					
//					system_message(elgg_echo("profile:icon:uploaded"));
					
					trigger_elgg_event('profileiconupdate',$user->type,$user);
					
					ob_end_clean();
					if($isall == "yes")
						$icon = $user->getIcon('medium',$network);
					else
						$icon = $user->getIcon('small',$network);

					echo $icon;
				} else {
					system_message(elgg_echo("profile:icon:notfound"));					
				}
				
			} else {
				system_message(elgg_echo("profile:icon:notfound"));
			}
			
    
	    $url = "pg/profile/editicon/";
//		if (isloggedin()) forward($url);

?>
