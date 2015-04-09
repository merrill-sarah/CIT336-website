<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="/js/validate-post.js"></script>
<div class="content">
    <div id="newPost">
    <form action="index.php?action=newPostSubmit" method="POST" id="newPostForm">
            <input type="hidden" name="actiontype" id="actiontype" value="" />
		<fieldset>
			<legend>Create a New Post</legend>
                        <ul>
                            <li><label for="postTitle"> Post Title:</label>
                                <input type="text" name="postTitle" id="postTitle" /></li>
                            <li><textarea name="postContent"></textarea></li>
                            <li><button name="submitPost" id="submitPost">Post</button></li>
                        </ul>
		</fieldset>
	</form>
    <a href="/?action=account" title="Back to Account">Back to Account</a>
    </div>
</div>

