<?php

class User
{
	var $userId;
        var $username;
	var $email;
	var $passwordHash;
	var $roleId;
}


/*REgister new user*/
function registerUser($username,$email,$pass1,$pass2) {
    $register = FALSE;
    
    /*If all inputs validate and email and username are unique, move on*/
    if (validateUsername($username)&&
            checkUsername($username)&&
            validateEmail($email)&&
            checkEmail($email)&&
            validatePass($pass1)){
        if ($pass1 === $pass2){
            $hash = calculateHash($pass1);
            
            /*Insert info into the database*/
            global $db;
            $query = "INSERT INTO users(user_id, username, email, passwordhash, role_id) "
                    . "VALUES(NULL, :username, :email, :pass, '2')";
            
            $statement = $db->prepare($query);
            $statement->bindValue(":username",$username);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":pass", $hash);
            $statement->execute();
            
            /*Now get the information so you can get the userId which was auto-incremented*/
            $query2 = "SELECT * FROM users WHERE username = :username";
           
            $statement2 = $db->prepare($query2);
            $statement2->bindValue(":username", $username);
            $statement2->execute();
            $results = $statement2->fetchAll();
            $statement2->closeCursor();
            
            /*create new user object from information*/
            $user = new User();
            $user->userId = $results[0];
            $user->username = $results[1];
            $user->email = $results[2];
            $user->roleId = $results[4];
            setUserSession($user);
            
            /*registering worked, so change it to true!*/
            $register = TRUE;
        }
    }
    return $register;
}

/*log in for existing user*/
function loginUser($username, $password){
        $logIn = FALSE;
        
        if ($username && $password){
            $hash = calculateHash($password);
            
            /*find their info in the db based on username and password matching*/
            global $db;
            $query = "SELECT * FROM users WHERE username = :username AND passwordhash = :hash";
            
            $statement = $db->prepare($query);
            $statement->bindValue(":username", $username);
            $statement->bindValue(":hash",$hash);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            
            /*if you get results, create the new user object*/
            if (is_array($results) && array_key_exists(0, $results)) {
			$user = new User();
			$user->userId = $results[0];
                        $user->username = $results[1];
			$user->roleId = $results[4];
			setUserSession($user);
		$logIn = TRUE;
            }
            
        }
    return logIn;
}

/*----------Input validation functions--------*/
/*--------------------------------------------*/
function validateRegisterMessages($username,$email,$pass1,$pass2){
    $message = "";
    if (validateUsername($username, $message)== false){
        $message .= "Username must be at least 3 characters long<br />";
    }
    if (checkUsername($username, $message)==false){
        $message .= "This username is already in use <br />";
    }
    if (validateEmail($email, $message)==false){
        $message .= "Invalid Email address<br />";
    }
    if (checkEmail($email, $message)==false){
        $message .= "This email is already in use<br />";
    }
    if (validatePass($pass1, $message)==false){
        $message .= "Password must be at least 5 characters long<br />";
    }
    if ($pass1 != $pass2){
        $message .= "Passwords did not match";
    }
    return $message;
}
function validateUsername($username){
    if (strlen($username) >= 3) {
		return TRUE;	
	} else{
		return FALSE;
	} 
}
function checkUsername($username){
    global $db;
    $query = "SELECT * FROM users WHERE username = :username";
    
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    
    if(is_array($results) && count($results)===0 ){
        return TRUE;
                
    } else {
        return FALSE;
    }
    
}
function validateEmail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	
	return FALSE;
}
function checkEmail($email){
    global $db;
    $query = "SELECT * FROM users WHERE email = :email";
            
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    
    if(is_array($results) && count($results)===0 ){
        return TRUE;
                
    } else {
        return FALSE;
    }
}

function validatePass($password){
    if (strlen($password) >= 5) {
		return TRUE;	
	} else {
		return FALSE;
	} 
}

/*Not very secure password hash but better than nothing*/
function calculateHash($password){
    return sha1($password . 'IShouldMakeSomeRandomSaltLater12345');
}


/*-------User session functions------*/
/*-----------------------------------*/
function setUserSession(User $user) {
	$_SESSION['UserID'] = $user->userId;
        $_SESSION['Username'] = $user->username;
        $_SESSION['UserEmail'] = $user->email;
	$_SESSION['UserRole'] = $user->roleId;
}

/*gets user Id of the person who is currently logged in, if logged in*/
function getLoggedInUserID(){
	return (array_key_exists('UserID', $_SESSION)) ? $_SESSION['UserID'] : null;
}

/*checks to see if someone is logged in!*/
function sessionCheck(){
	return(getLoggedInUserID() != null);
}

/*checks to see if user is logged in as admin*/
function loggedInAsAdmin($userarray){
    $roleId = $userarray[4];
    
    if ($roleId == 1){
        return "true";
    } else {
        return "false";
    }
}


/*----------GEt info to display on account page-----*/
/*--------------------------------------------------*/
function getAccountInfo($userarray){
    $roleId = $userarray[4];
    $roleName = getRoleName($roleId);
    
    $accountinfo = "<h2>Account Information:</h2><table>"
            . "<tr><td>User ID:</td><td>".$userarray[0]."</td></tr>"
            . "<tr><td>Username:</td><td>".$userarray[1]."</td></tr>"
            . "<tr><td>Email:</td><td>".$userarray[2]."</td></tr>"
            . "<tr><td>Role:</td><td>".$roleName."</td></tr></table>";
    
    return $accountinfo;
}

/*GEts role name that corresponds with the ID number */
function getRoleName($roleId){
    global $db;
    $query = "SELECT role_name FROM roles WHERE role_id = :role_id";
            
    $statement = $db->prepare($query);
    $statement->bindValue(':role_id', $roleId);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    
    return $result[0];
}


/*---------------------Edit Users-----------------------*/
/*------------------------------------------------------*/
function getAllUsers(){
    global $db;
    $query = "SELECT user_id, username, email, role_id FROM users";
            
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    
    return $results;
}
function deleteUser($userId){
    global $db;
    $query = "DELETE FROM users WHERE user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":user_id",$userId);
    $statement->execute();
    $statement->closeCursor();    
}
function changeUserRole($userId,$changeRole){
    $changeID = 1;
    
    global $db;
    $query = "UPDATE users SET role_id = :change_id WHERE user_id = :user_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":user_id",$userId);
    $statement->bindValue(":change_id", $changeID);
    $statement->execute();
}



