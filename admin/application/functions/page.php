<?php

class Page
{

    //метод определения текущей страницы
    static function getCurrentPage()
    {
        if (!empty($_GET["page"])) {
            $offset = $_GET["page"] * 10 - 10;
            return $_GET["page"];
        } else {
            return 1;
        }
    }
    public static function getCountPages($query)
    {
        $link = mysqli_connect('localhost','m90817so_base','oy2&Q1Nm','m90817so_base');
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_row($result);
        $pages = ceil($row[0] / 10);
        if ($pages == 0) {
            $pages = 1;
        }
        return  $pages;
    }
    //определение смещения запроса
    public static function getOffsetQuery()
    {
        if (!empty($_GET["page"])) {
            return $_GET["page"] * 10 - 10;
        } else {
            return 0;
        }
    }
    public static  function getCurrentUrl(){
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $url .= (substr($url, -1)=='/'?'':'/');
        return explode("?",$url)[0];
    }
}