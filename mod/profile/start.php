<?php

	/**
	 * Elgg profile plugin
	 *
	 * @package ElggProfile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	/**
	 * Profile init function; sets up the profile functions
	 *
	 */
		function profile_init() {

			// Get config
				global $CONFIG;
				
			//add a widget
			add_widget_type('profile',elgg_echo("profile"),"");
				

			// Register a URL handler for users - this means that profile_url()
			// will dictate the URL for all ElggUser objects
				register_entity_url_handler('profile_url','user','all');

			// Metadata on users needs to be independent
				register_metadata_as_independent('user');

				elgg_view_register_simplecache('icon/user/default/tiny');
				elgg_view_register_simplecache('icon/user/default/topbar');
				elgg_view_register_simplecache('icon/user/default/small');
				elgg_view_register_simplecache('icon/user/default/medium');
				elgg_view_register_simplecache('icon/user/default/large');
				elgg_view_register_simplecache('icon/user/default/master');


			// Register a page handler, so we can have nice URLs
				register_page_handler('profile','profile_page_handler');
				register_page_handler('defaultprofile','profileedit_page_handler');
				register_page_handler('icon','profile_icon_handler');
				register_page_handler('iconjs','profile_iconjs_handler');

			// Add Javascript reference to the page header
				elgg_extend_view('metatags','profile/metatags');
				elgg_extend_view('css','profile/css');
				elgg_extend_view('js/initialise_elgg','profile/javascript');
				if (get_context() == "profile") {
					elgg_extend_view('canvas_header/submenu','profile/submenu');
				}

			// Extend context menu with admin links
			if (isadminloggedin())
			{
					elgg_extend_view('profile/menu/links','profile/menu/adminwrapper',10000);
			}

			// Now override icons
			register_plugin_hook('entity:icon:url', 'user', 'profile_usericon_hook');

		}


		/**
		 * There is a slight hack in here to allow us to place widgets even when
		 * We're not logged in as the right person
		 * @param $guid
		 */
		function profile_set_widgets($guid) {
			$access_status = access_get_show_hidden_status();
			access_show_hidden_entities(true);
						
			setup_widgets_for_context($guid, "profile", "profile::%%messageboard%%members");
			
			access_show_hidden_entities($access_status);
			
		}		
		
	/**
	 * This function loads a set of default fields into the profile, then triggers a hook letting other plugins to edit
	 * add and delete fields.
	 *
	 * Note: This is a secondary system:init call and is run at a super low priority to guarantee that it is called after all
	 * other plugins have initialised.
	 */
		function profile_fields_setup()
		{
			global $CONFIG;

			$profile_defaults = array (
/*				'gender' => 'gender',
				'birthdate' => 'autodate',
				'description' => 'longtext',
				'briefdescription' => 'text',
				'location' => 'tags',
				'interests' => 'tags',
				'skills' => 'tags',
				'contactemail' => 'email',
				'phone' => 'text',
				'mobile' => 'text',
				'website' => 'url',*/
				'firstname' => 'text',
				'lastname' => 'text',					
				'gender' => 'gender',
				'birthdate' => 'autodate',
				'locationinfo' => 'locationinfo',
				'hometown' => 'hometown',				
				'description' => 'longtext',
			);

			// TODO: Have an admin interface for this

			$n = 0;
			$loaded_defaults = array();
			while ($translation = get_plugin_setting("admin_defined_profile_$n", 'profile'))
			{
				// Add a translation
				add_translation(get_current_language(), array("profile:admin_defined_profile_$n" => $translation));

				// Detect type
				$type = get_plugin_setting("admin_defined_profile_type_$n", 'profile');
				if (!$type) $type = 'text';

				// Set array
				$loaded_defaults["admin_defined_profile_$n"] = $type;

				$n++;
			}
			if (count($loaded_defaults)) {
				$CONFIG->profile_using_custom = true;
				$profile_defaults = $loaded_defaults;
			}

			$profilecontact_defaults = array (
				'contactemail' => 'email',
				'mobile' => 'text',
				'phone' => 'text',
				'website' => 'longtext',
			);

			$CONFIG->profilecontact = trigger_plugin_hook('profile:contactfields', 'profile', NULL, $profilecontact_defaults);

			$CONFIG->profile = trigger_plugin_hook('profile:fields', 'profile', NULL, $profile_defaults);

			// register any tag metadata names
			foreach ($CONFIG->profile as $name => $type) {
				if ($type == 'tags') {
					elgg_register_tag_metadata_name($name);
					// register a tag name translation
					add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("profile:$name")));
				}
			}
		}

	/**
	 * Profile page handler
	 *
	 * @param array $page Array of page elements, forwarded by the page handling mechanism
	 */
		function profile_page_handler($page) {

			global $CONFIG;

			// The username should be the file we're getting
			if (isset($page[0])) {
				set_input('username',$page[0]);
			}
			// Any sub pages?
			if (isset($page[1])) {
				qlyfe_set_submenu("profile");
				//set_input("showsubmenu", "profile");
				switch ($page[1])
				{
					case 'edit' : include($CONFIG->pluginspath . "profile/edit.php"); break;
					case 'editicon' : include($CONFIG->pluginspath . "profile/editicon.php"); break;
					case 'editcontact' : include($CONFIG->pluginspath . "profile/editcontact.php"); break;					
					case 'addicon' : include($CONFIG->pluginspath . "profile/addicon.php"); break;
				}
			}
			else
			{
				qlyfe_set_submenu("profile");
												
				// Include the standard profile index
				include($CONFIG->pluginspath . "profile/index.php");
			}
		}

	/**
	 * Profile edit page handler
	 *
	 * @param array $page Array of page elements, forwarded by the page handling mechanism
	 */
		function profileedit_page_handler($page) {

			global $CONFIG;

			// The username should be the file we're getting
			if (isset($page[0])) {
				switch ($page[0])
				{
					default: include($CONFIG->pluginspath . "profile/defaultprofile.php");
				}
			}

		}

	/**
	 * Pagesetup function
	 *
	 */
		function profile_pagesetup()
		{
			global $CONFIG;
			if (get_context() == 'admin' && isadminloggedin()) {

				add_submenu_item(elgg_echo('profile:edit:default'), $CONFIG->wwwroot . 'pg/defaultprofile/edit/');
			}

			//add submenu options
			if (get_context() == "profile") {
				$page_owner = page_owner_entity();

				add_submenu_item(elgg_echo('profile:editicon'), $CONFIG->wwwroot . "pg/profile/{$page_owner->username}/editicon/");
				add_submenu_item(elgg_echo('profile:editdetails'), $CONFIG->wwwroot . "pg/profile/{$page_owner->username}/edit/");
				add_submenu_item(elgg_echo('profile:contact'), $CONFIG->wwwroot . "pg/profile/{$page_owner->username}/editcontact/");				
			}
		}

	/**
	 * Profile icon page handler
	 *
	 * @param array $page Array of page elements, forwarded by the page handling mechanism
	 */
		function profile_icon_handler($page) {

			global $CONFIG;

			// The username should be the file we're getting
			if (isset($page[0])) {
				set_input('username',$page[0]);
			}
			if (isset($page[1])) {
				set_input('size',$page[1]);
			}
			// Include the standard profile index
			include($CONFIG->pluginspath . "profile/icon.php");

		}

	/**
	 * Icon JS
	 */
		function profile_iconjs_handler($page) {

			global $CONFIG;

			include($CONFIG->pluginspath . "profile/javascript.php");

		}

	/**
	 * Profile URL generator for $user->getUrl();
	 *
	 * @param ElggUser $user
	 * @return string User URL
	 */
		function profile_url($user) {
			global $CONFIG;
			return $CONFIG->wwwroot . "pg/profile/" . $user->username;
		}

	/**
	 * This hooks into the getIcon API and provides nice user icons for users where possible.
	 *
	 * @param unknown_type $hook
	 * @param unknown_type $entity_type
	 * @param unknown_type $returnvalue
	 * @param unknown_type $params
	 * @return unknown
	 */
		function profile_usericon_hook($hook, $entity_type, $returnvalue, $params)
		{
			global $CONFIG;

			if ((!$returnvalue) && ($hook == 'entity:icon:url') && ($params['entity'] instanceof ElggUser))
			{

				$entity = $params['entity'];
				$type = $entity->type;
				$subtype = get_subtype_from_id($entity->subtype);
				$viewtype = $params['viewtype'];
				$size = $params['size'];
				$username = $entity->username;
				$network = $params['network'];
				
				if ($icontime = $entity->icontime) {
					$icontime = "{$icontime}";
				} else {
					$icontime = "default";
				}

				if ($entity->isBanned()) {
					return elgg_view('icon/user/default/'.$size);
				}

				$filehandler = new ElggFile();
				$filehandler->owner_guid = $entity->getGUID();

				if($network == ""){
					$network = $_SESSION['user']->get_user_relationship($params['entity']);
				}
				//	if($network == "")
					//	$network = "public";


				$filehandler->setFilename("profile/" . $username  .$network. $size . ".jpg");

				if ($filehandler->exists()) {
					//$url = $CONFIG->url . "pg/icon/$username/$size/$icontime.jpg";
					return $CONFIG->wwwroot . 'mod/profile/icondirect.php?lastcache='.$icontime.'&username='.$entity->username.'&joindate=' . $entity->time_created . '&guid=' . $entity->guid . '&size='.$size. '&network='.$network;
				}
			}
		}

		function compareIconFiles($user,$network1,$network2)
		{
				$username = $user->username;
				$size = "small";

				$filehandler = new ElggFile();
				$filehandler->owner_guid = $user->getGUID();
				$filehandler->setFilename("profile/" . $username  .$network1. $size . ".jpg");
				$sha1 = $filehandler->get_sha1_file();

				$filehandler->setFilename("profile/" . $username  .$network2. $size . ".jpg");
				$sha2 = $filehandler->get_sha1_file();
				$filehandler->close();	
				
//				print "$sha1,$sha2 <br>";
				
				if($sha1 == $sha2)
					return true;
				else
					return false;
		}


	function copyIconFiles($arr,$path,$oldnetwork,$newnetwork){
		foreach($arr as $size){
			copy($path.$oldnetwork.$size.".jpg",$path.$newnetwork.$size.".jpg");
		}
	}					

