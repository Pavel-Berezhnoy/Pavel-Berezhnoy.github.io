<?php

require_once "connection.php";
require_once "check-login.php";

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

//получение id поста
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

if (CheckLogin()) {
    if (checkRegisterEvent($data[url],$_COOKIE['id_user'])) {
        echo "Вы уже зарегистрированы";
    }
    else{
        registerEvent($data[url],$_COOKIE['id_user']);
        echo "Ваша заявка отправлена!";
    }
}else{
    echo "Вы не авторизованы";
}

function checkRegisterEvent($id_post, $id_user)
{
    $query = "SELECT status FROM records WHERE id_post = $id_post AND id_user = $id_user";
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($GLOBALS['link']));
    if (mysqli_num_rows($result) == 1) {
        return true;
    }
}

function registerEvent($id_post, $id_user){
    date_default_timezone_set("Europe/Moscow");
    $today = date("Y-m-d");
    $query = "INSERT INTO records (id_post,id_user,date) VALUES ($id_post,$id_user,'$today')";
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($GLOBALS['link']));
}