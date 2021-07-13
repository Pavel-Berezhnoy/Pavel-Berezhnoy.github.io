<?php
require_once "connection.php";
require_once "check-login.php";
$data = file_get_contents("php://input");
$data = json_decode($data, true);
$id_user = $_COOKIE["id_user"];
$id_img = $data["id_img"];
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

if (!CheckLogin()) {
    return;
}
delete_img($id_img, $id_user);
function delete_img($id_img, $id_user)
{
    $query = "DELETE FROM users_files WHERE id_file = '$id_img' AND id_user = $id_user AND meta_key = 'portfolio'";
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($GLOBALS['link']));
    echo $query;
}