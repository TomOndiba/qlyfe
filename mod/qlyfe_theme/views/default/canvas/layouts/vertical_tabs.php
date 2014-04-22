<?php

/**
 * Elgg widget layout
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */

//$owner = page_owner_entity();

echo "<center>";
echo "<table cellpadding='0' cellspacing='0'><tr>";

	echo "<td valign='top'><div id='vertical_tabs_layout_tabs'>";
	echo "<div id='vertical_tabs_wrapper'>";
	echo $vars['area1'];
	echo "</div>";
	echo "</div></td>";

	echo "<td valign='top'><div id='vertical_tabs_layout_content'>";
	echo $vars['area2'];
	echo "<br/>";
	echo "</div></td>";

echo "</table>";
echo "</center>";
