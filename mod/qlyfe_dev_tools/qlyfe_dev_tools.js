function debug(str) {
	$("<div/>").load("/mod/qlyfe_dev_tools/debug.php?debug=" + escape(str));
}