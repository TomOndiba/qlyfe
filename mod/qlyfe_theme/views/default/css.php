<?php

	/**
	 * core CSS file 
	 * 
	 * @uses $vars['wwwroot'] The site URL
	 * 
	 * http://colorschemedesigner.com/#3A52behIFRRQugJDRpiZaEn
	 */

//colors
global $CONFIG;
$darkbasic = $CONFIG->colors['darkbasic'];//"#78a1cc";
$lightbasic = $CONFIG->colors['lightbasic'];//"#ddeaf7";
$lightgray = $CONFIG->colors['lightgray'];//"#eeeeee";
$gray = $CONFIG->colors['gray'];//"#ccc";
$darkgray = $CONFIG->colors['darkgray'];//"#596775";
$mediumgray = $CONFIG->colors['mediumgray'];//"#999


$highlight = $CONFIG->colors['highlight'];//"#0054a7";
$lowlight = $CONFIG->colors['lowlight'];//"#4690d6";

$button = $CONFIG->colors['button'];//"#4690d6";
$button_hover = $CONFIG->colors['button_hover'];//"#0054a7";

?>

/* ***************************************
	RESET BASE STYLES
*************************************** */

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-weight: inherit;
	font-style: inherit;
	font-size: 100%;
	font-family: inherit;
	vertical-align: baseline;
}

/* remember to define focus styles! */
:focus {
	outline: 0;
}
ol, ul {
	list-style: none;
}
/* tables still need cellspacing="0" (for ie6) */
table {
	border-collapse: separate;
	border-spacing: 0;
}
caption, th, td {
	text-align: left;
	font-weight: normal;
	vertical-align: top;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: "";
}
blockquote, q {
	quotes: "" "";
}
.clearfloat { 
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}

/* ***************************************
	DEFAULTS
*************************************** */


body {
	text-align:left;
	margin:0 auto;
	padding:0;
	background-color: <?php echo $lightgray?>;
	font: 70%/1.4  "Lucida Grande", Verdana, sans-serif;
	color: #333333;
}
a {
	color: <?php echo $lowlight?>;
	text-decoration: none;
	-moz-outline-style: none;
	outline: none;
}
a:visited {
	
}
a:hover {
	color: <?php echo $highlight?>;
	text-decoration: underline;
}
p {
	margin: 0px 0px 15px 0;
}
img {
	border: none;
}
ul {
	margin: 5px 0px 15px;
	padding-left: 20px;
}
ul li {
	margin: 0px;
}
ol {
	margin: 5px 0px 15px;
	padding-left: 20px;
}
ul li {
	margin: 0px;
}
form {
	margin: 0px;
	padding: 0px;
}
small {
	font-size: 90%;
}
h1, h2, h3, h4, h5, h6 {
	font-weight: bold;
	line-height: normal;
}
h1 { font-size: 1.8em; }
h2 { font-size: 1.5em; }
h3 { font-size: 1.2em; }
h4 { font-size: 1.0em; }
h5 { font-size: 0.9em; }
h6 { font-size: 0.8em; }

dt {
	margin: 0;
	padding: 0;
	font-weight: bold;
}
dd {
	margin: 0 0 1em 1em;
	padding: 0;
}
pre, code {
	font-family:Monaco,"Courier New",Courier,monospace;
	font-size:12px;
	background:#EBF5FF;
	overflow:auto;
}
code {
	padding:2px 3px;
}
pre {
	padding:3px 15px;
	margin:0px 0 15px 0;
	line-height:1.3em;
}
blockquote {
	padding:3px 15px;
	margin:0px 0 15px 0;
	line-height:1.3em;
	background:#EBF5FF;
	border:none !important;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px;
}
blockquote p {
	margin:0 0 5px 0;
}

/* ***************************************
    PAGE LAYOUT - MAIN STRUCTURE
*************************************** */
#vertical_tabs_layout_tabs{
	width: 170px;
	padding-top: 30px;
}

#vertical_tabs_layout_content {
	padding-top: 10px;
	min-height:500px;
	width: 630px;
	border-top: 1px solid <?php echo $gray?>;
	border-right: 1px solid <?php echo $gray?>;
	border-left: 1px solid <?php echo $gray?>;
	-webkit-border-top-right-radius: 5px;
	-moz-border-radius-topright: 5px;
	-webkit-border-top-left-radius: 5px;
	-moz-border-radius-topleft: 5px;
	background: #fff;
}

#simple_layout {
	min-height:500px;
	width: 800px;
	border-top: 1px solid <?php echo $gray?>;
	border-right: 1px solid <?php echo $gray?>;
	border-left: 1px solid <?php echo $gray?>;
	-webkit-border-top-right-radius: 5px;
	-moz-border-radius-topright: 5px;
	-webkit-border-top-left-radius: 5px;
	-moz-border-radius-topleft: 5px;
	background: #fff;
}

#page_container {
	margin:0;
	padding:0;
	/*background:url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/top_bg.png) top center repeat-x;*/
}

#page_topbar_bg {
	position:absolute;
	width:100%;
	background: #78a1cc;
	height: 40px;
	z-index:-1000;
}
#page_topbar2_bg {
	position:absolute;
	top: 39px;
	width:100%;
	background: <?php echo $lightgray?>;
	height: 29px;
	z-index:-1000;
}
#page_topbar3_bg {
	position:relative;
	top: 68px;
	width:960px;
	background: <?php echo $gray;?>;
	height: 1px;
	z-index:-999;
}

#page_wrapper {
	width:990px;
	margin:0 auto;
	padding:0;
	min-height: 300px;

}
#layout_header {
	text-align:left;
	width:100%;
	height:20px;
	/*background:url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/top_bg.png) top center repeat-x;*/
	
}
#wrapper_header {
	margin:0;
}
#wrapper_header h1,
#wrapper_header h1 a {
	font-size: 20pt;
	letter-spacing: -0.03em;
	color: <?php echo $mediumgray?>;
}
#layout_canvas {
	margin-top: 49px;
	min-height: 360px;
	/*border-left: 1px solid <?php echo $gray;?>;
	border-right: 1px solid <?php echo $gray;?>;*/
}

/* canvas layout: 1 column, no sidebar */
#one_column {
/* 	width:928px; */
	margin:0;
	min-height: 360px;
	background: <?php echo $lightgray?>;
	padding:0 0 10px 0;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}

/* canvas layout: 2 column left sidebar */
#two_column_left_sidebar {
	width:206px;
	margin:0 20px 0 0;
	min-height:360px;
	float:left;
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/trans.png);
	padding:0px;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
border:1px solid <?php echo $gray;?>;

}

#two_column_left_sidebar_maincontent {
	width:718px;
	margin:0;
	min-height: 360px;
	float:left;
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/greytrans.png);
	padding:0 0 5px 0;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	border:1px solid <?php echo $gray;?>;
}




#two_column_left_sidebar_maincontent_boxes {
	margin:0 0px 20px 20px;
	padding:0 0 5px 0;
	width:718px;
	background: <?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	float:left;
}
#two_column_left_sidebar_boxes {
	width:210px;
	margin:0px 0 20px 0px;
	min-height:360px;
	float:left;
	padding:0;
}
#two_column_left_sidebar_boxes .sidebarBox {
	margin:0px 0 22px 0;
	background: <?php echo $lightgray?>;
	padding:4px 10px 10px 10px;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	border-bottom:1px solid <?php echo $gray;?>;
	border-right:1px solid <?php echo $gray;?>;
}
#two_column_left_sidebar_boxes .sidebarBox h3 {
	padding:0 0 5px 0;
	font-size:1.25em;
	line-height:1.2em;
	color:<?php echo $highlight?>;
}

.contentWrapper {
	background:url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/trans.png);
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
    padding:10px;
    margin:0 10px 10px 10px;
    text-align:left;
}
span.contentIntro p {
	margin:0 0 0 0;
}
.notitle {
	margin-top:10px;
}


/* canvas layout: widgets (profile and dashboard) */
#widgets_left_td {
	border-right: 1px solid <?php echo $gray;?>;
}
#widgets_left {
	width:171px;
	min-height:360px;
	padding:0;
}
#widgets_middle_td {
	border-top: 1px solid <?php echo $gray;?>;
	background: #FFFFFF;
}
#widgets_middle {
	width:620px;
	margin:0 0 20px 0;
	padding:0;
}
#widgets_right_td {
	border-left: 1px solid <?php echo $gray;?>;
	border-right: 1px solid <?php echo $gray;?>;
	border-top: 1px solid <?php echo $gray;?>;
	-webkit-border-top-right-radius: 5px;
	-moz-border-radius-topright: 5px;
	background: #FFFFFF;
}
#widgets_right {
	padding-left:10px;
	min-height: 360px;	
}
#widget_table td {
	padding:0;
	margin:0;
	text-align: left;
	vertical-align: top;
}
/* IE6 fixes */
* html #widgets_right { float:none; }
* html #profile_info_column_left {
	margin:0 10px 0 0;
	width:200px;
}
* html #dashboard_info { width:585px; }
/* IE7 */
*:first-child+html #profile_info_column_left { width:200px; }


