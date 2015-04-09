<?php
$userarray = getLoggedInUserID();
$accountinfo = getAccountInfo($userarray);
$admin = loggedInAsAdmin($userarray);
?>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="/js/validate-user.js" ></script>

<div class="content">
    <div id="account">
    <?php echo $accountinfo; ?>
    
    <?php if($admin=="true") : ?>

    <h2>Admin Items:</h2>
	<ul>
            <li><a href="/?action=newPost">Create New Post</a></li>
            <li><a href="/?action=managePosts">Manage Posts</a></li>
            <li><a href="/?action=editUsers">Edit Users</a></li>
	</ul>

    <?php endif; ?>
    
    <!--add option to update personal information at later date-->
    <!--<form action="/?action=updateUserInfo" method="POST" id="updateform">
		<input type="hidden" name="actiontype" id="actiontype" value="" />
		<fieldset>
			<legend>Update Account Information</legend>
                        <ul>
                            <li><label for="username">Username:</label>
                                <input type="text" name="username" id="username"/></li>
                            <li><label for="email">Email Address:</label> 
                                <input type="email" name="email" id="email"/></li>
                            <li><label for="currentpass">Current Password:</label>
                                <input type="password" name="currentpass" id="currentpass"/></li>
                            <li><button name="register" id="buttUpdateUser">Update</button></li>
                        </ul>
		</fieldset>
    </form>
                
    <form action="/?action=updateUserPass" method="POST" id="updatepassform">
		<input type="hidden" name="actiontype" id="actiontype" value="" />
                
                <fieldset>
                    <legend>Update Password</legend>
                        <ul>
                            <li><label for="password">New Password:</label> 
                                <input type="password" name="password" id="password"/></li>
                            <li><label for="confirm_password">Confirm Password:</label>
                                <input type="password" name="confirm_password" id="confirm_password"/></li>
                            <li><label for="currentpass2">Current Password:</label>
                                <input type="password" name="currentpass2" id="currentpass2"/></li>
                            <li><button name="register" id="buttUpdatePass">Update</button></li>
                        </ul>
		</fieldset>
                    
	</form>	-->
    </div>
</div>

