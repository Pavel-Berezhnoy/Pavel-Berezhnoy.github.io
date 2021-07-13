<?php
require_once 'connection.php';
if(isset($_FILES) && $_FILES['image']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
  $ext = substr(strrchr($_FILES['image']['name'], '.'), 1);
$new_name = uniqid('file_').'.'.$ext;
$destiation_dir ='../'.'upload/'.$new_name; // Директория для размещения файла
move_uploaded_file($_FILES['image']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $query ='INSERT INTO posts (name,description,id_cat,img) VALUES ("'.$_POST['post-title'].'","'.$_POST['description-post'].'","'.$_POST['select_category'].'","'.$new_name.'")';
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) );
header('Location: http://'.$_SERVER['HTTP_HOST'].'/post.php?id_post='.mysqli_insert_id($link)); // Оповещаем пользователя об успешной загрузке файла
}
else{
echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
}

?>
