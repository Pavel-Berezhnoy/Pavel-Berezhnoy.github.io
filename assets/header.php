<?php
    require_once 'php/check-login.php';
    if (CheckLogin()== false) {
        require_once 'assets/login.php';
    }
    ?>
<header class="header">
    <?php
    if (CheckAdmin()==true) {
        require_once 'admin.php';
    }
    ?>
    <div class="header-top_content">
        <div class="header-top wrapper-inner">
            <a class="header-logo_desktop" href="<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/">
                <img class="header-logo-img1" src="<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/images/logo.png" alt="">
            </a>
            <a class="header-logo_mobile" href="<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/">
                <img class="header-logo-img2" src="<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/images/logo2.svg" alt="">
            </a>
            <div class="header-nav_mobile">
                <span></span>
            </div>
            <nav class="header-nav">
                <ul class="header-nav_list">
                    <li class="header-nav_link header-nav_item-1"><a class="" href="<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>">Главная</a></li>
                    <li class="header-nav_link header-nav_item-2"><a class="" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].'/категории';?>" style="cursor: pointer;">Категории</a></li>
                    <li class="header-nav_link header-nav_item-3"><a class="" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].'/новости';?>">Новости</a></li>
                </ul>
            </nav>


            <div class="header-authorisation">
                <ul class='header-authorisation_list header-authorisation_menu'>
                    <li class="header-authorisation_name"><?php echo $_COOKIE[Email];?></li>
                    <?php if(CheckLogin()): ?>
                        <li class="header-authorisation_sublist">
                            <ul>
                                <li><a style="color: #fff;" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].'/профиль'; ?>">Профиль</a></li>
                                <li onclick="exit()">Выход</li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li><img src="<?php echo 'https://'.$_SERVER['HTTP_HOST']; ?>/images/user.svg" alt="" width="40px" height="40px" onclick="<?php if (CheckLogin()==false){echo "Form_login_Show()";} ?>"></li>
                </ul>
            </div>
        </div>
    </div>

</header>