function getCountryList(){
$countryArr[''] =  "--Select Country--";
$countryArr['AF']="Afghanistan";
$countryArr['AL']="Albania";
$countryArr['DZ']="Algeria";
$countryArr['AS']="American Samoa";
$countryArr['AD']="Andorra";
$countryArr['AO']="Angola";
$countryArr['AI']="Anguilla";
$countryArr['AQ']="Antarctica";
$countryArr['AG']="Antigua And Barbuda";
$countryArr['AR']="Argentina";
$countryArr['AM']="Armenia";
$countryArr['AW']="Aruba";
$countryArr['AU']="Australia";
$countryArr['AT']="Austria";
$countryArr['AZ']="Azerbaijan";
$countryArr['BS']="Bahamas";
$countryArr['BH']="Bahrain";
$countryArr['BD']="Bangladesh";
$countryArr['BB']="Barbados";
$countryArr['BY']="Belarus";
$countryArr['BE']="Belgium";
$countryArr['BZ']="Belize";
$countryArr['BJ']="Benin";
$countryArr['BM']="Bermuda";
$countryArr['BT']="Bhutan";
$countryArr['BO']="Bolivia";
$countryArr['BA']="Bosnia And Herzegowina";
$countryArr['BW']="Botswana";
$countryArr['BV']="Bouvet Island";
$countryArr['BR']="Brazil";
$countryArr['BN']="Brunei Darussalam";
$countryArr['BG']="Bulgaria";
$countryArr['BF']="Burkina Faso";
$countryArr['BI']="Burundi";
$countryArr['KH']="Cambodia";
$countryArr['CM']="Cameroon";
$countryArr['CA']="Canada";
$countryArr['CV']="Cape Verde";
$countryArr['KY']="Cayman Islands";
$countryArr['CF']="Central African Republic";
$countryArr['TD']="Chad";
$countryArr['CL']="Chile";
$countryArr['CN']="China";
$countryArr['CX']="Christmas Island";
$countryArr['CC']="Cocos (Keeling) Islands";
$countryArr['CO']="Colombia";
$countryArr['KM']="Comoros";
$countryArr['CG']="Congo";
$countryArr['CK']="Cook Islands";
$countryArr['CR']="Costa Rica";
$countryArr['CI']="Cote D'Ivoire";
$countryArr['HR']="Croatia";
$countryArr['CU']="Cuba";
$countryArr['CY']="Cyprus";
$countryArr['CZ']="Czech Republic";
$countryArr['DK']="Denmark";
$countryArr['DJ']="Djibouti";
$countryArr['DM']="Dominica";
$countryArr['DO']="Dominican Republic";
$countryArr['TP']="East Timor";
$countryArr['EC']="Ecuador";
$countryArr['EG']="Egypt";
$countryArr['SV']="El Salvador";
$countryArr['GQ']="Equatorial Guinea";
$countryArr['ER']="Eritrea";
$countryArr['EE']="Estonia";
$countryArr['ET']="Ethiopia";
$countryArr['FK']="Falkland Islands";
$countryArr['FO']="Faroe Islands";
$countryArr['FJ']="Fiji";
$countryArr['FI']="Finland";
$countryArr['FR']="France";
$countryArr['FX']="France, Metropolitan ";
$countryArr['GF']="French Guiana";
$countryArr['PF']="French Polynesia";
$countryArr['GA']="Gabon";
$countryArr['GM']="Gambia";
$countryArr['GE']="Georgia";
$countryArr['DE']="Germany";
$countryArr['GH']="Ghana";
$countryArr['GI']="Gibraltar";
$countryArr['GR']="Greece";
$countryArr['GL']="Greenland";
$countryArr['GD']="Grenada";
$countryArr['GP']="Guadeloupe";
$countryArr['GU']="Guam";
$countryArr['GT']="Guatemala";
$countryArr['GN']="Guinea";
$countryArr['GW']="Guinea-Bissau";
$countryArr['GY']="Guyana";
$countryArr['HT']="Haiti";
$countryArr['HN']="Honduras";
$countryArr['HK']="Hong Kong";
$countryArr['HU']="Hungary";
$countryArr['IS']="Iceland";
$countryArr['IN']="India";
$countryArr['ID']="Indonesia";
$countryArr['IR']="Iran";
$countryArr['IQ']="Iraq";
$countryArr['IE']="Ireland";
$countryArr['IL']="Israel";
$countryArr['IT']="Italy";
$countryArr['JM']="Jamaica";
$countryArr['JP']="Japan";
$countryArr['JO']="Jordan";
$countryArr['KZ']="Kazakhstan";
$countryArr['KE']="Kenya";
$countryArr['KI']="Kiribati";
$countryArr['KP']="North Korea";
$countryArr['KR']="South Korea";
$countryArr['KW']="Kuwait";
$countryArr['KG']="Kyrgyzstan";
$countryArr['LV']="Latvia";
$countryArr['LB']="Lebanon";
$countryArr['LS']="Lesotho";
$countryArr['LR']="Liberia";
$countryArr['LY']="Libyan Arab Jamahiriya";
$countryArr['LI']="Liechtenstein";
$countryArr['LT']="Lithuania";
$countryArr['LU']="Luxembourg";
$countryArr['MO']="Macau";
$countryArr['MK']="Macedonia";
$countryArr['MG']="Madagascar";
$countryArr['MW']="Malawi";
$countryArr['MY']="Malaysia";
$countryArr['MV']="Maldives";
$countryArr['ML']="Mali";
$countryArr['MT']="Malta";
$countryArr['MH']="Marshall Islands";
$countryArr['MQ']="Martinique";
$countryArr['MR']="Mauritania";
$countryArr['MU']="Mauritius";
$countryArr['YT']="Mayotte";
$countryArr['MX']="Mexico";
$countryArr['FM']="Micronesia";
$countryArr['MD']="Moldova";
$countryArr['MC']="Monaco";
$countryArr['MN']="Mongolia";
$countryArr['MS']="Montserrat";
$countryArr['MA']="Morocco";
$countryArr['MZ']="Mozambique";
$countryArr['MM']="Myanmar";
$countryArr['NA']="Namibia";
$countryArr['NR']="Nauru";
$countryArr['NP']="Nepal";
$countryArr['NL']="Netherlands";
$countryArr['AN']="Netherlands Antilles";
$countryArr['NC']="New Caledonia";
$countryArr['NZ']="New Zealand";
$countryArr['NI']="Nicaragua";
$countryArr['NE']="Niger";
$countryArr['NG']="Nigeria";
$countryArr['NU']="Niue";
$countryArr['NF']="Norfolk Island";
$countryArr['MP']="Northern Mariana Islands";
$countryArr['NO']="Norway";
$countryArr['OM']="Oman";
$countryArr['PK']="Pakistan";
$countryArr['PW']="Palau";
$countryArr['PA']="Panama";
$countryArr['PG']="Papua New Guinea";
$countryArr['PY']="Paraguay";
$countryArr['PE']="Peru";
$countryArr['PH']="Philippines";
$countryArr['PN']="Pitcairn";
$countryArr['PL']="Poland";
$countryArr['PT']="Portugal";
$countryArr['PR']="Puerto Rico";
$countryArr['QA']="Qatar";
$countryArr['RE']="Reunion";
$countryArr['RO']="Romania";
$countryArr['RU']="Russian Federation";
$countryArr['RW']="Rwanda";
$countryArr['KN']="Saint Kitts And Nevis";
$countryArr['LC']="Saint Lucia";
$countryArr['WS']="Samoa";
$countryArr['SM']="San Marino";
$countryArr['ST']="Sao Tome And Principe";
$countryArr['SA']="Saudi Arabia";
$countryArr['SN']="Senegal";
$countryArr['SC']="Seychelles";
$countryArr['SL']="Sierra Leone";
$countryArr['SG']="Singapore";
$countryArr['SK']="Slovakia";
$countryArr['SI']="Slovenia";
$countryArr['SB']="Solomon Islands";
$countryArr['SO']="Somalia";
$countryArr['ZA']="South Africa";
$countryArr['GS']="South Georgia ";
$countryArr['ES']="Spain";
$countryArr['LK']="Sri Lanka";
$countryArr['SH']="St Helena";
$countryArr['PM']="St Pierre and Miquelon";
$countryArr['SD']="Sudan";
$countryArr['SR']="Suriname";
$countryArr['SZ']="Swaziland";
$countryArr['SE']="Sweden";
$countryArr['CH']="Switzerland";
$countryArr['SY']="Syrian Arab Republic";
$countryArr['TW']="Taiwan";
$countryArr['TJ']="Tajikistan";
$countryArr['TZ']="Tanzania";
$countryArr['TH']="Thailand";
$countryArr['TG']="Togo";
$countryArr['TK']="Tokelau";
$countryArr['TO']="Tonga";
$countryArr['TT']="Trinidad And Tobago";
$countryArr['TN']="Tunisia";
$countryArr['TR']="Turkey";
$countryArr['TM']="Turkmenistan";
$countryArr['TC']="Turks And Caicos Islands";
$countryArr['TV']="Tuvalu";
$countryArr['UG']="Uganda";
$countryArr['UA']="Ukraine";
$countryArr['AE']="United Arab Emirates";
$countryArr['GB']="United Kingdom/Great Britain";
$countryArr['US']="United States";
$countryArr['UY']="Uruguay";
$countryArr['UZ']="Uzbekistan";
$countryArr['VU']="Vanuatu";
$countryArr['VA']="Vatican City State";
$countryArr['VE']="Venezuela";
$countryArr['VN']="Viet Nam";
$countryArr['VG']="Virgin Islands (British)";
$countryArr['VI']="Virgin Islands (U.S.)";
$countryArr['WF']="Wallis And Futuna Islands";
$countryArr['EH']="Western Sahara";
$countryArr['YE']="Yemen";
$countryArr['ZR']="Zaire";
$countryArr['ZM']="Zambia";
$countryArr['ZW']="Zimbabwe";
$countryArr['ZZ']="Other-Not Shown";

return $countryArr;
}