/* ***************************************
	SPOTLIGHT
*************************************** */
#layout_spotlight {
	padding:0;
	margin:0px 0 2px 0;
	-webkit-border-top-left-radius: 5px;
	-webkit-border-bottom-left-radius: 5px; 
	-webkit-border-bottom-right-radius: 5px; 
	-moz-border-radius-topleft: 5px;
	-moz-border-radius-bottomleft: 5px;
	-moz-border-radius-bottomright: 5px;
	
	background: #fff;
	border:1px solid <?php echo $gray;?>;
}
#wrapper_spotlight {
	margin:0;
	padding:0;
	height:auto;
}
#wrapper_spotlight #spotlight_table h2 {
	color:<?php echo $lowlight?>;
	font-size:1.25em;
	line-height:1.2em;
}
#wrapper_spotlight #spotlight_table li {
	list-style: square;
	line-height: 1.2em;
	margin:5px 20px 5px 0;
	color:<?php echo $lowlight?>;
}
#wrapper_spotlight .collapsable_box_content  {
	margin:0;
	padding:10px 10px 5px 10px;
	background:none;
	min-height:60px;
	border:none;
}
#spotlight_table {
	margin:0 0 2px 0;
}
#spotlight_table .spotlightRHS {
	float:right;
	width:270px;
	margin:0 0 0 50px;
}
/* IE7 */
*:first-child+html #wrapper_spotlight .collapsable_box_content {
	width:958px;
}
#layout_spotlight .collapsable_box_content p {
	padding:0;
}
#wrapper_spotlight .collapsable_box_header  {
	border: none;
	background: none;
}


/* ***************************************
	FOOTER
*************************************** */
#layout_footer {
	height:10px;
	margin:0 0 20px 0;
}
#layout_footer table {
   margin:0 0 0 20px;
}
#layout_footer a, #layout_footer p {
   color:#333333;
   margin:0;
}
#layout_footer .footer_toolbar_links {
	text-align:right;
	padding:15px 0 0 0;
	font-size:1.2em;
}
#layout_footer .footer_legal_links {
	text-align:right;
}


/* ***************************************
  HORIZONTAL ELGG TOPBAR
*************************************** */
#elgg_topbar {
	
	color:#eeeeee;
	
	width:934px;
	top:42px;
	left:270px;
	position:absolute;
	
	height:24px;
	z-index: 9000; /* if you have multiple position:relative elements, then IE sets up separate Z layer contexts for each one, which ignore each other */
}
/* REMOVE ELGG TOPBAR
#elgg_topbar_container_search {
	float:right;
	height:21px;
	/*width:280px;*/
	position:relative;
	right:100px;
	text-align:right;
	margin:3px 0 0 0;
}
#elgg_topbar_container_left .toolbarimages {
	float:left;
	margin-right:10px;
}
#elgg_topbar_container_left .toolbarlinks {
	margin:0 0 10px 0;
	float:left;
}
#elgg_topbar_container_left .toolbarlinks2 {
	margin:3px 0 0 0;
	float:left;
}
#elgg_topbar_container_left a.loggedinuser {
	color:#eeeeee;
	font-weight:bold;
	margin:0 0 0 5px;
}
#elgg_topbar_container_left a.pagelinks {
	color:white;
	margin:0 15px 0 5px;
	display:block;
	padding:3px;
}
#elgg_topbar_container_left a.pagelinks:hover {
	background: <?php echo $lowlight?>;
	text-decoration: none;
}
#elgg_topbar_container_left a.privatemessages {
	background:transparent url(<?php echo $vars['url']; ?>_graphics/toolbar_messages_icon.gif) no-repeat left 2px;
	padding:0 0 4px 16px;
	margin:0 5px 0 5px;
	cursor:pointer;
}
#elgg_topbar_container_left a.privatemessages:hover {
	text-decoration: none;
	background:transparent url(<?php echo $vars['url']; ?>_graphics/toolbar_messages_icon.gif) no-repeat left -36px;
}
#elgg_topbar_container_left a.privatemessages_new {
	background:transparent url(<?php echo $vars['url']; ?>_graphics/toolbar_messages_icon.gif) no-repeat left -17px;
	padding:0 0 0 18px;
	margin:0 15px 0 5px;
	color:white;
}
*/
/* IE6 */
* html #elgg_topbar_container_left a.privatemessages_new { background-position: left -18px; } 
/* IE7 */
*+html #elgg_topbar_container_left a.privatemessages_new { background-position: left -18px; } 

#elgg_topbar_container_left a.privatemessages_new:hover {
	text-decoration: none;
}

#elgg_topbar_container_left a.usersettings {
	margin:0 0 0 10px;
	color:<?php echo $mediumgray?>;
	padding:3px;
}
#elgg_topbar_container_left a.usersettings:hover {
	color:#eeeeee;
}
#elgg_topbar_container_left img {
	margin:0 0 0 5px;
}
#elgg_topbar_container_left .user_mini_avatar {
	border:1px solid #eeeeee;
	margin:0 0 0 20px;
}
#elgg_topbar_container_right {
	padding:3px 0 0 0;
}
#elgg_topbar_container_right a {
	color:#eeeeee;
	margin:0 5px 0 0;
	background:transparent url(<?php echo $vars['url']; ?>_graphics/elgg_toolbar_logout.gif) no-repeat top right;
	padding:0 21px 0 0;
	display:block;
	height:20px;
}
/* IE6 fix */
* html #elgg_topbar_container_right a { 
	width: 120px;
}
#elgg_topbar_container_right a:hover {
	background-position: right -21px;
}
#elgg_topbar_panel {
	background:#333333;
	color:#eeeeee;
	height:200px;
	width:100%;
	padding:10px 20px 10px 20px;
	display:none;
	position:relative;
}
#searchform input.search_input {
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	background-color:#FFFFFF;
	border:1px solid #BBBBBB;
	color:<?php echo $mediumgray?>;
	font-size:12px;
	font-weight:bold;
	margin:0pt;
	padding:2px;
	width:120px;
	height:12px;
}
#searchform input.search_submit_button {
	-webkit-border-top-right-radius: 4px;
	-webkit-border-bottom-right-radius: 4px; 
	-moz-border-radius-topright: 4px;
	-moz-border-radius-bottomright: 4px;
	color:<?php echo $gray;?>;
	background: #ffffff;
	border:none;
	font-size:12px;
	font-weight:bold;
	margin:0px;
	padding:2px;
	width:auto;
	height:18px;
	cursor:pointer;
}
#searchform input.search_submit_button:hover {
	color:#ffffff;
	background: <?php echo $button?>;
}


/* ***************************************
	TOP BAR - VERTICAL TOOLS MENU
*************************************** */
/* elgg toolbar menu setup */
ul.topbardropdownmenu, ul.topbardropdownmenu ul {
	margin:0;
	padding:0;
	display:inline;
	float:left;
	list-style-type: none;
	z-index: 9000;
	position: relative;
}
ul.topbardropdownmenu {
	margin:0pt 20px 0pt 5px;
}
ul.topbardropdownmenu li { 
	display: block;
	list-style: none;
	margin: 0;
	padding: 0;
	float: left;
	position: relative;
}
ul.topbardropdownmenu a {
	display:block;
}
ul.topbardropdownmenu ul {
	display: none;
	position: absolute;
	left: 0;
	margin: 0;
	padding: 0;
}
/* IE6 fix */
* html ul.topbardropdownmenu ul {
	line-height: 1.1em;
}
/* IE6/7 fix */
ul.topbardropdownmenu ul a {
	zoom: 1;
} 
ul.topbardropdownmenu ul li {
	float: none;
}   
/* elgg toolbar menu style */
ul.topbardropdownmenu ul {
	width: 150px;
	top: 24px;
	border-top:1px solid black;
}
ul.topbardropdownmenu *:hover {
	background-color: none;
}
ul.topbardropdownmenu a {
	padding:3px;
	text-decoration:none;
	color:white;
}
ul.topbardropdownmenu li.hover a {
	background-color: #333333;
	text-decoration: none;
}
ul.topbardropdownmenu ul li.drop a {
	font-weight: normal;
}
/* IE7 fixes */
*:first-child+html #elgg_topbar_container_left a.pagelinks {

}
*:first-child+html ul.topbardropdownmenu li.drop a.menuitemtools {
	padding-bottom:6px;
}
ul.topbardropdownmenu ul li a {
	background-color: #333333;/* menu off state color */
	font-weight: bold;
	padding-left:6px;
	padding-top:4px;
	padding-bottom:0;
	height:22px;
	border-bottom: 1px solid white;
}
ul.topbardropdownmenu ul a.hover {
	background-color: <?php echo $highlight?>;
}
ul.topbardropdownmenu ul a {
	opacity: 0.9;
	filter: alpha(opacity=90);
}


/* ***************************************
  SYSTEM MESSSAGES
*************************************** */
.messages {
    background: <?php echo $lightbasic?>;
    color:#000000;
    padding:3px 10px 3px 10px;
    z-index: 8000;
	margin:0;
	position:fixed;
	top:30px;
	width:969px;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	border:2px solid #000000;
	cursor: pointer;
}
.messages_error {
    border:4px solid #D3322A;
    background:#F7DAD8;
    color:#000000;
    padding:3px 10px 3px 10px;
    z-index: 8000;
	margin:0;
	position:fixed;
	top:30px;
	width:969px;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	cursor: pointer;
}
.closeMessages {
	float:right;
	margin-top:17px;
}
.closeMessages a {
	color:#666666;
	cursor: pointer;
	text-decoration: none;
	font-size: 80%;
}
.closeMessages a:hover {
	color:black;
}


