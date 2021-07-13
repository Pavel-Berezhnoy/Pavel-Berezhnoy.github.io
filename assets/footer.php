<footer class="footer">
    <div class="footer-content wrapper-inner">
        <div class="footer-contact">
            <h2><b>Контактная информация</b></h2>
            <p>Чтобы посетить наш головной офис воспользуйтесь адресом</p>

            <p><b>Адрес:</b> Ростов-на-Дону, Просп. Соколова, д.18</p>

            <p>8 (999) 675-22-12</p>

            <p>
                www.gorodskie-meropriyatiya.site
            </p>
        </div>
        <div class="footer-info">
            <h2><b>Информация</b></h2>
            <p><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>">Главная</a></p>
            <p><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/категории'; ?>">Категории</a></p>
            <p><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/новости'; ?>">Новости</a></p>
        </div>
    </div>
</footer>
<?php
if (CheckLogin()== false) {
    echo (htmlspecialchars_decode('<script type="text/javascript" src="https://'.$_SERVER['HTTP_HOST'].'/js/login.js"></script>'));
}
else {
    echo (htmlspecialchars_decode('<script type="text/javascript" src="https://'.$_SERVER['HTTP_HOST'].'/js/exit.js"></script>'));
}
?>
