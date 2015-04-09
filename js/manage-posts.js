function deletePost(id) {
	var confirmed = confirm("Are you sure you want to remove this post?");
	
	if (confirmed) {
            //AJAX later?
		window.location = '/?action=deletePost&postId=' + id;
	}	
}