/* ***************************************
  COLLAPSABLE BOXES
*************************************** */
.collapsable_box {
	margin: 0 0 5px 0;
	height:auto;

}
/* IE6 fix */
* html .collapsable_box  { 
	height:10px;
}
.collapsable_box_header {
	color: <?php echo $lowlight?>;
	padding: 5px 10px 5px 10px;
	margin:0;
	border-left: 1px solid white;
	border-right: 1px solid <?php echo $gray;?>;
	border-bottom: 1px solid <?php echo $gray;?>;
	-moz-border-radius-topleft:8px;
	-moz-border-radius-topright:8px; 
	-webkit-border-top-right-radius:8px;
	-webkit-border-top-left-radius:8px;
	background:<?php echo $lightgray?>;
	display: none;
}
.collapsable_box_header h1 {
	color: <?php echo $highlight?>;
	font-size:1.25em;
	line-height: 1.2em;
}
.collapsable_box_content {
	padding: 10px 0 10px 0;
	margin:0;
	height:auto;
/*	background:<?php echo $lightgray?>;
	-moz-border-radius-bottomleft:8px;
	-moz-border-radius-bottomright:8px;
	-webkit-border-bottom-right-radius:8px;
	-webkit-border-bottom-left-radius:8px;
	border-left: 1px solid white;
	border-right: 1px solid <?php echo $gray;?>;
	border-bottom: 1px solid <?php echo $gray;?>;*/
}
.collapsable_box_content .contentWrapper {
	margin-bottom:5px;
}
.collapsable_box_editpanel {
	display: none;
	background: #a8a8a8;
	padding:10px 10px 5px 10px;
	border-left: 1px solid white;
	border-bottom: 1px solid white;
}
.collapsable_box_editpanel p {
	margin:0 0 5px 0;
}
.collapsable_box_header a.toggle_box_contents {
	color: <?php echo $lowlight?>;
	cursor:pointer;
	font-family: Arial, Helvetica, sans-serif;
	font-size:20px;
	font-weight: bold;
	text-decoration:none;
	float:right;
	margin: 0;
	margin-top: -7px;
}
.collapsable_box_header a.toggle_box_edit_panel {
	color: <?php echo $lowlight?>;
	cursor:pointer;
	font-size:9px;
	text-transform: uppercase;
	text-decoration:none;
	font-weight: normal;
	float:right;
	margin: 3px 10px 0 0;
}
.collapsable_box_editpanel label {
	font-weight: normal;
	font-size: 100%;
}
/* used for collapsing a content box */
.display_none {
	display:none;
}
/* used on spotlight box - to cancel default box margin */
.no_space_after {
	margin: 0 0 0 0;
}



/* ***************************************
	GENERAL FORM ELEMENTS
*************************************** */
label {
	font-weight: bold;
	color:#333333;
	font-size: 120%;
}
input {
	font: 120% Arial, Helvetica, sans-serif;
	padding: 5px;
	border: 1px solid <?php echo $gray;?>;
	color:#666666;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px;
}
textarea {
	font: 120% Arial, Helvetica, sans-serif;
	border: solid 1px <?php echo $gray;?>;
	padding: 5px;
	color:#666666;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px;
}
textarea:focus, input[type="text"]:focus {
	border: solid 1px <?php echo $lowlight?>;
	background: #e4ecf5;
	color:#333333;
}
.submit_button {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:<?php echo $button?>;
	border: 1px solid <?php echo $button?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	height: 25px;
	padding: 2px 6px 2px 6px;
	margin:10px 0 10px 0;
	cursor: pointer;
}
.submit_button:hover, input[type="submit"]:hover {
	background: <?php echo $button_hover?>;
	border-color: <?php echo $button_hover?>;
}
.submit_button:disabled, input[type="submit"]:disabled {
	background: <?php echo $gray?>;
	border-color: <?php echo $gray?>;
}


input[type="submit"] {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:<?php echo $lowlight?>;
	border: 1px solid <?php echo $lowlight?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	height: 25px;
	padding: 2px 6px 2px 6px;
	margin:10px 0 10px 0;
	cursor: pointer;
}
.cancel_button {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: <?php echo $mediumgray?>;
	background:#dddddd;
	border: 1px solid <?php echo $mediumgray?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	height: 25px;
	padding: 2px 6px 2px 6px;
	margin:10px 0 10px 10px;
	cursor: pointer;
}
.cancel_button:hover {
	background: <?php echo $gray;?>;
}

.input-text,
.input-tags,
.input-url,
.input-textarea {
	width:98%;
}

.input-textarea {
	height: 200px;
}

.autodate {
	width: 100px;
}


/* ***************************************
	LOGIN / REGISTER
*************************************** */
#login-box {
	margin:0 0 10px 0;
	padding:0 0 10px 0;
	background: <?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	width:240px;
    text-align:left;
}
#login-box form {
	margin:0 10px 0 10px;
	padding:0 10px 4px 10px;
	background: white;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	width:200px;
}
#login-box h2 {
	color:<?php echo $highlight?>;
	font-size:1.35em;
	line-height:1.2em;
	margin:0 0 0 8px;
	padding:5px 5px 0 5px;
}
#login-box .login-textarea {
	width:178px;
}
#login-box label,
#register-box h3 {
	width: 120%;
	position:relative;
	left: -10px;
}
#register-box label {
	font-size: 1.2em;
	color:gray;
}
#login-box p.loginbox {
	margin:0;
}
#login-box input[type="text"],
#login-box input[type="password"],
#register-box input[type="text"],
#register-box input[type="password"] {
	margin:0 0 10px 0;
}
#register-box input[type="text"],
#register-box input[type="password"] {
	width:380px;
}
#login-box h2,
#login-box-openid h2,
#add-box h2,
#forgotten_box h2 {
	color:<?php echo $highlight?>;
	font-size:1.35em;
	line-height:1.2em;
	margin:0pt 0pt 5px;
}
#register-box {
    text-align:left;
    width:400px;
    padding:10px;
    margin-left:30px;
/*    background: <?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;*/
}
#persistent_login label {
	font-size:1.0em;
	font-weight: normal;
}
/* login and openID boxes when not running custom_index mod */
#two_column_left_sidebar #login-box {
	width:auto;
	background: none;
}
#two_column_left_sidebar #login-box form {
	width:auto;
	margin:10px 10px 0 10px;
	padding:5px 0 5px 10px;
}
#two_column_left_sidebar #login-box h2 {
	margin:0 0 0 5px;
	padding:5px 5px 0 5px;
}
#two_column_left_sidebar #login-box .login-textarea {
	width:158px;
}


/* ***************************************
	PROFILE
*************************************** */
#profile_info {
	margin:0px;
	padding:10px 0px;


}
#profile_info_column_left {
	float:left;
	padding: 0;
	margin:0 20px 0 0;
}
#profile_info_column_middle {
	float:left;
	width:365px;
	padding: 0;
}
#profile_info_column_right {
	width:578px;
	margin:0 0 0 0;
	background:<?php echo $lightgray?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	padding:4px;
}
#dashboard_info {
	margin:0px 0px 0 0px;
	padding:20px;
	border-bottom:1px solid <?php echo $gray;?>;
	border-right:1px solid <?php echo $gray;?>;
	background: #bbdaf7;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}
#profile_menu_wrapper {
	margin:10px 0 10px 0;
	width:150px;
	text-align:left;
}
#profile_menu_wrapper p {
	border-bottom:1px solid <?php echo $gray;?>;
}
#profile_menu_wrapper p:first-child {
	border-top:1px solid <?php echo $gray;?>;
}
#profile_menu_wrapper a {
	display:block;
	padding:0 0 0 3px;
}
#profile_menu_wrapper a:hover {
	color:#ffffff;
	background:<?php echo $lowlight?>;
	text-decoration:none;
}
p.user_menu_friends, p.user_menu_profile, 
p.user_menu_removefriend, 
p.user_menu_friends_of {
	margin:0;
}
#profile_menu_wrapper .user_menu_admin {
	border-top:none;
}

#profile_info_column_middle p {
	margin:7px 0 7px 0;
	padding:2px 4px 2px 4px;
}
/* profile owner name */
#profile_info_column_middle h2 {
	padding:0 0 14px 0;
	margin:0;
}
#profile_info_column_middle .profile_status {
	background:#bbdaf7;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	padding:2px 4px 2px 4px;
	line-height:1.2em;
}
#profile_info_column_middle .profile_status span {
	display:block;
	font-size:90%;
	color:#666666;	
}
#profile_info_column_middle a.status_update {
	float:right;	
}
#profile_info_column_middle .odd {
	background:<?php echo $lightgray?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}
#profile_info_column_middle .even {
	background:<?php echo $lightgray?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}
#profile_info_column_right p {
	margin:0 0 7px 0;
}
#profile_info_column_right .profile_aboutme_title {
	margin:0;
	padding:0;
	line-height:1em;
}
/* edit profile button */
.profile_info_edit_buttons {
	float:right;
	margin:0  !important;
	padding:0 !important;
}
.profile_info_edit_buttons a {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:<?php echo $button?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	padding: 2px 6px 2px 6px;
	margin:0;
	cursor: pointer;
}
.profile_info_edit_buttons a:hover {
	background: <?php echo $button_hover?>;
	text-decoration: none;
	color:white;
}


