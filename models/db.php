<?php

/*use for localhost database connection, different for onwebsite connection*/
$dsn = 'mysql:host=localhost;dbname=hellodatabase';
$username = 'hello_user';
$password = 'hellouser123';
$db = new PDO($dsn, $username, $password);

