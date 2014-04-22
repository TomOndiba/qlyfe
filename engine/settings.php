<?php
/**
 * Elgg settings
 *
 * Elgg manages most of its configuration from the admin panel. However, we need you to
 * include your database settings below.
 *
 * @todo Turn this into something we handle more automatically.
 */

global $CONFIG;
if (!isset($CONFIG)) {
	$CONFIG = new stdClass;
}

/**
 * Enable these plugins always
 */
$CONFIG->enabled_plugins = array(
	"htmlawed",
	"profile",
	"messageboard",
	"notifications",
	"messages",
	"friends",
	"family",
	"nop",
	"discovery",
	"qlyfe_theme",
	"home",
	"uservalidationauto",
);

$CONFIG->colors = array(
	"darkbasic" => "#78a1cc",
	"lightbasic" => "#ddeaf7",
	"lightgray" => "#eeeeee",
	"gray" => "#ccc",
	"darkgray" => "#596775",
	"mediumgray" => "#999",

	"highlight" => "#0054a7",
	"lowlight" => "#4690d6",
	
	"button" => "#4690d6",
	"button_hover" => "#0054a7",
);

/*
 * Standard configuration
 *
 * You will use the same database connection for reads and writes.
 * This is the easiest configuration, and will suit 99.99% of setups. However, if you're
 * running a really popular site, you'll probably want to spread out your database connections
 * and implement database replication.  That's beyond the scope of this configuration file
 * to explain, but if you know you need it, skip past this section.
 */

// Database username
$CONFIG->dbuser = 'qlyfe';

// Database password
$CONFIG->dbpass = 'abc123';

// Database name
$CONFIG->dbname = 'qlyfe';

// Database server
// (For most configurations, you can leave this as 'localhost')
$CONFIG->dbhost = 'localhost';

// Database table prefix
// If you're sharing a database with other applications, you will want to use this
// to differentiate Elgg's tables.
$CONFIG->dbprefix = 'qlyfe_';

// override
if (file_exists(dirname(__FILE__)."/settings.override.php")) 
	include(dirname(__FILE__)."/settings.override.php");

/**
 * Url - I am not sure if this will be here ?
 **/

// URL
$CONFIG->url = "";
