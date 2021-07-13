<div class="header-bottom">
    <div class="header-title">
        <h2>
            Городские мероприятия
        </h2>
    </div>
</div>
<div class="header-background">
    <picture>
        <source media="(max-width:1920px)" srcset="<?php echo "https://$_SERVER[HTTP_HOST]/images/imgonline-com-ua-Resize-uZxFZ0H2Bb9GnILY1920x1080.webp";?>">
        <source srcset="<?php echo "https://$_SERVER[HTTP_HOST]/images/imgonline-com-ua-Resize-uZxFZ0H2Bb9GnILY.webp";?>">
        <source media="(min-width:2561px)" srcset="<?php echo "https://$_SERVER[HTTP_HOST]/images/2018-10-28-17-03-33(4k).webp";?>">
        <img src="<?php echo "https://$_SERVER[HTTP_HOST]/images/imgonline-com-ua-Resize-uZxFZ0H2Bb9GnILY.jpg";?>" alt="" class="header-background_item">
    </picture>
</div>
<div class="content wrapper-inner">
    <div class="content_main-title">
        <h2>
            Популярные новости
        </h2>
    </div>
    <div class="content_rows">
        
        <?php
        require_once 'php/connection.php';
        $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
        $query = 'SELECT posts.id_post,name,description,img from posts LIMIT 5';
        $result = mysqli_query($GLOBALS['link'], $query) or die("Ошибка " . mysqli_error($link));
        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_row($result);
            $fr = fopen("$_SERVER[DOCUMENT_ROOT]/posts/$row[0].html","r");
            $description = strip_tags(fread($fr,10000));
            fclose($fr);
            echo(htmlspecialchars_decode('<div class="block-main">
      <a href="http://' . $_SERVER['HTTP_HOST'] . '/новости/' . $row[0] . '">
        <div class="block-main_content">
          <div class="block-main_picture">
            <img src="http://' . $_SERVER['HTTP_HOST'] . '/upload/' . $row[3] . '" alt="">
          </div>
          <div class="block-main_info big-info">
            <div class="block-main_title">
              <h2><b>' . $row[1] . '</b></h2>
            </div>
            <div class="block-main_description">
              <p>' . substr($description, 0, 600) . '…</p>
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
</div>
