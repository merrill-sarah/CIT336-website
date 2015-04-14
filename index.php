<?php

ob_start();
session_start();

/*add required models*/
require "models/db.php";
require "models/navigation.php";
require 'models/users.php';
require 'models/posts.php';
/*include views*/
include "views/header.php";

/*get action and sanitize the string*/
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

/*use switch statements to determine which page to load based on action*/
switch ($action) {
    case "blog":
        include "views/blog-index.php";
        break;
    
    case "viewPost":
        include 'views/blog-index.php';
        break;
    
    case "about":
        include "views/about.php";
        break;
    
    case "account":
        $page = (sessionCheck()) ? 'views/account.php' : 'views/login.php';
        include $page;
        break;
    
    case "login":
        include "views/login.php";
        break;
    
    case "loginSubmit":
            $username = filter_input(INPUT_POST, 'loginusername', FILTER_SANITIZE_STRING);
	    $password = filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING);
            
            if (loginUser($username, $password)){
            $message = "Incorrect log in information";
            $page = (sessionCheck()) ? 'account' : 'login';
            }
            if ($page === "login"){
                include 'views/login.php';
            } else {
                header("Location:index.php?action=account");
                exit;
            }
            
            break;
        
    case "registerSubmit":
            $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	    $pass1 = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $pass2 = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
            
            
            if(!registerUser($username, $email, $pass1, $pass2)){
                $message = validateRegisterMessages($username, $email, $pass1, $pass2);
                $page = (sessionCheck()) ? 'account' : 'login';
            }
            if ($page === "login"){
                include 'views/login.php';
            } else {
                header("Location:index.php?action=account");
                exit;
            }
            
        break;
    case "newPost":        
        $userarray = getLoggedInUserID();
        $admin = loggedInAsAdmin($userarray);
        
        if($admin=="true"){
        include 'views/new-post.php';
        }
        break;
        
    case "newPostSubmit":
        $postTitle = filter_input(INPUT_POST, 'postTitle', FILTER_SANITIZE_STRING);
	$postContent = filter_input(INPUT_POST, 'postContent', FILTER_SANITIZE_STRING);
        
        $userarray = getLoggedInUserID();
        $admin = loggedInAsAdmin($userarray);
        
        if($admin=="true"){
           if (submitNewPost($postTitle,$postContent)){
                header('Location: index.php?action=blog');
                exit;
           }else {
                header('Location: index.php?action=newPost');
                exit();
           }
        }
        
        break;
    case "deletePost":
        $postId = (int) filter_input(INPUT_GET, 'postId', FILTER_SANITIZE_NUMBER_INT);
        
        $userarray = getLoggedInUserID();
        $admin = loggedInAsAdmin($userarray);
        
        if($admin=="true"){
            deletePost($postId);
        }
        
        header('Location: index.php/?action=managePosts');
        exit();
        
        
    case "managePosts":
        $userarray = getLoggedInUserID();
        $admin = loggedInAsAdmin($userarray);
        
        if($admin=="true"){
            include 'views/manage-posts.php';
        }
        break;
        
    case "editUsers":
        $userarray = getLoggedInUserID();
        $admin = loggedInAsAdmin($userarray);
        
        if($admin=="true"){
        include 'views/edit-users.php';
        }
        break;
        
    case "changeRole":
        $userId = (int) filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_NUMBER_INT);
        $role = filter_input(INPUT_GET,'role',FILTER_SANITIZE_STRING);
       
        $userarray = getLoggedInUserID();
        $admin = loggedInAsAdmin($userarray);
        
        if($admin=="true"){
        changeUserRole($userid, $role);
        }
        
        
        header('Location: index.php?action=editUsers');
        exit();
        
    case "deleteUser":
        $userId = (int) filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_NUMBER_INT);
        
        $userarray = getLoggedInUserID();
        $admin = loggedInAsAdmin($userarray);
        
        if($admin=="true"){
            deleteUser($userId);
        }
        
        header('Location: index.php/?action=editUsers');
        exit();        
        
    case "logout":
        session_destroy();
        $_SESSION = array();
        header('Location: /');
        exit;
        break;
    
    case "sitePlan":
        include 'views/footer/site-plan.php';
        break;
    
    case "teachPres":
        include 'views/footer/teach-pres.php';
        break;
    
    default:
        include "views/blog-index.php";
}

include "views/footer.php";

