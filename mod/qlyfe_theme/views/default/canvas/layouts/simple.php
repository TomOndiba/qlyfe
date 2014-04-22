<?php

/**
 * Elgg widget layout
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */

$owner = page_owner_entity();

echo "<center><div id='simple_layout'>";
echo $vars['area1'];
echo $vars['area2'];
echo "</div></center>";