/* ***************************************
	RIVER
*************************************** */
#river,
.river_item_list {
	border-top:1px solid #dddddd;
}
.river_item p {
	margin:0;
	padding:0 0 0 21px;
	line-height:1.1em;
	min-height:17px;
}
.river_item {
	border-bottom:1px solid #dddddd;
	padding:2px 0 2px 0;
}
.river_item_time {
	font-size:90%;
	color:#666666;
}
/* IE6 fix */
* html .river_item p { 
	padding:3px 0 3px 20px;
}
/* IE7 */
*:first-child+html .river_item p {
	min-height:17px;
}
.river_user_update {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_profile.gif) no-repeat left -1px;
}
.river_object_user_profileupdate {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_profile.gif) no-repeat left -1px;
}
.river_object_user_profileiconupdate {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_profile.gif) no-repeat left -1px;
}
.river_object_annotate {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_bookmarks_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_bookmarks.gif) no-repeat left -1px;
}
.river_object_bookmarks_comment {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_status_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_status.gif) no-repeat left -1px;
}
.river_object_file_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_files.gif) no-repeat left -1px;
}
.river_object_file_update {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_files.gif) no-repeat left -1px;
}
.river_object_file_comment {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_widget_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_plugin.gif) no-repeat left -1px;
}
.river_object_forums_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_forums_update {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_widget_update {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_plugin.gif) no-repeat left -1px;	
}
.river_object_blog_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_blog.gif) no-repeat left -1px;
}
.river_object_blog_update {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_blog.gif) no-repeat left -1px;
}
.river_object_blog_comment {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_forumtopic_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_user_friend {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_friends.gif) no-repeat left -1px;
}
.river_object_relationship_friend_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_friends.gif) no-repeat left -1px;
}
.river_object_relationship_member_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_thewire_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_thewire.gif) no-repeat left -1px;
}
.river_group_join {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_groupforumtopic_annotate {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_groupforumtopic_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_forum.gif) no-repeat left -1px;
}
.river_object_sitemessage_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_blog.gif) no-repeat left -1px;	
}
.river_user_messageboard {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;	
}
.river_object_page_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_pages.gif) no-repeat left -1px;
}
.river_object_page_top_create {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_pages.gif) no-repeat left -1px;
}
.river_object_page_top_comment {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}
.river_object_page_comment {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/river_icons/river_icon_comment.gif) no-repeat left -1px;
}

/* ***************************************
	SEARCH LISTINGS	
*************************************** */
.search_listing {
	border: 1px solid <?php echo $gray?>;
	display: block;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px;
	margin:0 10px 5px 10px;
	padding:5px;
}
.search_listing_icon {
	float:left;
}
.search_listing_icon img {
	width: 40px;
}
.search_listing_icon .avatar_menu_button img {
	width: 15px;
}
.search_listing_info {
	margin-left: 50px;
	min-height: 40px;
}
/* IE 6 fix */
* html .search_listing_info {
	height:40px;
}
.search_listing_info p {
	margin:0 0 3px 0;
	line-height:1.2em;
}
.search_listing_info p.owner_timestamp {
	margin:0;
	padding:0;
	color:#666666;
	font-size: 90%;
}
table.search_gallery {
	border-spacing: 10px;
	margin:0 0 0 0;
}
.search_gallery td {
	padding: 5px;
}
.search_gallery_item {
	background: white;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	width:170px;
}
.search_gallery_item:hover {
	background: black;
	color:white;
}
.search_gallery_item .search_listing {
	text-align: center;
}
.search_gallery_item .search_listing_header {
	text-align: center;
}
.search_gallery_item .search_listing_icon {
	position: relative;
	text-align: center;
}
.search_gallery_item .search_listing_info {
	margin: 5px;
}
.search_gallery_item .search_listing_info p {
	margin: 5px;
	margin-bottom: 10px;
}
.search_gallery_item .search_listing {
	text-align: center;
}
.search_gallery_item .search_listing_icon {
	position: absolute;
	margin-bottom: 20px;
}
.search_gallery_item .search_listing_info {
	margin: 5px;
}
.search_gallery_item .search_listing_info p {
	margin: 5px;
	margin-bottom: 10px;
}


/* ***************************************
	VERTICAL TABS
*************************************** */
.vertical_tabs_wrapper {
	position:relative;
	left:0px;
	width:172px;
}
.vertical_tabs_wrapper_right {
	width:150px;
}
#vertical_tabs_topline {
	height:1px;
	background: <?php echo $gray?>;
}

.vertical_tab {
	align:center;
	border-bottom: 1px solid <?php echo $gray?>;
	border-left: 1px solid <?php echo $gray?>;
	width:170px;
	background: <?php echo $lightgray?>;
	display:table;
}
.vertical_tab_items {
	display:table;
	padding-left:15px;
}
.vertical_tab_links {
	margin-left: 15px;
	text-align:center;
	display:table;
	position:relative;
}
.vertical_tab_links a {
	-moz-border-radius-topleft:2px;
	-moz-border-radius-topright:2px;	
	-webkit-border-top-left-radius:2px;
	-webkit-border-top-right-radius:2px;
	margin-left:5px;
	margin-right:5px;
	padding-left:4px;
	padding-right:4px;
	background: <?php echo $gray?>;
	color: #fff;
	text-size: 8pt;
}
.vertical_tab_links a:hover {
	background: <?php echo $darkbasic?>;
}
.vertical_tab_current {
	z-index: 100;
	width: 100%;
	align:center;
	border-bottom: 1px solid <?php echo $gray?>;
	border-left: 1px solid <?php echo $gray?>;
	border-right:1px solid #fff;
	display:table;
	background: #fff;
}
.widget_friends_singlefriend {
	float:left;
	margin:0 5px 5px 0;
}

.vertical_tab_current a span, .vertical_tab a span {
	text-align:center;
	display:block;
	height:15px;
	margin:1px;
	color:<?php echo $mediumgray?>;
	font-size: 9pt;
	font-weight: bold;
	padding: 2px;
}

.vertical_tab:hover {
	background-color: <?php echo $lightbasic?>;
}  
.vertical_tab_current a:hover , .vertical_tab a:hover {
	text-decoration:none;
}
.vertical_tab a span:hover {
	color: <?php echo $darkbasic?>
}


/* ***************************************
	ADMIN AREA - PLUGIN SETTINGS
*************************************** */
.plugin_details {
	margin:0 10px 5px 10px;
	padding:0 7px 4px 10px;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px;
}
.admin_plugin_reorder {
	float:right;
	width:200px;
	text-align: right;
}
.admin_plugin_reorder a {
	padding-left:10px;
	font-size:80%;
	color:<?php echo $mediumgray?>;
}
.plugin_details a.pluginsettings_link {
	cursor:pointer;
	font-size:80%;
}
.active {
	border:1px solid <?php echo $mediumgray?>;
    background:white;
}
.not-active {
    border:1px solid <?php echo $mediumgray?>;
    background:<?php echo $lightgray?>;
}
.plugin_details p {
	margin:0;
	padding:0;
}
.plugin_details a.manifest_details {
	cursor:pointer;
	font-size:80%;
}
.manifest_file {
	background:<?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	padding:5px 10px 5px 10px;
	margin:4px 0 4px 0;
	display:none;
}
.admin_plugin_enable_disable {
	width:150px;
	margin:10px 0 0 0;
	float:right;
	text-align: right;
}
.contentIntro .enableallplugins,
.contentIntro .disableallplugins {
	float:right;
}
.contentIntro .enableallplugins {
	margin-left:10px;
}
.contentIntro .enableallplugins, 
.not-active .admin_plugin_enable_disable a {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:<?php echo $lowlight?>;
	border: 1px solid <?php echo $lowlight?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	padding: 4px;
	cursor: pointer;
}
.contentIntro .enableallplugins:hover, 
.not-active .admin_plugin_enable_disable a:hover {
	background: <?php echo $highlight?>;
	border: 1px solid <?php echo $highlight?>;
	text-decoration: none;
}
.contentIntro .disableallplugins, 
.active .admin_plugin_enable_disable a {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:<?php echo $mediumgray?>;
	border: 1px solid <?php echo $mediumgray?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	padding: 4px;
	cursor: pointer;
}
.contentIntro .disableallplugins:hover, 
.active .admin_plugin_enable_disable a:hover {
	background: #333333;
	border: 1px solid #333333;
	text-decoration: none;
}
.pluginsettings {
	margin:15px 0 5px 0;
	background:#bbdaf7;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	padding:10px;
	display:none;
}
.pluginsettings h3 {
	padding:0 0 5px 0;
	margin:0 0 5px 0;
	border-bottom:1px solid <?php echo $mediumgray?>;
}
#updateclient_settings h3 {
	padding:0;
	margin:0;
	border:none;
}
.input-access {
	margin:5px 0 0 0;
}

