<?php

session_start();

/*add required models*/
require "models/db.php";
require "models/navigation.php";
require "models/blogposts.php";
require "models/validate-input.php";

/*include views*/
include "views/header.php";

/*get action and sanitize the string/change to all lowercase*/
$action = strtolower(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING));

/*use switch statements to determine which page to load based on action*/
switch ($action) {
    case "blog":
        $page = 0;
        include "views/blog-index.php";
        break;
    
    case "viewPost":
        $page = 0;
        include 'views/blog-index.php';
        break;
    
    case "about":
        include "views/about.php";
        break;
        
    case "contact":
        include "views/contact.php";
        break;
    
    case "account":
        break;
    
    case "login":
        include "views/login.php";
        break;
    
    case "logout":
        include "views/logout.php";
        break;
    
    default:
        $page = 0;
        include "views/blog-index.php";
}

include "views/footer.php";

