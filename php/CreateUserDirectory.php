<?php
//Создание дирректорий пользователя

function CreateUserDirectory($userName)
{
    mkdir($_SERVER['DOCUMENT_ROOT'] . "/users_files/$userName");
    mkdir($_SERVER['DOCUMENT_ROOT'] . "/users_files/$userName/моя_фотография");
    mkdir($_SERVER['DOCUMENT_ROOT'] . "/users_files/$userName/моё_портфолио");
    mkdir($_SERVER['DOCUMENT_ROOT'] . "/users_files/$userName/мои_файлы");
}