/* ***************************************
	GENERIC COMMENTS
*************************************** */
.generic_comment_owner {
	font-size: 90%;
	color:#666666;
}
.generic_comment {
	background:white;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
    padding:10px;
    margin:0 10px 10px 10px;
}
.generic_comment_icon {
	float:left;
}
.generic_comment_details {
	margin-left: 60px;
}
.generic_comment_details p {
	margin: 0 0 5px 0;
}
.generic_comment_owner {
	color:#666666;
	margin: 0px;
	font-size:90%;
	border-top: 1px solid #aaaaaa;
}
/* IE6 */
* html #generic_comment_tbl { width:676px !important;}

	
/* ***************************************
  PAGE-OWNER BLOCK
*************************************** */
#owner_block {
	padding:10px;
}
#owner_block_icon {
	float:left;
	margin:0 10px 0 0;
}
#owner_block_rss_feed,
#owner_block_odd_feed,
#owner_block_bookmark_this,
#owner_block_report_this {
	padding:5px 0 0 0;
}
#owner_block_report_this {
	padding-bottom:5px;
	border-bottom:1px solid <?php echo $gray;?>;
}
#owner_block_rss_feed a {
	font-size: 90%;
	color:<?php echo $mediumgray?>;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>_graphics/icon_rss.gif) no-repeat left top;
}
#owner_block_odd_feed a {
	font-size: 90%;
	color:<?php echo $mediumgray?>;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/icon_odd.gif) no-repeat left top;
}
#owner_block_bookmark_this a {
	font-size: 90%;
	color:<?php echo $mediumgray?>;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/icon_bookmarkthis.gif) no-repeat left top;
}
#owner_block_report_this a {
	font-size: 90%;
	color:<?php echo $mediumgray?>;
	padding:0 0 4px 20px;
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/icon_reportthis.gif) no-repeat left top;
}
#owner_block_rss_feed a:hover,
#owner_block_odd_feed a:hover,
#owner_block_bookmark_this a:hover,
#owner_block_report_this a:hover {
	color: <?php echo $highlight?>;
}
#owner_block_desc {
	padding:4px 0 4px 0;
	margin:0 0 0 0;
	line-height: 1.2em;
	border-bottom:1px solid <?php echo $gray;?>;
	color:#666666;
}
#owner_block_content {
	margin:0 0 4px 0;
	padding:3px 0 0 0;
	min-height:35px;
	font-weight: bold;
}
#owner_block_content a {
	line-height: 1em;
}
.ownerblockline {
	padding:0;
	margin:0;
	border-bottom:1px solid <?php echo $gray;?>;
	height:1px;
}
#owner_block_submenu {
	margin:20px 0 20px 0;
	padding: 0;
	width:100%;
}
#owner_block_submenu ul {
	list-style: none;
	padding: 0;
	margin: 0;
}
#owner_block_submenu ul li.selected a {
	background: <?php echo $lowlight?>;
	color:white;
}
#owner_block_submenu ul li.selected a:hover {
	background: <?php echo $lowlight?>;
	color:white;
}
#owner_block_submenu ul li a {
	text-decoration: none;
	display: block;
	margin: 2px 0 0 0;
	color:<?php echo $lowlight?>;
	padding:4px 6px 4px 10px;
	font-weight: bold;
	line-height: 1.1em;
	-webkit-border-radius: 10px; 
	-moz-border-radius: 10px;
}
#owner_block_submenu ul li a:hover {
	color:white;
	background: <?php echo $highlight?>;
}

/* IE 6 + 7 menu arrow position fix */
* html #owner_block_submenu ul li.selected a {
	background-position: left 10px;
}
*:first-child+html #owner_block_submenu ul li.selected a {
	background-position: left 8px;
}

#owner_block_submenu .submenu_group {
	border-bottom: 1px solid <?php echo $gray;?>;
	margin:10px 0 0 0;
	padding-bottom: 10px;
}

#owner_block_submenu .submenu_group .submenu_group_filter ul li a,
#owner_block_submenu .submenu_group .submenu_group_filetypes ul li a {
	color:#666666;
}
#owner_block_submenu .submenu_group .submenu_group_filter ul li.selected a,
#owner_block_submenu .submenu_group .submenu_group_filetypes ul li.selected a {
	background:<?php echo $mediumgray?>;
	color:white;
}
#owner_block_submenu .submenu_group .submenu_group_filter ul li a:hover,
#owner_block_submenu .submenu_group .submenu_group_filetypes ul li a:hover {
	color:white;
	background: <?php echo $mediumgray?>;
}


/* ***************************************
	PAGINATION
*************************************** */
.pagination {
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	background:white;
	margin:5px 10px 5px 10px;
	padding:5px;
}
.pagination .pagination_number {
	display:block;
	float:left;
	background:#ffffff;
	border:1px solid <?php echo $lowlight?>;
	text-align: center;
	color:<?php echo $lowlight?>;
	font-size: 12px;
	font-weight: normal;
	margin:0 6px 0 0;
	padding:0px 4px;
	cursor: pointer;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}
.pagination .pagination_number:hover {
	background:<?php echo $lowlight?>;
	color:white;
	text-decoration: none;
}
.pagination .pagination_more {
	display:block;
	float:left;
	background:#ffffff;
	border:1px solid #ffffff;
	text-align: center;
	color:<?php echo $lowlight?>;
	font-size: 12px;
	font-weight: normal;
	margin:0 6px 0 0;
	padding:0px 4px;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}
.pagination .pagination_previous,
.pagination .pagination_next {
	display:block;
	float:left;
	border:1px solid <?php echo $lowlight?>;
	color:<?php echo $lowlight?>;
	text-align: center;
	font-size: 12px;
	font-weight: normal;
	margin:0 6px 0 0;
	padding:0px 4px;
	cursor: pointer;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}
.pagination .pagination_previous:hover,
.pagination .pagination_next:hover {
	background:<?php echo $lowlight?>;
	color:white;
	text-decoration: none;
}
.pagination .pagination_currentpage {
	display:block;
	float:left;
	background:<?php echo $lowlight?>;
	border:1px solid <?php echo $lowlight?>;
	text-align: center;
	color:white;
	font-size: 12px;
	font-weight: bold;
	margin:0 6px 0 0;
	padding:0px 4px;
	cursor: pointer;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}

	
/* ***************************************
	FRIENDS COLLECTIONS ACCORDIAN
*************************************** */	
ul#friends_collections_accordian {
	margin: 0 0 0 0;
	padding: 0;
}
#friends_collections_accordian li {
	margin: 0 0 0 0;
	padding: 0;
	list-style-type: none;
	color: #666666;
}
#friends_collections_accordian li h2 {
	background:<?php echo $lowlight?>;
	color: white;
	padding:4px 2px 4px 6px;
	margin:10px 0 10px 0;
	font-size:1.2em;
	cursor:pointer;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}
#friends_collections_accordian li h2:hover {
	background:#333333;
	color:white;
}
#friends_collections_accordian .friends_picker {
	background:white;
	padding:0;
	display:none;
}
#friends_collections_accordian .friends_collections_controls {
	font-size:70%;
	float:right;
}
#friends_collections_accordian .friends_collections_controls a {
	color:<?php echo $mediumgray?>;
	font-weight:normal;
}
	
	
/* ***************************************
	FRIENDS PICKER SLIDER
*************************************** */		
.friendsPicker_container h3 {
	font-size:4em !important;
	text-align: left;
	margin:0 0 10px 0 !important;
	color:<?php echo $mediumgray?> !important;
	background: none !important;
	padding:0 !important;
}
.friendsPicker .friendsPicker_container .panel ul {
	text-align: left;
	margin: 0;
	padding:0;
}
.friendsPicker_wrapper {
	margin: 0;
	padding:0;
	position: relative;
	width: 100%;
}
.friendsPicker {
	position: relative;
	overflow: hidden; 
	margin: 0;
	padding:0;
	width: 678px;
	
	height: auto;
	background: <?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}
.friendspicker_savebuttons {
	background: white;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	margin:0 10px 10px 10px;
}
.friendsPicker .friendsPicker_container { /* long container used to house end-to-end panels. Width is calculated in JS  */
	position: relative;
	left: 0;
	top: 0;
	width: 100%;
	list-style-type: none;
}
.friendsPicker .friendsPicker_container .panel {
	float:left;
	height: 100%;
	position: relative;
	width: 678px;
	margin: 0;
	padding:0;
}
.friendsPicker .friendsPicker_container .panel .wrapper {
	margin: 0;
	padding:4px 10px 10px 10px;
	min-height: 230px;
}
.friendsPickerNavigation {
	margin: 0 0 10px 0;
	padding:0;
}
.friendsPickerNavigation ul {
	list-style: none;
	padding-left: 0;
}
.friendsPickerNavigation ul li {
	float: left;
	margin:0;
	background:white;
}
.friendsPickerNavigation a {
	font-weight: bold;
	text-align: center;
	background: white;
	color: <?php echo $mediumgray?>;
	text-decoration: none;
	display: block;
	padding: 0;
	width:20px;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}
.tabHasContent {
	background: white; color:#333333 !important;
}
.friendsPickerNavigation li a:hover {
	background: #333333;
	color:white !important;
}
.friendsPickerNavigation li a.current {
	background: <?php echo $lowlight?>;
	color:white !important;
}
.friendsPickerNavigationAll {
	margin:0px 0 0 20px;
	float:left;
}
.friendsPickerNavigationAll a {
	font-weight: bold;
	text-align: left;
	font-size:0.8em;
	background: white;
	color: <?php echo $mediumgray?>;
	text-decoration: none;
	display: block;
	padding: 0 4px 0 4px;
	width:auto;
}
.friendsPickerNavigationAll a:hover {
	background: <?php echo $lowlight?>;
	color:white;
}
.friendsPickerNavigationL, .friendsPickerNavigationR {
	position: absolute;
	top: 46px;
	text-indent: -9000em;
}
.friendsPickerNavigationL a, .friendsPickerNavigationR a {
	display: block;
	height: 43px;
	width: 43px;
}
.friendsPickerNavigationL {
	right: 48px;
	z-index:1;
}
.friendsPickerNavigationR {
	right: 0;
	z-index:1;
}
.friendsPickerNavigationL {
	background: url("<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/friends_picker_arrows.gif") no-repeat left top;
}
.friendsPickerNavigationR {
	background: url("<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/friends_picker_arrows.gif") no-repeat -60px top;
}
.friendsPickerNavigationL:hover {
	background: url("<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/friends_picker_arrows.gif") no-repeat left -44px;
}
.friendsPickerNavigationR:hover {
	background: url("<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/friends_picker_arrows.gif") no-repeat -60px -44px;
}	
.friends_collections_controls a.delete_collection {
	display:block;
	cursor: pointer;
	width:14px;
	height:14px;
	margin:2px 3px 0 0;
	background: url("<?php echo $vars['url']; ?>_graphics/icon_customise_remove.png") no-repeat 0 0;
}
.friends_collections_controls a.delete_collection:hover {
	background-position: 0 -16px;
}
.friendspicker_savebuttons .submit_button,
.friendspicker_savebuttons .cancel_button {
	margin:5px 20px 5px 5px;
}

