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
      <div class="content wrapper-inner">
        <div class="content-picker">
          <div class="content-picker_items">
            <img src="images/list-ul.svg" alt="" onclick="ContentSizeBig()">
            <img src="images/grid-3x3.svg" alt="" onclick="ContentSizeSmall()">
          </div>
        </div>

          <?php require_once 'assets/category.php'; ?>

  	</div>
    <?php require_once 'assets/footer.php'; ?>
  </div>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
