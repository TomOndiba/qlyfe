	function hide_clist_chooser(name) {
		$("#" + name + "_clist_chooser").slideUp();
	}

	function set_clist(name, value) {
		// set the hidden value
		if (value == null || value == "") {
			value = "private";
			$("#" + name + "_private").attr("checked", true);

		}
		
		$("#" + name).val(value);
		
		// set the text
		var array = value.split(",");
		var text = "";
		for (var i = 0; i < array.length; i++) {
			var classifier = array[i];
			//debug("before " + classifier + " after " + classifier.replace("/[^a-z0-9]/", "_"));
			var input = $("#" + name + "_" + classifier.replace("/", "_").replace("'", "_").replace(" ", "_"));
			text += input.attr("guiname") + ", ";
		}
		// remove the last comma and space when setting our text
		$("#" + name + "_classifier").text(text.slice(0,text.length-2));	
	}
	function get_clist(name) {
		return $("input[name=" + name + "]").val();
	}

	// will replace the clist with a new one
	function replace_clist(name, newlist) {
		set_clist(name, newlist);
	}

	// gets called when you first start up 
	function build_clist_raw(name) {
		
		// go through each master 
		$("#" + name + "_clist_chooser .nop_classifier_input_master").each( function () {
			var children = get_clist_children(name, $(this).attr("network"));
			
			if ($(this).is(":checked"))
				children.attr("checked", true);
			if (children.filter(":checked").length > 0)
				$(this).attr("checked", true);
				
			//else
			//	children.attr("checked", false);
		});
		generate_clist(name);
	}

	// gets called when you click on non-public/private master 
	function build_clist_master(name, network) {
		// first uncheck public and private
		$("#" + name + "_clist_chooser input[name=" + name + "_clist_chooser_p]").attr('checked', false);

		// go through each master 
		var master = $("#" + name + "_clist_chooser .nop_classifier_input_master[network=" + network + "]").each( function () {
			if ($(this).attr("network") == network) {
				var children = get_clist_children(name, $(this).attr("network"));
				children.attr("checked", $(this).is(":checked"));
			}
		});
		generate_clist(name);
	}
	
	// gets called when you click on non-public/private non-master
	function build_clist(name) {
		
		// first uncheck public and private
		$("#" + name + "_clist_chooser input[name=" + name + "_clist_chooser_p]").attr('checked', false);

		// go through each master 
		$("#" + name + "_clist_chooser .nop_classifier_input_master").each( function () {
			var children = get_clist_children(name, $(this).attr("network"));

			// if one of the children is checked then make sure the master is checked
			if (children.filter(":checked").length > 0)
				$(this).attr("checked", true);
			// otherwise make sure the master isn't checked
			else
				$(this).attr("checked", false);
		});
		
		generate_clist(name);
	}

	function get_clist_children(name, network) {
		return $("#" + name + "_clist_chooser .nop_classifier_input[network=" + network + "]");
	}
	
	// generate our clist based on which checkboxes are selected
	function generate_clist(name) {
		// build the list assuming all of the selections are correct
		var newlist = new Array();
		
		$("#" + name + "_clist_chooser .nop_classifier_input_master").each( function () {
			var children = get_clist_children(name, $(this).attr("network"));
			if ($(this).is(":checked")) {
				if (children.length == children.filter(":checked").length) {
					// alrighty ... now if they are all checked then add the master to the list
					newlist.push($(this).val());
					
				} else {
					// otherwise add the children to the list
					children.filter(":checked").each(function () {
						newlist.push($(this).val());
					});
				}
			}
		});
		set_clist(name, newlist.join(","));
	}
	
	// disable all networks (except public) by unclicking them and disabling the children
	function disable_clist_networks(name) {
		$("#" + name + "_clist_chooser .nop_classifier_input_master").each( function () {
			$(this).attr("checked", false);
		});
		$("#" + name + "_clist_chooser .nop_classifier_input").each( function () {
			$(this).attr("checked", false);
		});
	}

	// this is how we build the clist when either "public", "private" is checked
	// we first have to disable all of the other by unclicking all of the masters
	// and disabling all of the other dudes
	function build_clist_p(name)	{
		disable_clist_networks(name);
		var value = $("#" + name + "_clist_chooser input[name=" + name + "_clist_chooser_p]:checked").val();
		set_clist(name, value);
	}
	
	// this gets called when the access level is initially loaded
	function populate_clist(name, clist) {
		// for public and private its easy
		if (clist == 'public' || clist == 'private') {
			disable_clist_networks(name);
			$("#" + name + "_" + clist).attr("checked", true);
			build_clist_p(name);
		} else {
			var array = clist.split(",");
			for (var i = 0; i < array.length; i++) {
				// first get the correct input for this classifier and check it
				var value = array[i];
				var input = $("#" + name + "_clist_chooser input[value=" + value + "]");
				input.attr("checked", true);
				//var network = input.attr("network");
				
				// now using the network to identify the master, also check it
				//$("#" + name + "_clist_chooser .nop_classifier_input_master[network=" + network + "]").attr("checked", true);
			}
			build_clist_raw(name);
		}
	}	
