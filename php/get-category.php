<?php
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $query ='SELECT * FROM category ORDER BY id_cat DESC';
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));


?>
