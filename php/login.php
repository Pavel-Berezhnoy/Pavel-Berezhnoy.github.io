<?php
require_once 'connection.php';
if (!isset($_COOKIE[attempts])) {
    setcookie("attempts", 0, time() + 60 * 5, "/");
} else {
    setcookie("attempts", $_COOKIE[attempts] + 1, time() + 60 * 5, "/");
}
if ($_COOKIE[attempts] <= 5) {
    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

    $Email = $data[Email];
    $user_password = md5($data[password]);
    $query = 'SELECT id_user,active FROM users WHERE BINARY email="' . $Email . '" AND pass="' . $user_password . '";';
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    //валидность данных
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_row($result);
        if ($row[1] != 0) {

            //Установка куки
            setcookie("Email", $Email, time() + 60 * 60 * 24 * 7, "/");
            setcookie("password", $user_password, time() + 60 * 60 * 24 * 7, "/");
            setcookie("id_user", $row[0], time() + 60 * 60 * 24 * 7, "/");
            $hash = md5($Email . $user_password . $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

            //проверка существования сессии
            $query = "DELETE FROM sessions WHERE email = '$Email' and token = '$hash'";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            if (mysqli_num_rows($result) == 0) {
                //создание сессии в базе
                $query = "INSERT INTO sessions (email,token) VALUES ('$Email','$hash')";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            }
            $response = array("status" => "successful", "description" => "Вы успешно авторизовались!");
        } else {
            $response = array("status" => "fail", "description" => "Аккаунт не активирован!");
        }
    } else {
        $response = array("status" => "fail", "description" => "Логин или пароль не верны!");
    }
} else {
    $response = array("status" => "fail", "description" => "Вы сделали слишком много попыток. Попробуйте позже.");
}
$response += ["action"=>"login"];
echo json_encode($response);
mysqli_close($link);
