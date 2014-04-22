<?php

	/**
	 * Elgg footer 
	 * The standard HTML footer that displays across the site
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.org/
	 * 
	 */
	 
	 // get the tools menu
	//$menu = get_register('menu');

?>

<div id="layout_footer">
<table width="958" border="0" cellpadding="0" cellspacing="0">

	<?php if (false) { ?>
	<tr>
		<td width="210" height="10">

		</td>
		
		<td width="748" height="10" align="right">
		<p class="footer_toolbar_links">
		<?php
			echo elgg_view('footer/links');
		?>
		</p>
		</td>
	</tr>
	<?php } ?>
	
	<tr>
		<td width="210" height="10">
		</td>
		
		<td width="748" height="10" align="right" style='padding-right:50px;'>
		<p class="footer_legal_links"><small>
		 Qlyfe Inc. Copyright 2010. All rights reserved.
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