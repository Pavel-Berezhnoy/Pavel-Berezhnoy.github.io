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

      ?>
  		<?php require_once 'assets/header.php'; ?>
      <div class="create-category_content">
        <form class="create-category_form" action="">
          <div class="create-category_form-content">
            <div class="create-category_top-content">
              <div class="create_category_add-title"><input type="text" placeholder="Название" id="title_new_category"></div>
              <div class="create_category_add-button"><input type="submit" value="Добавить" onclick="AddCategory()"></div>
            </div>
            <div class="create-category_bottom-content">
              <?php require_once 'php/get-category.php';
              $rows = mysqli_num_rows($result);
                  for ($i=0; $i < $rows; $i++) {
                      $row = mysqli_fetch_row($result);
              echo (htmlspecialchars_decode('<div class="create-category_category-1">
                <div class="create-category_title"><span>'.$row[1].'</span></div>
                <div class="create_category_delete"><input type="button" value="Удалить" id="'.$row[1].'" onclick="RemoveCategory(id)"></div>
              </div>'));
              }
              mysqli_close($link);?>
            </div>
          </div>
        </form>
      </div>
      <?php require_once 'assets/footer.php'; ?>
  	</div>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/category.js"></script>
  </body>
</html>
