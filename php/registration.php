<?php
require_once 'connection.php';
require_once "CreateUserDirectory.php";
require_once 'Email.php';
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

$email = $data[Email];
$user_password = $data[password];
if (strlen($user_password) >= 6) {
    if (CheckName()) {
        AddUser();
        $response = array("status" => "successful", "description" => "Вы успешно зарегистрировались, вам отправлено письмо на почту для подтверждения регистрации.");
    } else {
        $response = array("status" => "fail", "description" => "Пользователь с таким именем существует");
    }
} else {
    $response = array("status" => "fail", "description" => "Пароль слишком короткий");
}
$response += ["action"=>"registration"];
echo json_encode($response);

  function CheckName()
  {

      $query = 'SELECT email FROM users WHERE email="' . $GLOBALS['email'] . '";';
      $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($GLOBALS['link']));

      if (mysqli_num_rows($result) == 0) {
          return true;
      }
  }

  function AddUser()
  {
      $key = CreateKey();
      require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/mail.php";
      SendMail($mail, $GLOBALS[email]);
      $user_password = md5($GLOBALS['user_password']);
      $query = 'INSERT INTO users (email,pass,active) VALUES ("' . $GLOBALS['email'] . '","' . $user_password . '",0);';
      $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($GLOBALS['link']));
      $id_user = mysqli_insert_id($GLOBALS['link']);
      $query = "INSERT INTO autorisation_key (id_user, key_string) VALUES ($id_user,'$key')";
      $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($GLOBALS['link']));

      CreateUserDirectory($GLOBALS[email]);
  }
  function CreateKey()
  {
      return bin2hex(random_bytes(20));
  }
mysqli_close($link);

 ?>
