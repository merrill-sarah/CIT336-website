<?php
$usersarray = getAllUsers();
?>
<script src="../js/edit-users.js"></script>
<div class="content">
    <div id="editUsers">
    <h2>Edit Users</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Delete User</th>
            <th>Change Role</th>
        </tr>
            <?php foreach ($usersarray as $user) :
			$roleName = 'User';
			$changeRole = 'Admin';
			
			if ($user[3] == '1'){
				$roleName = 'Admin';
				$changeRole = 'User';
			}
			?>
			
			<tr>
				<td><?php echo $user[0]; ?></td>
				<td><?php echo $user[1]; ?></td>
				<td><?php echo $user[2]; ?></td>
				<td><?php echo $roleName; ?></td>
				<td><button onclick="deleteUser(<?php echo $user[0]; ?>)">Delete</button></td>
				<td><button onclick="changeUserRole(<?php echo $user[0]; ?>,'<?php echo $changeRole; ?>');">Make <?php echo $changeRole; ?></button></td>
			</tr>

		<?php endforeach; ?>
	</table>
    <a href="/?action=account" title="Back to Account">Back to Account</a>
    </div>
</div>