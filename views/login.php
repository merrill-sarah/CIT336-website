

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="/js/validate-user.js" ></script>


<div id="loginregister" class="content" >
    <div class="error"><?php
        echo $message;
        ?></div>
        <form action="/?action=loginSubmit" method="POST" id="loginform">
            <input type="hidden" name="actiontype" id="actiontype1" value="" />
		<fieldset>
			<legend>Login with existing account</legend>
                        <ul>
                            <li><label for="loginusername"> Username:</label>
                                <input type="text" name="loginusername" id="loginusername" /></li>
                            <li><label for="loginpassword">Password:</label>
                                <input type="password" name="loginpassword" id="loginpassword" /></li>
                            <li><button name="login" id="buttLogin">Login</button></li>
                        </ul>
		</fieldset>
	</form>
	
	
	<br /><br />
	<form action="/?action=registerSubmit" method="POST" id="registerform">
		<input type="hidden" name="actiontype" id="actiontype2" value="" />
		<fieldset>
			<legend>Register a new account</legend>
                        <ul>
                            <li><label for="username">Username:</label>
                                <input type="text" name="username" id="username"/></li>
                            <li><label for="email">Email Address:</label> 
                                <input type="email" name="email" id="email"/></li>
                            <li><label for="password">Password:</label> 
                                <input type="password" name="password" id="password"/></li>
                            <li><label for="confirm_password">Confirm Password:</label>
                                <input type="password" name="confirm_password" id="confirm_password"/></li>
                            <li><button name="register" id="buttRegister">Register</button></li>
                        </ul>
		</fieldset>
	</form>	
	
</div>