<?php
    $nav = getPrimaryNav();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Sarah Merrill">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title>Oh Hello Sarah</title>
        
        <link rel="stylesheet" type="text/css" href="/css/stylesheet.css" media="screen" />
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js" ></script>
    </head>    

    <body>
        <div id="wrapper">
        <header>
            <img src='../files/layout/title-text.png' alt='Oh Hello Sarah text logo'>
            <h2>because I'm going to pretend you care about my life...</h2>
            <nav>
                <table>
                    <tr>
                    <?php foreach($nav as $action => $val) : ?>
                    <td>
                        <a href='index.php?action=<?php echo $action ?>' title='<?php echo $val; ?>'><?php echo $val ?></a>
                    </td>
                    <?php endforeach; ?>
                    </tr>
                </table>
            </nav>
        </header>