#collectionMembersTable {
	background: <?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	margin:10px 0 0 0;
	padding:10px 10px 0 10px;
}

	
/* ***************************************
  WIDGET PICKER (PROFILE and DASHBOARD)
*************************************** */
/* 'edit page' button */
a.toggle_customise_edit_panel { 
	float:right;
	clear:right;
	color: <?php echo $lowlight?>;
	background: white;
	border:1px solid <?php echo $gray;?>;
	padding: 5px 10px 5px 10px;
	margin:0 0 20px 0;
	/*width:280px;*/
	text-align: left;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	display: none;
}
a.toggle_customise_edit_panel:hover { 
	color: #ffffff;
	background: <?php echo $highlight?>;
	border:1px solid <?php echo $highlight?>;
	text-decoration:none;
}
#customise_editpanel {
	display:none;
	margin: 0 0 20px 0;
	padding:10px;
	background: <?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}

/* Top area - instructions */
.customise_editpanel_instructions {
	width:690px;
	padding:0 0 10px 0;
}
.customise_editpanel_instructions h2 {
	padding:0 0 10px 0;
}
.customise_editpanel_instructions p {
	margin:0 0 5px 0;
	line-height: 1.4em;
}

/* RHS (widget gallery area) */
#customise_editpanel_rhs {
	float:right;
	width:230px;
	background:white;
}
#customise_editpanel #customise_editpanel_rhs h2 {
	color:#333333;
	font-size: 1.4em;
	margin:0;
	padding:6px;
}
#widget_picker_gallery {
	border-top:1px solid <?php echo $gray;?>;
	background:white;
	width:210px; 
	height:340px;
	padding:10px;
	overflow:scroll;
	overflow-x:hidden;
}

/* main page widget area */
#customise_page_view {
	width:656px;
	padding:10px;
	margin:0 0 10px 0;
	background:white;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}
#customise_page_view h2 {
	border-top:1px solid <?php echo $gray;?>;
	border-right:1px solid <?php echo $gray;?>;
	border-left:1px solid <?php echo $gray;?>;
	margin:0;
	padding:5px;
	width:200px;
	color: <?php echo $highlight?>;
	background: <?php echo $lightgray?>;
	font-size:1.25em;
	line-height: 1.2em;
}
.profile_info_divider {
	height: 2px;
	margin: 5px 0px;
	background: <?php echo $lightbasic?>;
}
#profile_box_widgets {
	width:422px;
	margin:0 10px 10px 0;
	padding:5px 5px 0px 5px;
	min-height: 50px;
	border:1px solid <?php echo $gray;?>;
	background: <?php echo $lightgray?>;
}
#customise_page_view h2.profile_box {
	width:422px;
	color: <?php echo $mediumgray?>;
}
#profile_box_widgets p {
	color:<?php echo $mediumgray?>;
}
#leftcolumn_widgets {
	width:200px;
	margin:0 10px 0 0;
	padding:5px 5px 40px 5px;
	min-height: 190px;
	border:1px solid <?php echo $gray;?>;
}
#middlecolumn_widgets {
	width:200px;
	margin:0 10px 0 0;
	padding:5px 5px 40px 5px;
	min-height: 190px;
	border:1px solid <?php echo $gray;?>;
}
#rightcolumn_widgets {
	width:200px;
	margin:0;
	padding:5px 5px 40px 5px;
	min-height: 190px;
	border:1px solid <?php echo $gray;?>;
}
#rightcolumn_widgets.long {
	min-height: 288px;
}
/* IE6 fix */
* html #leftcolumn_widgets { 
	height: 190px;
}
* html #middlecolumn_widgets { 
	height: 190px;
}
* html #rightcolumn_widgets { 
	height: 190px;
}
* html #rightcolumn_widgets.long { 
	height: 338px;
}

#customise_editpanel table.draggable_widget {
	width:200px;
	background: <?php echo $gray;?>;
	margin: 10px 0 0 0;
	vertical-align:text-top;
	border:1px solid <?php echo $gray;?>;
}
#widget_picker_gallery table.draggable_widget {
	width:200px;
	background: <?php echo $gray;?>;
	margin: 10px 0 0 0;
}

/* take care of long widget names */
#customise_editpanel table.draggable_widget h3 {
	word-wrap:break-word;/* safari, webkit, ie */
	width:140px;
	line-height: 1.1em;
	overflow: hidden;/* ff */
	padding:4px;
}
#widget_picker_gallery table.draggable_widget h3 {
	word-wrap:break-word;
	width:145px;
	line-height: 1.1em;
	overflow: hidden;
	padding:4px;
}
#customise_editpanel img.more_info {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/icon_customise_info.gif) no-repeat top left;
	cursor:pointer;
}
#customise_editpanel img.drag_handle {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/icon_customise_drag.gif) no-repeat top left;
	cursor:move;
}
#customise_editpanel img {
	margin-top:4px;
}
#widget_moreinfo {
	position:absolute;
	border:1px solid #333333;
	background:#e4ecf5;
	color:#333333;
	padding:5px;
	display:none;
	width: 200px;
	line-height: 1.2em;
}
/* droppable area hover class  */
.droppable-hover {
	background:#bbdaf7;
}
/* target drop area class */
.placeholder {
	border:2px dashed #AAA;
	width:196px !important;
	margin: 10px 0 10px 0;
}
/* class of widget while dragging */
.ui-sortable-helper {
	background: <?php echo $lowlight?>;
	color:white;
	padding: 4px;
	margin: 10px 0 0 0;
	width:200px;
}
/* IE6 fix */
* html .placeholder { 
	margin: 0;
}
/* IE7 */
*:first-child+html .placeholder {
	margin: 0;
}
/* IE6 fix */
* html .ui-sortable-helper h3 { 
	padding: 4px;
}
* html .ui-sortable-helper img.drag_handle, * html .ui-sortable-helper img.remove_me, * html .ui-sortable-helper img.more_info {
	padding-top: 4px;
}
/* IE7 */
*:first-child+html .ui-sortable-helper h3 {
	padding: 4px;
}
*:first-child+html .ui-sortable-helper img.drag_handle, *:first-child+html .ui-sortable-helper img.remove_me, *:first-child+html .ui-sortable-helper img.more_info {
	padding-top: 4px;
}


/* ***************************************
	BREADCRUMBS
*************************************** */
#pages_breadcrumbs {
	font-size: 80%;
	color:#bababa;
	padding:0;
	margin:2px 0 0 10px;
}
#pages_breadcrumbs a {
	color:<?php echo $mediumgray?>;
	text-decoration: none;
}
#pages_breadcrumbs a:hover {
	color: <?php echo $highlight?>;
	text-decoration: underline;
}


/* ***************************************
	MISC.
*************************************** */
/* general page titles in main content area */
#content_area_user_title h2 {	
	margin:8px;
	padding:5px;
	color:#000;
	font-size:1.35em;
	line-height:1.2em;

-moz-border-radius:8px;
-webkit-border-radius:8px;

}
/* reusable generic collapsible box */
.collapsible_box {
	background:<?php echo $lightgray?>;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	padding:5px 10px 5px 10px;
	margin:4px 0 4px 0;
	display:none;
}	
a.collapsibleboxlink {
	cursor:pointer;
}

/* tag icon */	
.object_tag_string {
	background: url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/icon_tag.gif) no-repeat left 2px;
	padding:0 0 0 14px;
	margin:0;
}	

/* profile picture upload n crop page */	
#profile_picture_form {
	height:145px;
}	
#current_user_avatar {
	float:left;
	width:160px;
	height:130px;
	border-right:1px solid <?php echo $gray;?>;
	margin:0 20px 0 0;
}	
#profile_picture_croppingtool {
	border-top: 1px solid <?php echo $gray;?>;
	margin:20px 0 0 0;
	padding:10px 0 0 0;
}	
#profile_picture_croppingtool #user_avatar {
	float: left;
	margin-right: 20px;
}	
#profile_picture_croppingtool #applycropping {

}
#profile_picture_croppingtool #user_avatar_preview {
	float: left;
	position: relative;
	overflow: hidden;
	width: 100px;
	height: 100px;
}	


/* ***************************************
	SETTINGS and ADMIN
*************************************** */
.admin_statistics,
.admin_users_online,
.usersettings_statistics,
.admin_adduser_link,
#add-box,
#search-box,
#logbrowser_search_area {
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
	background:white;
	margin:0 10px 10px 10px;
	padding:10px;
}

