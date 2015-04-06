<?php 
$archivenav = createArchiveNav();

$postID = $_GET['postID'];
$monthID = $_GET['monthID'];
$yearID = $_GET['yearID'];

if (isset($postID)){
    $postitems = getBlogPostsID($postID);
} elseif (isset($monthID)){
    $postitems = getBlogPostsMonth($monthID, $yearID);
} elseif (isset($yearID)) {
    $postitems = getBlogPostsYear($yearID);
} else {
    $postitems = getBlogPostsAll();
}
$content = createBlogContent($page, $postitems);

?>

<div id="content">
    <div id="postcontent">
        <p>Blog page</p>
        <?php echo $content; ?>
    </div>
    <div id="archivenav">
        <ul><?php echo $archivenav; ?></ul>
    </div>
    <ul>
        <?php echo $contentnav; ?>
    </ul>
</div>
