<?php require_once "php/check-login.php";
ini_set("display_errors",1);
if (isset($_COOKIE[Email])) {
    if (CheckLogin()) {
    } else {
        foreach($_COOKIE as $key => $value) setcookie($key, '', time() - 60*60*24*7, '/');
        header("Location: ".'https://' . $_SERVER['HTTP_HOST']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Городские мероприятия</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/fonts.css">
</head>
<body>
<div class="wrapper">
    <?php require_once 'assets/header.php'; ?>
    <?php


    //routing
    $uri = mb_strtolower(urldecode($_SERVER['REQUEST_URI']));
    $segments = explode("/", $uri);

    if ($segments[1] === "" || $segments[1] === "главная" || $segments[1] === "index.php") {
        require_once 'assets/index.php';
    } elseif ($segments[1] === "категории") {
        if (!isset($segments[2])) {
            require_once "pages/category.php";
        } else {
            require_once "pages/category-detail.php";
        }

    } elseif ($segments[1] === "новости") {
        if (!isset($segments[2])) {
            require_once "pages/news.php";
        } else {
            require_once "assets/post.php";
        }

    }
    elseif ($segments[1] === "регистрация") {
        if (!isset($segments[2])) {
        } else {
            require_once "php/confirm-registration.php";
        }

    }
    elseif ($segments[1] === "профиль") {
        if (!isset($segments[2])) {
            if (CheckLogin())
                require_once "assets/profile.php";
            else{
                require_once "assets/index.php";
                echo "<script>window.onload = ()=> Form_login_Show();</script>";
            }

        }
        else{
            require_once "assets/profile.php";
        }
    } else {
        echo $uri;
    }
    ?>
    <?php require_once 'assets/footer.php'; ?>
</div>
<script type="text/javascript" src="<?php echo 'https://' . $_SERVER['HTTP_HOST']; ?>/js/main.js"></script>
</body>
</html>