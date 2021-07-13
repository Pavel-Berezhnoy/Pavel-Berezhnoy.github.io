<?php
require_once 'connection.php';
if (!isset($_COOKIE[attempts])) {
  setcookie("attempts",0,time() + 60*5,"/");
}
else{
  setcookie("attempts",$_COOKIE[attempts]+1,time() + 60*5,"/");
}
if ($_COOKIE[attempts]<=5)
{
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    $name = $data[name];
    $user_password = md5($data[password]);
    $query ='SELECT role FROM users WHERE name="'.$name.'" AND pass="'.$user_password.'";';
      $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) );
      if (mysqli_num_rows($result)==1) {
        setcookie("name",$name,time()+60*60*24*7,"/");
        setcookie("password",$user_password,time()+60*60*24*7,"/");
        $role = mysqli_fetch_row($result)[0];
        setcookie("role",$role,time()+60*60*24*7,"/");
        echo "Вы успешно авторизовались!";


      }
      else {
        echo "Логин или пароль не верны";
      }
}
else {
  echo "Вы сделали слишком много попыток. Попробуйте позже.";
}
mysqli_close($link);
?>
