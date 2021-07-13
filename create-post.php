<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Городские мероприятия</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/fonts.css">
  </head>
  <style media="screen">
.input__file {

opacity: 0;
visibility: hidden;
position: absolute;
}
.input__file-button {
  font-family: "Roboto";
}
  </style>
  <body>
  	<div class="wrapper">
      <?php
      require_once 'php/check-login.php';
      if (CheckLogin()== false) {
        require_once 'assets/login.php';
      }
      ?>
  		<?php require_once 'assets/header.php'; ?>

      <div class="add-post_content">
        <form action="php/add-post.php" class="add-post_form wrapper-inner" method="post" enctype="multipart/form-data">
          <div class="add-post_form-content">
            <div class="add-post_top-content">
              <div class="add-post_top">
                <input class="add-post_title" type="text" name="post-title" placeholder ="Заголовок">
                <select class="add-post_category" name="select_category" id="">
                  <?php
                  require_once 'php/connection.php';
                  $link = mysqli_connect($host, $user, $password, $database)
                      or die("Ошибка " . mysqli_error($link));
                      $query ='SELECT * FROM category';
                      $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
                      $rows = mysqli_num_rows($result);
                          for ($i=0; $i < $rows; $i++) {
                              $row = mysqli_fetch_row($result);
                      echo (htmlspecialchars_decode('<option value="'.$row[0].'">'.$row[1].'</option>'));
                      }
                  mysqli_close($link);
                  ?>
                </select>
              </div>
              <div class="add-post_bottom">
                <div class="add-post_add-preview btn">
                  <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                  <input type="file" name="image" id="add-post_item-1" class="input add-post_item-1" >
                  <label for="add-post_item-1" class="add-post_item-1-button">
                    <div class="">
                      Загрузите превью
                    </div>
                  </label>
                </div>
                  <div class="btn add-post_publish"><input type="submit" class="" value="Опубликовать"></div>
              </div>
            </div>
            <div class="add-post_bottom-content">
                <textarea class="add-post_description" name="description-post" id="" style="resize: none;" placeholder="Описание"></textarea>
            </div>
          </div>
        </form>
      </div>
      <?php require_once 'assets/footer.php'; ?>
  	</div>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
  </body>
</html>
