<?php
require_once 'connection.php';

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

$id_post = $data[id_post];
$do = $data[do_like];
if ($do == "like") {
  $query ='SELECT id_user FROM users WHERE email ="'.$_COOKIE[Email].'"';
  $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
  $row = mysqli_fetch_row($result);
  $id_user =$row[0];
  $query ='INSERT INTO likes (id_user,id_post) VALUES ("'.$id_user.'","'.$id_post.'")';
  $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
  echo "liked";
}
else{
  $query ='SELECT id_user FROM users WHERE email ="'.$_COOKIE[Email].'"';
  $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
  $row = mysqli_fetch_row($result);
  $id_user =$row[0];
  $query ='DELETE FROM likes WHERE id_user="'.$id_user.'" AND id_post="'.$id_post.'"';
  $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
  echo "unliked";
}
 ?>
