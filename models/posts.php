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

/*Currently unused, will add later
function createBlogPages($postitems){
    if ($postitems === FALSE ){
        echo 'There are no posts at this time.';
    }
    else {
        $pageitems = array_chunk($postitems, 2);
        return $pageitems;
    }
    
}
 */

function createBlogContent($postitems){
    $content = "";
    /* Currently unused, might add later
    if (isset($page)){
        $pageitems = createBlogPages($postitems);

        for ($i=0; $i<2; $i++){
            $content .= "<div><h1>".$pageitems[$page][$i][5]."</h1><h2>".$pageitems[$page][$i][4]."</h2><p>".$pageitems[$page][$i][6]."</p></div>";
        }
        if (empty($content)){
            echo 'There are no more blog posts.';
        }
    }
    else {*/
    foreach ($postitems as $item){
        $content .= "<div class='blogpost'><h1>".$item[5]."</h1><h2>".$item[4]."</h2><p>".$item[6]."</p></div>";
    } 
    
    if(!empty($content)){
        return $content;
    }
    else {
        echo 'There was an error loading blog posts.';
    }
}

/*get all blog posts for post manager*/
function getAllPosts(){
    global $db;
    $query = "SELECT post_id, post_date, post_title FROM post";
    $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
    return $results;
}

function deletePost($id){
    global $db;
    $query = "DELETE FROM post WHERE post_id = :post_id";
    $statement = $db->prepare($query);
            $statement->bindValue("post_id",$id);
            $statement->execute();
            $statement->closeCursor();
}

function submitNewPost($postTitle, $postContent){
    $submit = FALSE;
    if ($postTitle && $postContent){
    global $db;
    $query = "INSERT INTO post (post_id, year_id, month_id, user_id, post_date, post_title, post_content) "
            . "VALUES (NULL, '2', '4', '1', UTC_DATE(), :post_title, :post_content)";
    
            $statement = $db->prepare($query);
            $statement->bindValue(":post_title", $postTitle);
            $statement->bindValue(":post_content", $postContent);
            $statement->execute();
            $statement->closeCursor();
            
            $submit = TRUE;
    }
    return $submit;
}

function getYearId($year){
    global $db;
    $query = "SELECT year_id FROM years WHERE year_number = :year";
    
            $statement = $db->prepare($query);
            $statement->bindValue(":year", $year);
            $statement->execute();
            $results = $statement->fetch();
            $statement->closeCursor();
            
    return $results;         
}