<div id="content">
    <form action="/?action=registersubmit" method="POST" id="registerform">
        <input type="hidden" name="actiontype" id="actiontype" value="" />
            <fieldset>
		<legend>Create Account</legend>
                <ul>
                    <li><label for="txtusername">Username:</label>
                        <input type="text" name="username" id="txtusername"/></li>
                    <li><label for="txtemail">Email Address:</label> 
                        <input type="email" name="txtemail" id="txtemail"/></li>
                    <li><label for="txtpassword1">Password:</label> 
                        <input type="password" name="txtpassword1" id="txtpassword1"/></li>
                    <li><label for=txtpassword2">Verify Password:</label>
                        <input type="password" name="txtpassword2" id="txtpassword2"/></li>
                    <li><button name="register" id="buttonRegister">Register</button></li>
                </ul>
            </fieldset>
    </form>		
    <form action="/?action=loginsubmit" method="POST" id="loginform">
            <fieldset>
                <legend>Log In</legend>
		Email: <input type="text" name="emaillogin" id="emaillogin" /><br />
		Password: <input type="password" name="passwordlogin" id="passwordlogin" /><br />
		<button name="login" id="buttonLogin">Log In</button>
            </fieldset>
    </form>
</div>