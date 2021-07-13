<?php $mail = '<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<title>Title</title>
</head>
<body>
<div class="wrapper" style="font-family: Arial;
        font-weight: 400;max-width: 600px;
        max-width: 500px;
        background: linear-gradient(322.55deg, #9B16ED 25.17%, rgb(22, 237, 198) 134.58%);
        border: 1px solid rgba(117, 117, 117, 0.91);">
    <div class="wrapper__inner" style="background: white;
        margin: 47px;
        padding: 80px 0;">
        <p class="wrapper__item1 center" style=" margin: 0;text-align: center;font-size: 24px;
        padding-bottom: 69px;
        color: #585858;">Уведомление</p>
        <p class="wrapper__item2 center" style=" margin: 0;text-align: center;font-size: 18px;
        padding: 0 58px;
        margin-bottom: 122px;
        color: #585858;">Для завершения рагистрации на сайте “Городские мероприятия” подтвердите вашу электронную почту</p>
        <div class="wrapper__item3 center" style="text-align: center;">
            <a href="https://'.$_SERVER[HTTP_HOST].'/регистрация/'.$key.'" class="wrapper__button-link" style="margin: 0;
        text-decoration: none;display: inline-block;
        width: 200px;
        height: 48px;
        background: #9B16ED;
        border-radius: 6px;">
                <p style="padding-top: 13px;
        height: 100%;
        color: white; margin: 0;">
                    Подтвердить
                </p>
            </a>
        </div>
    </div>
</div>
</body>
</html>';