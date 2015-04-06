<?php
    $nav = getPrimaryNav();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Sarah Merrill">
        <title>Oh Hello Sarah</title>
        
        <link rel="stylesheet" type="text/css" href="/css/stylesheet.css" />
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js" ></script>
    </head>    

    <body>
        <header>
            <img src='../files/title-text.png' alt='Oh Hello Sarah text logo'>
            <h2>because I'm going to pretend you care about my life...</h2>
            <nav>
                <ul>
                    <?php foreach($nav as $action => $val) : ?>
                    <li>
                        <a href='index.php?action=<?php echo $action ?>' title='<?php echo $val; ?>'><?php echo $val ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </header>

