<?php
$postsarray = getAllPosts();
?>
<script src="../js/manage-posts.js"></script>
<div class="content">
    <div id="managePosts">
    <h2>Manage Posts</h2>
    <table>
        <tr>
            <th>Post ID</th>
            <th>Post Date</th>
            <th>Title</th>
            <th>Delete Post</th>
        </tr>
            <?php foreach ($postsarray as $post) : ?>
			
			<tr>
				<td><?php echo $post[0]; ?></td>
				<td><?php echo $post[1]; ?></td>
				<td><?php echo $post[2]; ?></td>
				<td><button onclick="deletePost(<?php echo $post[0]; ?>)">Delete</button></td>
			</tr>

		<?php endforeach; ?>
	</table>
    <a href="/?action=account" title="Back to Account">Back to Account</a>
    </div>
</div>