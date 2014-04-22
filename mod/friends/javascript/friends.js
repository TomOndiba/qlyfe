/** deleting a friends circle **/
function deleteCircle(id, name) {
	if (confirm("Are you sure you want to delete '" + name + "'?"))
		document.location.href = "/pg/friendscircle/delete?id=" + id + "&name=" + name;
}

/** deleting a friends circle **/
function editCircle(id, name) {
	$("#create-friends-circle").dialog({
		modal: true,
		width: "470px",
		height: 420
	});
	$("#create-friends-circle").load("/mod/friends/circles/ajax-dialog.php?id=" + id + "&name=" + escape(name));
	// now we have to pre-populate the id's
}


/** friends circle dialog **/
function friendsCircleDialog() {
	$("#create-friends-circle").dialog({
		modal: true,
		width: "470px",
		height: 420
	});
	$("#create-friends-circle").load("/mod/friends/circles/ajax-dialog.php");
}
function createFriendsCircle() {
	var name = $("#create-friends-circle input[name=name]").val();
	var share = $("#create-friends-circle input[type=checkbox]").is(":checked");
	var users = $("#create-friends-circle input[name=userchooser]").val();
	var id = $("#create-friends-circle input[name=id]").val();
	if (id)
		document.location.href = "/pg/friendscircle/update?name=" + escape(name) + "&id=" + id + "&share=" + share + "&users=" + users;
	else
		document.location.href = "/pg/friendscircle/add?name=" + escape(name) + "&share=" + share + "&users=" + users;
}

