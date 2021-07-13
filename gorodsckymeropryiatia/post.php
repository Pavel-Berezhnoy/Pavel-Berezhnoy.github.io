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
  		<?php require_once 'assets/header.php';
      require_once 'assets/post.php';

      ?>

      <?php require_once 'assets/footer.php'; ?>
  	</div>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
  </body>
</html>
