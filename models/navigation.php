<?php 
/*Header Navigation*/
function getPrimaryNav(){
    $nav = array(
        'blog' => 'Blog',
        'about' => 'About',
        'contact' => 'Contact'
    );
    
    /*if (CheckSession())
    {
        $nav['account'] = 'Account';
        $nav['logout'] = 'Log Out';
    }
    else
    {
        $nav['login'] = 'Log In';
    }*/
    
    return $nav;
}
function getFooterNav(){
    $footnav = array (
        'sitePlan' => 'Site Plan',
        'teachPres' => 'Teaching Presentation',
        'styleGuide' => 'Style Guide'
    );
    return $footnav;
}

/*Archive navigation on blog page*/
function getArchiveYears(){
    global $db;
    $query = "SELECT DISTINCT p.year_id, year_number "
        . "FROM post p CROSS JOIN years y "
            . "WHERE p.year_id = y.year_id "
            . "ORDER BY y.year_id DESC";
    try { 
      $statement = $db->prepare($query);
      $statement->execute();
      $yearsarray = $statement->fetchAll();
      $statement->closeCursor();
            
    } catch (Exception $ex) {

    }
    if (!empty($yearsarray)) {
    return $yearsarray;
  } else {
    return FALSE;
  }
}

function getArchiveMonths($yearid){
    global $db;
    $query = "SELECT DISTINCT p.month_id, m.month_name "
            . "FROM post p CROSS JOIN months m "
            . "ON p.month_id = m.month_id "
            . "WHERE p.year_id = :year_id "
            . "ORDER BY p.month_id DESC";
    try { 
      $statement = $db->prepare($query);
      $statement->bindValue(':year_id', $yearid);
      $statement->execute();
      $monthsarray = $statement->fetchAll();
      $statement->closeCursor();
            
    } catch (Exception $ex) {

    }
    if (!empty($monthsarray)) {
    return $monthsarray;
  } else {
    return FALSE;
  }
}

function getArchivePosts($monthid){
    global $db;
    $query = "SELECT DISTINCT p.post_id, p.post_title "
            . "FROM post p "
            . "WHERE p.month_id = :month_id "
            . "ORDER BY p.post_id DESC";
    try { 
      $statement = $db->prepare($query);
      $statement->bindValue(':month_id', $monthid);
      $statement->execute();
      $monthsarray = $statement->fetchAll();
      $statement->closeCursor();
            
    } catch (Exception $ex) {

    }
    if (!empty($monthsarray)) {
    return $monthsarray;
  } else {
    return FALSE;
  }
    
}

function createArchiveNav(){
    $yearsarray = getArchiveYears();
    $key = array();
    foreach ($yearsarray as $val){
        $key[] = 'viewPost&amp;yearID='.$val[0];
    }
    $yearswithkey = array_combine($key, $yearsarray);
    
    $archivenav ="";
    
    foreach ($yearswithkey as $action => $yearval) {
        $archivenav .= "<li><a href='index.php?action=$action' title='Posts from $yearval[1]'>$yearval[1]</a>";
        $monthsnav = createArchiveNavMonths($yearval, $archivenav); 
        $archivenav .= $monthsnav;
    }
    return $archivenav;
}

function createArchiveNavMonths ($yearval){
    $monthsarray = getArchiveMonths($yearval[0]);
    $key = array();
    foreach ($monthsarray as $val){
        $key[] = 'viewPost&amp;yearID='.$yearval[0].'&amp;monthID='.$val[0];
    }
    $monthswithkey = array_combine($key, $monthsarray);
   
        $monthsnav = "<ul>";
        foreach ($monthswithkey as $action => $monthval){
            $monthsnav .= "<li><a href='index.php?action=$action' title='Posts from $monthval[1], $yearval[1]'>$monthval[1]</a>";
        
            $titlenav = createArchiveNavPost($monthval);
            $monthsnav .= $titlenav; 
        }
        
        $monthsnav .= "</ul></li>";
        
        return $monthsnav;
}

function createArchiveNavPost ($monthval){
    $postsarray = getArchivePosts($monthval[0]);
    if ($postsarray === FALSE){
        echo 'There are no posts at this time';
    }
    else {
        foreach ($postsarray as $val){
        $key[] = 'viewPost&amp;postID='.$val[0];
        }
        $postswithkey = array_combine($key, $postsarray);
        
        
        $postnav = "<ul>";
        foreach ($postswithkey as $action => $postval){
            $postnav .= "<li><a href='index.php?action=$action' title='$postval[1]'>$postval[1]</a>";
        }
        $postnav .="</li></ul></li>";
        return $postnav;
    }
}

/*not finished*/
function createContentNav ($page){
    $contentnav = "";
    if ($page != 0) {
        $contentnav .= "<li><a href";
        
    }
}