function getStateList($country="US"){
$stateArr[''] =  "--Select--";
$stateArr['AL'] =  "Alabama";
$stateArr['AK'] =  "Alaska";
$stateArr['AZ'] =  "Arizona";
$stateArr['AR'] =  "Arkansas";
$stateArr['CA'] =  "California";
$stateArr['CO'] =  "Colorado";
$stateArr['CT'] =  "Connecticut";
$stateArr['DC'] =  "Delaware";
$stateArr['FA'] =  "Florida";
$stateArr['GA'] =  "Georgia";
$stateArr['HI'] =  "Hawaii";
$stateArr['ID'] =  "Idaho";
$stateArr['IL'] =  "Illinois";
$stateArr['IN'] =  "Indiana";
$stateArr['IA'] =  "Iowa";
$stateArr['KS'] =  "Kansas";
$stateArr['KY'] =  "Kentucky"; 
$stateArr['LA'] =  "Louisiana"; 
$stateArr['ME'] =  "Maine";
$stateArr['MD'] =  "Maryland";
$stateArr['MA'] =  "Massachusetts";
$stateArr['MI'] =  "Michigan";
$stateArr['MN'] =  "Minnesota";
$stateArr['MS'] =  "Mississippi";
$stateArr['MO'] =  "Missouri";
$stateArr['MT'] =  "Montana";
$stateArr['NE'] =  "Nebraska";
$stateArr['NV'] =  "Nevada";
$stateArr['NH'] =  "New Hampshire";
$stateArr['NJ'] =  "New Jersey";
$stateArr['NM'] =  "New Mexico";
$stateArr['NY'] =  "New York";
$stateArr['NC'] =  "North Carolina";
$stateArr['ND'] =  "North Dakota";
$stateArr['OH'] =  "Ohio";
$stateArr['OK'] =  "Oklahoma"; 
$stateArr['OR'] =  "Oregon";
$stateArr['PA'] =  "Pennsylvania";
$stateArr['RI'] =  "Rhode Island";
$stateArr['SC'] =  "South Carolina";
$stateArr['SD'] =  "South Dakota";
$stateArr['TN'] =  "Tennessee";
$stateArr['TX'] =  "Texas";
$stateArr['UT'] =  "Utah";
$stateArr['VT'] =  "Vermont";
$stateArr['VA'] =  "Virginia";
$stateArr['WA'] =  "Washington";
$stateArr['WV'] =  "West Virginia";
$stateArr['WI'] =  "Wisconsin";
$stateArr['WY'] =  "Wyoming";

return $stateArr;
}

	// Make sure the profile initialisation function is called on initialisation
		register_elgg_event_handler('init','system','profile_init',1);
		register_elgg_event_handler('init','system','profile_fields_setup', 10000); // Ensure this runs after other plugins

		register_elgg_event_handler('pagesetup','system','profile_pagesetup');
		register_elgg_event_handler('profileupdate','all','object_notifications');


	// Register actions
		global $CONFIG;
		register_action("profile/edit",false,$CONFIG->pluginspath . "profile/actions/edit.php");
		register_action("profile/editicon",false,$CONFIG->pluginspath . "profile/actions/editicon.php");				
		register_action("profile/editcontact",false,$CONFIG->pluginspath . "profile/actions/editcontact.php");		
		register_action("profile/iconupload",false,$CONFIG->pluginspath . "profile/actions/iconupload.php");
		register_action("profile/cropicon",false,$CONFIG->pluginspath . "profile/actions/cropicon.php");
		register_action("profile/editdefault",false,$CONFIG->pluginspath . "profile/actions/editdefault.php", true);
		register_action("profile/editdefault/delete",false,$CONFIG->pluginspath . "profile/actions/deletedefaultprofileitem.php", true);
		register_action("profile/editdefault/reset",false,$CONFIG->pluginspath . "profile/actions/resetdefaultprofile.php", true);


	// Define widgets for use in this context
		use_widgets('profile');
?>