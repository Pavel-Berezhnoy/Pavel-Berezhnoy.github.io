<?php

$id_cat = $_GET['id_cat'];

if (isset($segments[2])){
    $id_cat = $segments[2];
}


require_once 'php/connection.php';
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
$query = 'SELECT name FROM category WHERE id_cat="'.$id_cat.'"';
$result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
$row = mysqli_fetch_row($result);
?>
<div class="content_main-title">
    <h2>
      <?php echo $row[0]; ?>
    </h2>
  </div>
<div class="content_rows">
<?php




    $query = 'SELECT id_post, posts.name, description ,img, category.name as category FROM posts LEFT JOIN category ON posts.id_cat = category.id_cat  WHERE posts.id_cat="'.$id_cat.'" ORDER BY posts.id_post DESC';
    $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
    $rows = mysqli_num_rows($result);
    for ($i=0; $i < $rows; $i++) {
        $row = mysqli_fetch_row($result);
        echo (htmlspecialchars_decode('<div class="block-1">
          <a href="http://'.$_SERVER['HTTP_HOST'].'/новости/'.$row[0].'">
            <div class="block-1_content">
              <div class="block-1_picture">
                <img src="http://'.$_SERVER['HTTP_HOST'].'/upload/'.$row[3].'" alt="">
              </div>
              <div class="block-1_info big-info">
                <div class="block-1_category_hidden">
                  <div class="block-plate-1_line"></div>
                  <div class="block-plate-1_category-title">
                    <p>'.$row[4].'</p>
                  </div>
                  <div class="block-plate-1_line"></div>
                </div>
                <div class="block-1_title">
                  <h2><b>'.$row[1].'</b></h2>
                </div>
                <div class="block-1_description">'.substr(strip_tags($row[2]), 0, 500).'…</p>
               </div>
             </div>
           </div>
         </a>
       </div>
       ')
     );
      }
?>

</div>
