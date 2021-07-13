<?php
ini_set("display_errors", 1);
require_once "connection.php";
require_once "check-login.php";
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));
if (isset($_FILES) && CheckLogin()) {
    $destination_query = [];
    foreach ($_FILES['images']['error'] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {
            $ext = substr(strrchr($_FILES['images']['name'][$key], '.'), 1);
            if ($ext == "jpg" || $ext == "png") {
                $new_name = uniqid("file_") . "." . $ext;
                $destination_dir = $_SERVER['DOCUMENT_ROOT'] . "/users_files/$_COOKIE[Email]/моё_портфолио/$new_name";
                move_uploaded_file($_FILES['images']['tmp_name'][$key], $destination_dir);
                array_push($destination_query, $new_name);
            }

        }
    }
    if (!empty($destination_query)) {
        for ($i = 0; $i < count($destination_query); $i++) {
            if ($i == 0) {
                $tmp_insert = "('$destination_query[$i]','$_COOKIE[id_user]','portfolio')";
            } else {
                $tmp_insert .= ", ('$destination_query[$i]','$_COOKIE[id_user]','portfolio')";
            }
        }
        $query = "INSERT INTO users_files (id_file,id_user,meta_key) VALUES" . $tmp_insert;
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        return;
    }
    foreach ($_FILES['files']['error'] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $ext = substr(strrchr($_FILES['files']['name'][$key], '.'), 1);
            $name = explode(".",$_FILES['files']['name'][$key])[0];
            if ($ext == "doc" || $ext == "docx" || $ext == "pdf" || $ext == "txt") {
                $new_name = uniqid($name."_") . "." . $ext;
                $destination_dir = $_SERVER['DOCUMENT_ROOT'] . "/users_files/$_COOKIE[Email]/мои_файлы/$new_name";
                move_uploaded_file($_FILES['files']['tmp_name'][$key], $destination_dir);
                array_push($destination_query, $new_name);
            }

        }
    }
    if (!empty($destination_query)) {
        echo "complete";
        for ($i = 0; $i < count($destination_query); $i++) {
            if ($i == 0) {
                $tmp_insert = "('$destination_query[$i]','$_COOKIE[id_user]','file')";
            } else {
                $tmp_insert .= ", ('$destination_query[$i]','$_COOKIE[id_user]','file')";
            }
        }
        $query = "INSERT INTO users_files (id_file,id_user,meta_key) VALUES" . $tmp_insert;
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        return;
    }
    //обновление аватара
    if (!empty($_FILES['avatar'])) {
        if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $ext = substr(strrchr($_FILES['avatar']['name'], '.'), 1);
            if ($ext == "jpg" || $ext == "png") {
                $query = "DELETE FROM users_files WHERE id_user='$_COOKIE[id_user]' and meta_key='avatar'";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

                //очистка директории
                if (file_exists("$_SERVER[DOCUMENT_ROOT] /users_files/$_COOKIE[Email]/моя_фотография/")) {
                    foreach (glob("$_SERVER[DOCUMENT_ROOT] /users_files/$_COOKIE[Email]/моя_фотография/*") as $file) {
                        unlink($file);
                    }
                }

                //создание файла
                $new_name = uniqid("file_") . "." . $ext;
                $destination_dir = $_SERVER['DOCUMENT_ROOT'] . "/users_files/$_COOKIE[Email]/моя_фотография/$new_name";
                move_uploaded_file($_FILES['avatar']['tmp_name'], $destination_dir);
                $query = "INSERT INTO users_files (id_file,id_user,meta_key) VALUES ('$new_name','$_COOKIE[id_user]','avatar')";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

            }
        }

    }
}
