<?php
require "connection.php";
function CheckAdmin(){
    if (CheckLogin()){
        $link = mysqli_connect($GLOBALS[host], $GLOBALS[user], $GLOBALS[password], $GLOBALS[database])
        or die("Ошибка " . mysqli_error($link));
        $query ="SELECT role FROM users WHERE BINARY email = '$_COOKIE[Email]'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) );
        $row = mysqli_fetch_row($result)[0];
        if ($row == "admin"){
            return true;
        }
        else{return false;}
    }

}
function CheckLogin(){
    if (isset($_COOKIE[Email]) && isset($_COOKIE[password])){
        $hash = md5($_COOKIE[Email].$_COOKIE[password].$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
        $link = mysqli_connect($GLOBALS[host], $GLOBALS[user], $GLOBALS[password], $GLOBALS[database])
        or die("Ошибка " . mysqli_error($link));
        $query ="SELECT email,token FROM sessions WHERE BINARY email = '$_COOKIE[Email]' and token = '$hash'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link) );
        if (mysqli_num_rows($result)==1){

            return true;
        }
        else{
            return false;
        }

    }
    else {
      return false;
    }
}
?>
