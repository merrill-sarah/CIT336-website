<?php 
$archivenav = createArchiveNav();

$postID = filter_input(INPUT_GET, 'postID', FILTER_SANITIZE_NUMBER_INT);
$monthID = filter_input(INPUT_GET, 'monthID', FILTER_SANITIZE_NUMBER_INT);
$yearID = filter_input(INPUT_GET, 'yearID', FILTER_SANITIZE_NUMBER_INT);

if (isset($postID)){
    $postitems = getBlogPostsID($postID);
} elseif (isset($monthID)){
    $postitems = getBlogPostsMonth($monthID, $yearID);
} elseif (isset($yearID)) {
    $postitems = getBlogPostsYear($yearID);
} else {
    $postitems = getBlogPostsAll();
}
$content = createBlogContent($postitems);
?>

<div id="blogIndex" class="content">
    <div id="archivenav">
        <h2>Archives</h2>
        <ul><?php echo $archivenav; ?></ul>
    </div>
    <div id="postcontent">
        <?php echo $content; ?>
    </div>
</div>
