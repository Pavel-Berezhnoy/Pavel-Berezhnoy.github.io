<?php
require_once 'connection.php';

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

$name = $data[name];
$user_password = $data[password];
if (strlen($user_password)>=6) {
  if (CheckName()) {
    AddUser();
    echo "Вы успешно зарегестрированы! Авторизуйтесь";
  }
  else {
    echo "Пользователь с этим именем уже существует";
  }
}
else {
  echo "Пароль слишком короткий";
}

  function CheckName()
  {

    $query ='SELECT name FROM users WHERE name="'.$GLOBALS['name'].'";';
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));

      if (mysqli_num_rows($result)==0) {
        return true;
      }
  }

  function AddUser()
  {
    $user_password = md5($GLOBALS['user_password']);
    $query ='INSERT INTO users (name,pass) VALUES ("'.$GLOBALS['name'].'","'.$user_password.'");';
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
  }

mysqli_close($link);

 ?>
