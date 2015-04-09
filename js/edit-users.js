function changeUserRole(id, role) {
	var confirmed = confirm("Change the user's role to: " + role);
	
	if (confirmed) {
		//AJAX instead?
		window.location = 'index.php?action=changeRole&userId=' + id + '&role=' + role;
	}
}

function deleteUser(id) {
	var confirmed = confirm("Are you sure you want to remove this user?");
	
	if (confirmed) {
		//AJAX instead?
		window.location = '/?action=deleteUser&userId=' + id;
	}	
}