.usersettings_statistics h3,
.admin_statistics h3,
.admin_users_online h3,
.user_settings h3,
.notification_methods h3,
.profile_info h3,
#register-box h3
{
	background: <?php echo $darkbasic?>;
	color:#fff;
	font-size:1.1em;
	line-height:1em;
	margin:10px 0 10px 0;
	padding:5px;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;	
}
.user_settings p {
	padding-left: 15px;
}
h3.settings {
	background:#e4e4e4;
	color:#333333;
	font-size:1.1em;
	line-height:1em;
	margin:10px 0 4px 0;
	padding:5px;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
}
.admin_users_online .profile_status {
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	background:#bbdaf7;
	line-height:1.2em;
	padding:2px 4px;
}
.admin_users_online .profile_status span {
	font-size:90%;
	color:#666666;
}
.admin_users_online  p.owner_timestamp {
	padding-left:3px;
}


.admin_debug label,
.admin_usage label {
	color:#333333;
	font-size:100%;
	font-weight:normal;
}

.admin_usage {
	border-bottom:1px solid <?php echo $gray;?>;
	padding:0 0 20px 0;
}
.usersettings_statistics .odd,
.admin_statistics .odd {

}
.usersettings_statistics .even,
.admin_statistics .even {

}
.usersettings_statistics td,
.admin_statistics td {
	padding:2px 4px 2px 4px;
	border-bottom:1px solid <?php echo $gray;?>;
}
.usersettings_statistics td.column_one,
.admin_statistics td.column_one {
	width:200px;
}
.usersettings_statistics table,
.admin_statistics table {
	width:100%;
}
.usersettings_statistics table,
.admin_statistics table {
	border-top:1px solid <?php echo $gray;?>;
}
.usersettings_statistics table tr:hover,
.admin_statistics table tr:hover {
	background: #E4E4E4;
}
.admin_users_online .search_listing {
	margin:0 0 5px 0;
	padding:5px;
	border:2px solid <?php echo $gray;?>;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px;
}



/* force tinyMCE editor initial width for safari */
.mceLayout {
	width:683px;
}
p.longtext_editarea {
	margin:0 !important;
}
.toggle_editor_container {
	margin:0 0 15px 0;
}
/* add/remove longtext tinyMCE editor */
a.toggle_editor {
	display:block;
	float:right;
	text-align:right;
	color:#666666;
	font-size:1em;
	font-weight:normal;
}

div.ajax_loader {
	background: white url(<?php echo $vars['url']; ?>mod/qlyfe_theme/graphics/ajax_loader.gif) no-repeat center 30px;
	width:auto;
	height:100px;
	margin:0 10px 0 10px;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}



/* reusable elgg horizontal tabbed navigation 
   (used on friends collections, external pages, and riverdashboard mods)
*/
#elgg_horizontal_tabbed_nav {
	margin:0 0 5px 0;
	padding: 0;
	border-bottom: 2px solid #0078A8;
	display:table;
	width:100%;
}
#elgg_horizontal_tabbed_nav ul {
	list-style: none;
	padding: 0;
	margin: 0;
}
#elgg_horizontal_tabbed_nav li {
	float: left;
	border: 2px solid #0078A8;
	border-bottom-width: 0;
	background: #eeeeee;
	margin: 0 0 0 10px;
	-moz-border-radius-topleft:5px;
	-moz-border-radius-topright:5px;	
	-webkit-border-top-left-radius:5px;
	-webkit-border-top-right-radius:5px;
}
#elgg_horizontal_tabbed_nav a {
	text-decoration: none;
	display: block;
	padding:3px 10px 0 10px;
	color: <?php echo $mediumgray?>;
	text-align: center;
	height:21px;
}
/* IE6 fix */
* html #elgg_horizontal_tabbed_nav a { display: inline; }

#elgg_horizontal_tabbed_nav a:hover {
	color: <?php echo $lowlight?>;
	background: <?php echo $lightgray?>;
}
#elgg_horizontal_tabbed_nav .selected {
	border-color: #0078A8;
	background: white;
}
#elgg_horizontal_tabbed_nav .selected a {
	position: relative;
	top: 2px;
	background: white;
	color: <?php echo $lowlight?>;
}
/* IE6 fix */
* html #elgg_horizontal_tabbed_nav .selected a { top: 3px; }


/* ***************************************
	ADMIN AREA - REPORTED CONTENT
*************************************** */
.reportedcontent_content {
	margin:0 0 5px 0;
	padding:0 7px 4px 10px;
	-webkit-border-radius: 5px; 
	-moz-border-radius: 5px;
}
.reportedcontent_content p.reportedcontent_detail,
.reportedcontent_content p {
	margin:0;
}
.active_report {
	border:1px solid #D3322A;
    background:#F7DAD8;
}
.archived_report {
	border:1px solid #666666;
    background:<?php echo $lightgray?>;
}
a.archive_report_button {
	float:right;
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:<?php echo $button?>;
	border: 1px solid <?php echo $button?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	padding: 4px;
	margin:15px 0 0 20px;
	cursor: pointer;
}
a.archive_report_button:hover {
	background: <?php echo $button_hover?>;
	border: 1px solid <?php echo $button_hover?>;
	text-decoration: none;
}
a.delete_report_button {
	float:right;
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:<?php echo $mediumgray?>;
	border: 1px solid <?php echo $mediumgray?>;
	-webkit-border-radius: 4px; 
	-moz-border-radius: 4px;
	width: auto;
	padding: 4px;
	margin:15px 0 0 20px;
	cursor: pointer;
}
a.delete_report_button:hover {
	background: #333333;
	border: 1px solid #333333;
	text-decoration:none;
}
.reportedcontent_content .collapsible_box {
	background: white;
}


#tabs {
	font-size:100%;
	line-height:normal;
	overflow:hidden;
	width: 580px;
}

#tabs strong {
	font-weight: bold;
}

#tabs ul {
	margin:0;
	padding: 2px 0px 0px 0px;
	list-style:none;
	
	}

#tabs li {
	display:inline;
	margin:0px 2px;
	padding:0;
	}

#tabs a {
	margin-top:4px;
	background: <?php echo $lightbasic;?>;
	float:left;
	margin: 0px 1px;
	padding: 0px;
	text-decoration:none;
	border-bottom: 1px solid <?php echo $darkbasic?>;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-topleft: 5px; 
	-webkit-border-top-right-radius: 5px;
	-webkit-border-top-left-radius: 5px;
	width: 100px;
	height: 29px;
	text-align: center;;	
	color:<?php echo $darkgray;?>;
}

#tabs a span {
	font-size: 9pt;
}

/* Commented Backslash Hack hides rule from IE5-Mac \*/
#tabs a span {float:none;}

/* End IE5-Mac hack */
#tabs a:hover span {
	}

#tabs a:hover {
	background-color: <?php echo $lightgray?>;
	border-bottom: 1px solid <?php echo $lightgray?>;
	}

#tabs a.current_tab {
	background-color: <?php echo $lightgray?>;
	border-bottom: 1px solid <?php echo $lightgray?>;
}


#tabs a:hover span {
	background-color: <?php echo $lightgray?>;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-topleft: 5px; 
	-webkit-border-top-right-radius: 5px;
	-webkit-border-top-left-radius: 5px;
	border-bottom: 1px solid <?php echo $lightgray?>;
	}

#account_links {
/*  border: 3px solid <?php echo $gray;?>;
  background-color: #deebf8;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;*/
  width: 200px;
  text-align:center;
  padding-top: 10px;
 	color:#fff;
 padding-right:20px;
}

#account_links a {
	float: none;
 	color:#fff;
 	border: none;
}

#small_tabs {
	position:relative;
	top:1px;
	margin-top: 2px;
	float:left;
	font-size:100%;
	font-weight: bold;
	line-height:normal;
	overflow:hidden;
}

#small_tabs ul {
	margin:0;
	padding: 2px 0px 0px 0px;
	list-style:none;
	
	}

#small_tabs li {
	display:inline;
	margin:0;
	padding:0;
	}

#small_tabs a {
	float:left;
	margin: 1px;
	padding: 0px;
	text-decoration:none;
	border: 1px solid <?php echo $gray;?>;
	border-bottom: none;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-topleft: 5px; 
	-webkit-border-top-right-radius: 5px;
	-webkit-border-top-left-radius: 5px;
	text-align:center;
	}

#small_tabs a span {
	float:left;
	display:block;
	height:15px;
	margin:1px;
	color:#999;
	font-size: 9pt;
	padding: 2px;
	width: 100px;
	}

/* Commented Backslash Hack hides rule from IE5-Mac \*/
#small_tabs a span {float:none;}

/* End IE5-Mac hack */
#small_tabs a:hover span {
	}

#small_tabs a.current_small_tab {
	background-color: #fff;
	border-bottom: 1px solid #fff;
	}

#small_tabs a:hover {
	background-color: <?php echo $lightbasic?>;
	}

#small_tabs a:hover span {
	background-color: <?php echo $lightbasic?>;
	color: <?php echo $darkbasic?>;
	/*border-bottom: 1px solid #fff;*/
	}
#identity_tab {
	position:relative;
	top:1px;
	width: 100px; 
	height: 15px;
	background-color: #fff; 
	color: <?php echo $mediumgray?>;
	/*float: left;*/ 
	border-bottom: 1px solid: #FFFFFF;
	border: 1px solid <?php echo $gray;?>; 
	padding:2px;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-topleft: 5px; 
	-webkit-border-top-right-radius: 5px;
	-webkit-border-top-left-radius: 5px;
	text-align: center;
	font-weight: bold;
}

