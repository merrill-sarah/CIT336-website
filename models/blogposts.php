<?php

function getBlogPostsAll(){
    global $db;
    $query = "SELECT * FROM post ORDER BY post_id DESC";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $postitems = $statement->fetchAll();
        $statement->closeCursor();
        
    } catch (Exception $ex) {

    }
    if(!empty($postitems)){
        return $postitems;
    }
    else {
        return FALSE;
    }
}

function getBlogPostsID($postID){
    global $db;
    $query = "SELECT * FROM post WHERE post_id = :post_id ORDER BY post_id DESC";
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':post_id',$postID);
        $statement->execute();
        $postitems = $statement->fetchAll();
        $statement->closeCursor();
    } catch (Exception $ex) {

    }
    if(!empty($postitems)){
        return $postitems;
    } else {
        return FALSE;
    }
}

function getBlogPostsMonth($monthID,$yearID) {
    global $db;
    $query = "SELECT * FROM post WHERE month_id = :month_id AND year_id = :year_id ORDER BY post_id DESC";
    
    try{
        $statement = $db->prepare($query);
        $statement->bindValue(':month_id', $monthID);
        $statement->bindValue(':year_id', $yearID);
        $statement->execute();
        $postitems = $statement->fetchAll();
        $statement->closeCursor();
    } catch (Exception $ex) {

    }
    if(!empty($postitems)){
        return $postitems;
    } else {
        return FALSE;
    }
}

function getBlogPostsYear($yearID){
    global $db;
    $query = "SELECT * FROM post WHERE year_id = :year_id ORDER BY post_id DESC";
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':year_id', $yearID);
        $statement->execute();
        $postitems = $statement->fetchAll();
        $statement->closeCursor();
    } catch (Exception $ex) {

    }
    if(!empty($postitems)){
        return $postitems;
    } else {
        return FALSE;
    }
}

function createBlogPages($postitems){
    if ($postitems === FALSE ){
        echo 'There are no posts at this time.';
    }
    else {
        $pageitems = array_chunk($postitems, 2);
        return $pageitems;
    }
    
}

function createBlogContent($page, $postitems){
    $pageitems = createBlogPages($postitems);
    $content = "";
    
    for ($i=0; $i<2; $i++){
        $content .= "<div><h1>".$pageitems[$page][$i][5]."</h1><h2>".$pageitems[$page][$i][4]."</h2><p>".$pageitems[$page][$i][6]."</p></div>";
    }
    if(!empty($content)){
        return $content;
    }
    else {
        echo 'There was an error loading blog posts.';
    }
}

