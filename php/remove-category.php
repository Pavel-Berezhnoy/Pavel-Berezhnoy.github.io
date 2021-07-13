<?php
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);
    $nameCategory = $data[name];

    $query ='DELETE FROM category WHERE name = "'.$nameCategory.'"';
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
    echo "Успешно удалено";
    mysqli_close($link);
?>
