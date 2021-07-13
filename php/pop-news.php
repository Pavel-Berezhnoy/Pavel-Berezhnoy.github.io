<?php
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $query ='SELECT *  FROM posts ORDER BY post_views DESC LIMIT 7';
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) );
?>
