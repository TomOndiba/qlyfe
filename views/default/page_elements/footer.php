<?php
/**
 * Elgg footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 *
 */

// get the tools menu
//$menu = get_register('menu');

?>

<div class="clearfloat"></div>

<div id="layout_footer">
<table width="958" height="79" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="210" height="50">

		</td>

		<td width="748" height="50" align="right">
		<p class="footer_toolbar_links">
		<?php
			echo elgg_view('footer/links');
		?>
		</p>
		</td>
	</tr>

	<tr>
		<td width="210" height="28">
		</td>

		<td width="748" height="28" align="right">
		<p class="footer_legal_links"><small>
		Copyright 2010 Qlyfe Inc. All rights reserved.
		</small>
		</p>
		</td>
	</tr>
</table>
</div><!-- /#layout_footer -->

<div class="clearfloat"></div>

</div><!-- /#page_wrapper -->
</div><!-- /#page_container -->
<!-- insert an analytics view to be extended -->
<?php
	echo elgg_view('footer/analytics');
?>
</body>
</html>