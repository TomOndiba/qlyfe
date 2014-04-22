<?php
	/**
	 * This is basically the javascript for any connection between entities
	 * It's in its own file so we can make sure it's only loaded once by each page
	 * If we put it with each dialog it would be loaded many more times
	 */

	if (isloggedin()) {
		$ts = time();
		$token = generate_action_token($ts);
		$remove_url = "{$vars['url']}action/connect/remove?__elgg_token=$token&__elgg_ts=$ts";
		$add_url = "{$vars['url']}action/connect/add?__elgg_token=$token&__elgg_ts=$ts";
?> 
	<script language='javascript'>
		function ConnectionDialog() {
			this.user_id = null;
			this.open_connect_dialogs = null;

			// our open function for opening the dialog
			this.open = function(user_id) {
				 	this.user_id = user_id;
						$("#connect-dialog" + user_id).dialog({
							modal: true,
							position: ["center",50]
						});
					this.open_connect_dialogs = new Array();
					this.set_submit_button();
					var connect_as_friends = $("#friends_connect_cb").is(":checked");
					var connect_as_family = $("#friends_connect_cb").is(":checked");
					$("#connect-dialog" + user_id + "-contents").load("<?php echo $vars['url']?>connect/dialog.php?entity=" + user_id);
			 }
			 this.connect = function() {

				var networks = "";
				var connect_as = "";
				$("#connect-dialog" + this.user_id + "-contents input[name=connect_as]:checked").each(function () {
					network = $(this).val(); // type = friends/family etc
					networks += network + ",";
					var clist = $("#" + network + "_classifier").val();
					var relationship = $("#" + network + "_relationship").val();

					connect_as += "&" + network + "_clist=" + escape(clist) + 
						"&" + network + "_relationship=" + escape(relationship);
				});

				// @todo QLYFE BAP .. do some error checking (esp if they're not done)
				 
				 var add_url = "<?php echo $add_url?>";
				 document.location.href = add_url + "&guid=" + this.user_id + "&networks=" + networks + connect_as;
			 }
			 // for breaking our connection.. no need to open and set the userid and everyything
			 this.disconnect = function(user_id) {
				 var remove_url = "<?php echo $remove_url?>";
				 document.location.href = remove_url + "&guid=" + user_id;
			 }

			 this.showing = function(network) {
				 if ($.inArray(network, this.open_connect_dialogs) == -1)
					 this.open_connect_dialogs.push(network);
				 this.set_submit_button();
			 }
			 this.not_showing = function(network) {
				 // remove this network from our dialogs array
				 this.open_connect_dialogs = $.grep(this.open_connect_dialogs, function(value) {
					 return value != network;
				 });
				 this.set_submit_button();				 
			 }

			 // determine if our submit button should be enabled or disabled
			 this.set_submit_button = function() {
				 if (this.open_connect_dialogs.length > 0) {
						$("#connection_submit_button").attr("disabled", "disabled");
				 } else if ($("#connect-dialog" + this.user_id + "-contents input[name=connect_as]:checked").length == 0) {
						$("#connection_submit_button").attr("disabled", "disabled");
				 } else {
						$("#connection_submit_button").removeAttr("disabled");
				 }
			 }	 

			 this.cancel = function() {
				 $("#connect-dialog" + this.user_id).dialog("close");
			 }
		}
		var connectDialog = new ConnectionDialog();
	 </script>
<?php  }?>