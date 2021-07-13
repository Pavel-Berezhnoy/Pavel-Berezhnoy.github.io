<?php
require_once "php/connection.php";
require_once "php/check-login.php";

$data = array("user" => array(), "images" => array(), "records" => array(),"files" => array());
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
//получение данных о пользователе
$id_user = $_COOKIE["id_user"];
if(isset($_GET["email"])){
    if (CheckAdmin()){
        $email = $_GET["email"];
        $query = "SELECT id_user FROM users WHERE email='$email'";
        $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
        $id_user = mysqli_fetch_row($result)[0];
    }
}
$query = "SELECT name,surname,about,birthday,number FROM users WHERE id_user=$id_user";
$result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
$row = mysqli_fetch_row($result);

$data['user']["name"] = checkNull($row[0]);
$data['user']['surname'] = checkNull($row[1]);
$data['user']['about'] = checkNull($row[2]);
$data['user']['birthday'] = checkNull($row[3]);
$data['user']['number'] = checkNull($row[4]);

//получение файлов пользователя
$query = "SELECT id_file,meta_key FROM users_files WHERE id_user=$id_user ORDER BY id_file DESC";
$result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
$num_row = mysqli_num_rows($result);
for ($i = 0; $i < $num_row; $i++) {
    $row = mysqli_fetch_row($result);
    //изображение или аватар
    if ($row[1] == "portfolio") {
        array_push($data["images"], $row[0]);
    } elseif ($row[1] == "avatar") {
        $data['user']['avatar'] = $row[0];
    }   elseif ($row[1] == "file"){
        $type = explode(".",$row[0])[1];
        array_push($data["files"], array("name"=>$row[0],"type"=>$type));
    }
}

//получение записей на мероприятия
$query = "SELECT records.id_post, records.status, posts.name, posts.date, posts.place FROM records LEFT JOIN posts ON records.id_post=posts.id_post WHERE records.id_user=$id_user ORDER BY status DESC";
$result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
$num_row = mysqli_num_rows($result);
for ($i = 0; $i < $num_row; $i++) {
    $row = mysqli_fetch_row($result);
    array_push($data["records"],array("id_post" => $row[0],"status" => $row[1],
        "name" => $row[2],"date"=> $row[3],"place" => $row[4]));
}


//проверка пустоты значений
function checkNull($value)
{
    if ($value == "" || $value == "0000-00-00") {
        return "Не указано";
    } else {
        return $value;
    }
}