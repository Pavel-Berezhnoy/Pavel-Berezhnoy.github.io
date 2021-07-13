<?php
require_once 'connection.php';
require_once "check-login.php";
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);
if (!CheckLogin()){
    return;
}
$query = "UPDATE users SET name='$data[Name]',surname='$data[Surname]',birthday='$data[Birthday]',about='$data[About]', number='$data[PhoneNumber]'WHERE email='$_COOKIE[Email]' ";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) );