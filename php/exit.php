<?php
require "connection.php";


//закрытие сессии
$hash = md5($_COOKIE[Email].$_COOKIE[password].$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));
$query ="DELETE FROM sessions WHERE email = '$_COOKIE[Email]' and token = '$hash'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) );

mysqli_close($link);

foreach($_COOKIE as $key => $value) setcookie($key, '', time() - 60*60*24*7, '/');
 ?>
