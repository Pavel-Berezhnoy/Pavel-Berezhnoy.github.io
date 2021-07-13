<?php
$id_post = $_GET['id_post'];
require_once 'php/connection.php';

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
    $query = 'SELECT posts.img,posts.name,posts.description, category.name as category, posts.id_cat FROM posts LEFT JOIN category ON posts.id_cat = category.id_cat WHERE id_post="'.$id_post.'";';
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
    $row = mysqli_fetch_row($result);
    $id_cat  = 'http://'.$_SERVER['HTTP_HOST'].'/category-detail.php?id_cat='.$row[4];
    $src_img = 'http://'.$_SERVER['HTTP_HOST'].'/upload/'.$row[0];
    $title = $row[1];
    $description = $row[2];
    $category = $row[3];


?>

      <div class="post_content wrapper-inner">
        <div class="post_img">
            <img src="<?php echo($src_img)?>" alt="">
        </div>
        <div class="post_description">
          <a href="<?php echo($id_cat)?>">
          <div class="post_category">
              <h2><?php echo($category)?></h2>
          </div>
          </a>
          <div class="post_title">
              <h2><?php echo($title)?></h2>
          </div>
          <div class="post_text">
              <p><?php echo($description)?></p>
          </div>
          <div class="post_likes">
            <?php require_once 'php/likes.php';?>
          </div>
        </div>
      </div>
