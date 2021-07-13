<?php
require_once 'connection.php';

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

$name_category = $data[name];
$query ='SELECT name FROM category WHERE name="'.$name_category.'"';
$result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
if (mysqli_num_rows($result)==0) {
  $query ='INSERT INTO category (name) VALUES ("'.$name_category.'")';
  $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
  echo "Категория добавлена";
}
else{
  echo "Категория с таким именем существует";
}
mysqli_close($link);
?>