#identity_widget {
	border-top:1px solid <?php echo $gray?>;
	border-left:1px solid <?php echo $gray?>;
	border-bottom:1px solid <?php echo $gray?>;
	padding:10px;
	background: #fff;
}
#identity_widget h6 {
	color: <?php echo $mediumgray?>;
	margin: 2px 0px;
}
#identity_widget h5 {
	margin: 2px 0px;
}
#identity_widget .medium_icon_td img {
	width: 65px;
}
#identity_widget .large_icon_td img {
	width: 140px;
}


#sitename {
	font-size:20pt;
	color: #FFFFFF;
	font-family: arial rounded mt bold;
	width:170px;
	padding-left:20px;
}

#sitename a {
	color: #FFFFFF;
}
#sitename a:hover {
	text-decoration:none;
}

#header_table {
	margin: 0px auto;
	width:100%;
}

#header_table #header_right {
	margin: 0px;
	padding: 0px;
	border: none;
}
#header_table #header_middle {
	margin: 0px;
	padding: 0px;
	border: none;
	padding-top: 7px;
}
#header_table #header_left {
	margin: 0px;
	padding: 0px;
	border: none;
}

#header_table_bottom {
	margin: 0px auto;
}

#header_bottom_table #header_bottom_left {
	width: 170px;
	padding-top: 7px;
}
#header_bottom_table #header_bottom_middle {
	width: 590px;
	padding-top: 2px;
}
#header_bottom_table #header_bottom_right {
	width: 220px;
}

#search_box{
	width: 195px;
	height: 30px;
	text-align: center;
	background-color: <?php echo $lightgray?>;
	margin-top: 10px;
	padding-bottom: 8px;
}

#fancyMessageBox {
	width: 550px;
	min-height: 80px;
	background-color: #e5e5ff; 
	-moz-border-radius: 8px; 
	-webkit-border-radius: 8px;
	border: 1px solid <?php echo $gray;?>;
	margin: 0px auto;
	padding-top:10px;
}

#fancyMessageBox input.share_text {
	width: 450px;
	height: 20px;
}

#fancyMessageBox button.share_button {
	color: #999;
	background-color: #fff;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-bottomright: 5px; 
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	height: 31px;
	border: 1px solid <?php echo $gray;?>;
}

.networkSwitcher {
	background-color: #e5e5ff; 
	-moz-border-radius: 5px; 
	-webkit-border-radius: 5px;
	border: 1px solid <?php echo $gray;?>;
	width: 125px;
	float:left;
	display:block;
	margin-left: 10px;
}

#fancyMessageBox_expanded {
	width: 551px;
	height: 220px;
	background-color: #e5e5ff; 
	-moz-border-radius: 8px; 
	-webkit-border-radius: 8px;
	border: 1px solid <?php echo $gray;?>;
	margin: 0px auto;
	padding-top:10px;
	display: none;
}

#shareWithBox {
	width: 500px;
	height: 190px;
	background-color: #fff; 
	-moz-border-radius: 5px; 
	-webkit-border-radius: 5px;
	border: 1px solid <?php echo $gray;?>;
	margin: 0px auto;
	margin-top: 9px;
	margin-bottom: 15px;
	padding-top: 10px;
	padding-left: 10px;
	display: none;
}

#shareWithBox td {
	text-align: left;
}

#shareWithAllConnections {
	padding: 5px;
}

#shareWithFamilyList {
	float: left;
	display: block;
	width: 150px;
	padding-left: 5px;
}

#shareWithFriendsList {
	float: left;
	display: block;
	width: 150px;
	padding-left: 5px;
}

#shareWithOthersList {
	float: left;
	display: block;
	width: 150px;
	padding-left: 5px;
}

#postButton {
	width:100px;
	height:25px;
	background-color: #e5e5ff; 
	-moz-border-radius: 5px; 
	-webkit-border-radius: 5px;
	border: 1px solid <?php echo $gray;?>;
	margin-top: 35px;
}

input.qlyfe_search_input {
	width: 140px;
	height: 10px;
	margin-right: 0px;
	padding-right: 0px;
}

input.qlyfe_search_submit_button {
	color: #999;
	font-weight: bold;
	background-color: #fff;
	-moz-border-radius-topright: 3px;
	-moz-border-radius-bottomright: 3px; 
	-webkit-border-top-right-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
	width: 25px;
	height: 20px;
	border: 1px solid <?php echo $gray;?>;
}

.right_bar_box {
	width: 165px;
	height: 20px;
	margin-top: 10px;
	background-color: <?php echo $lightgray?>;
	border: 1px solid <?php echo $gray?>;
	text-align: center;
	color: <?php echo $mediumgray?>;
	font-weight: bold;
	padding-top: 6px;
}
.right_bar_box_connector {
	height:1px;
	width:10px;
	position:relative;
	top:-15px;
	left:-10px;
	background-color: <?php echo $gray?>;
}

#header_right_bottomest {
	width: 229px;
}

#header_right_bottomest a {
	color: <?php echo $mediumgray?>;	
}

#add_links_table {
	width: 450px;
	padding-left: 10px;
	padding-top: 5px;
}

#add_links_table a {
	color: <?php echo $mediumgray?>;
	font-weight: bold;
}

#share_box {
	width: 500px;
	height: 190px;
}

#identityWidget {
	font-size: 8pt;
	border-bottom: 1px solid <?php echo $gray;?>;
	border-left: 1px solid <?php echo $gray;?>;
	width: 170px;
	color: #999;
}

#identityWidget td {
	padding: 5px;
}

#profilesMenu {
	width: 160px;
	margin-top: 20px;
	border: 1px solid <?php echo $gray;?>;
}

.profilesMenuItem {
	font-size: 9pt;
	width: 155px;
	text-align: left;
	background-color: #deebf8;
	border-bottom: 1px solid <?php echo $gray;?>;
}

#privacySettings {
   display: block
	width: 200px;
	height: 225px;
	background-color: #8291a6;	
}

#privacySettings ul {
	background-color: #fff;	
}

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

#menu {
	margin-top: 20px;
	position:relative;
}

#menu ul {
	margin:0; 
	padding:0; 
	list-style:none; 
	white-space:nowrap; 
	text-align:left; 
}

#menu li {
	margin:0; 
	padding:0; 
	list-style:none;
}
#menu li {display:inline;}
#menu ul ul {position:absolute; left:-9999px;}
#menu ul#toplevel {position:absolute; left:0; top:0;}

#menu a {
	display:block; 
	font:normal 9pt verdana,arial,sans-serif; 
	background-color: #deebf8;
	border-bottom: 1px solid <?php echo $gray;?>;
	line-height:22px; 
	text-decoration:none;
	padding:0 0px 0 10px;
	border-left: 1px solid <?php echo $gray;?>;
	border-right: 1px solid <?php echo $gray;?>;	
	width: 150px;
	color: #000;
} 
	
#menu li a.fly {

}

#menu li a:hover {background-color:#8291a6; color:#deebf8;} 
#menu li:hover > a {background-color:#8291a6; color:#deebf8;}

#menu ul li:hover > ul {left:100%; margin-top:-23px; margin-left:-1px;}

#menu a:hover ul,
#menu a:hover a:hover ul, 
#menu a:hover a:hover a:hover ul {left:100%;}
#menu a:hover ul ul, 
#menu a:hover a:hover ul ul {left:-9999px;}

#menu #toplevel .fly ul {
	background-color: #8291a6;
	-moz-border-radius-topright: 5px;
	-moz-border-radius-bottomright: 5px; 
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	border: 1px solid #999;
	border-left: 0px;
	padding: 10px;
}

#menu #toplevel .fly ul li a {
	border-left: 0px;
	background-color: #fff;
	color: #5f8cb0;
	border: 0px;
	border-top: 1px dashed #999;
	padding: 7px;
	width: 180px;
}

#menu table {
	position:absolute; 
	left:99%; 
	height:0; 
	width:0; 
	border-collapse:collapse; 
	margin-top:-7px; 
	margin-left:-1px;
}

.contextual_menu {
	display:none;
	position:absolute;
	top:-6px;
	left:135px;
	width: 100px;
	background: <?php echo $darkgray?>;
	z-index: 1000;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
}
.contextual_menu_item {
	padding: 4px;
}
.contextual_menu a {
	color: #fff;
}
/* NOT USED
.contextual_menu_item_last {
	-webkit-border-bottom-right-radius: 5px;
	-moz-border-radius-bottomright: 5px;
	-webkit-border-bottom-left-radius: 5px;
	-moz-border-radius-bottomleft: 5px;
}
.contextual_menu_item_first {
	-webkit-border-top-right-radius: 5px;
	-moz-border-radius-topright: 5px;
	-webkit-border-top-left-radius: 5px;
	-moz-border-radius-topleft: 5px;
}*/
.contextual_menu_item:hover {
	background: <?php echo $darkbasic?>;
}
.contextual_menu_activator {
	position:absolute;
	top: 0px;
	left:135px;
	font-size: 10pt;
	color: <?php echo $mediumgray?>;
}

.delete_circle {
	position:absolute;
	top:2px;
	left:-10px;
	text-align:right;
	color: <?php echo $gray?>;
}
.delete_circle a {
	color: <?php echo $darkgray?>;
	text-decoration:none;
}
.userchooser_box {
	padding: 6px;
	border: 2px solid <?php $gray?>;
	width: 150px;
	height: 200px;
	overflow: auto;
	-moz-border-radius: 5px;
	background: #fff;
}
.userchooser_user a:hover {
	text-decoration:none;
}
.userchooser_user {
	display:table;
}