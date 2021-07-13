<?php
require_once "connection.php";
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

$query = "SELECT id_user FROM autorisation_key WHERE key_string = '$segments[2]'";
$result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
if(mysqli_num_rows($result)==1){
    $row = mysqli_fetch_row($result);
    //активация аккунта
    $query = "UPDATE users SET active=1 WHERE id_user = $row[0]";
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
    //удаление ключа
    $query = "DELETE FROM autorisation_key WHERE key_string = '$segments[2]'";
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
    require_once "assets/activeAcount.php";
}
else{
    require_once "assets/index.php";
}

?>