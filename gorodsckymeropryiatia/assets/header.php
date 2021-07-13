<header class="header">
  <?php
    if (CheckAdmin()==true) {
        require_once 'admin.php';
    }
    ?>
  <div class="header-top_conent">
    <div class="header-top wrapper-inner">
      <div class="header-logo">
        <img src="images/logo.png" alt="">
      </div>
      <div class="header-nav_mobile">
        <span></span>
      </div>
      <nav class="header-nav">
        <ul class="header-nav_list">
          <li class="header-nav_link header-nav_item-1"><a class="" href="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>">Главная</a></li>
          <li class="header-nav_link header-nav_item-2"><a class="" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/category.php';?>" style="cursor: pointer;">Категории</a></li>
          <li class="header-nav_link header-nav_item-3"><a class="h" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/news.php';?>">Новости</a></li>
        </ul>
      </nav>
      <div class="header-autorisation">
        <ul class='header-autorisation_list'>
            <li><?php echo $_COOKIE[name];?>
              <ul class="header-autorisation_sublist">
                <li><div onclick="exit()">Выход</div></li>
              </ul>
              </li>
              <li><img src="images/user.svg" alt="" width="40px" height="40px" onclick="<?php if (CheckLogin()==false){echo "Form_login_Show()";} ?>"></li>
          </ul>
      </div>
    </div>
    </div>

</header>
