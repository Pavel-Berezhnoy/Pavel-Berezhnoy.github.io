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
      <?php
      require_once 'php/check-login.php';
      if (CheckLogin()== false) {
        require_once 'assets/login.php';
      }
      ?>
  		<?php require_once 'assets/header.php'; ?>
      <div class="header-bottom">
        <div class="header-title">
          <h2>
            Городские мероприятия
          </h2>
        </div>
      </div>
      <div class="header-background">
      <picture>
        <source srcset="images/imgonline-com-ua-Resize-uZxFZ0H2Bb9GnILY.webp">
        <source srcset="images/imgonline-com-ua-Resize-uZxFZ0H2Bb9GnILY.jpg">
        <source media="(min-width:2561px)" srcset="images/2018-10-28-17-03-33(4k).webp">
        <img src="images/imgonline-com-ua-Resize-uZxFZ0H2Bb9GnILY.jpg" alt="" class="header-background_item">
      </picture>
      </div>
      <div class="content wrapper-inner">
        <div class="content_main-title">
            <h2>
              Популярные новости
            </h2>
          </div>
        <div class="content_rows">

          <?php require_once 'assets/general.php' ?>
        </div>
      </div>
      <?php require_once 'assets/footer.php'; ?>
  	</div>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
