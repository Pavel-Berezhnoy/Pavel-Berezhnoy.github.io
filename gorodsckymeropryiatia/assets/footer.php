<footer class="footer">
  <div class="footer-content wrapper-inner">
    <div class="footer-contact">
      <h2><b>Контактная информация</b></h2>
      <p>Чтобы посетить наш головной офис воспользуйтесь адресом</p>

      <p><b>Адрес:</b> Ростов-на-Дону, улица Пушкина, 17</p>

      <p>8 (999) 675-22-12</p>

      <p>
      www.gorevetns.com
      </p>
    </div>
    <div class="footer-help">
        <h2><b>Поддержка</b></h2>
        <p>24/7 поддержка</p>
        <p>Отзывы</p>
        <p>Сертификаты</p>
        <p>о нас</p>
        <p>Организаторы</p>
    </div>
    <div class="footer-info">
        <h2><b>Информация</b></h2>
        <p><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>">Главная</a></p>
        <p>Категории</p>
        <p>Новости</p>
    </div>
  </div>
</footer>
<?php
if (CheckLogin()== false) {
  echo (htmlspecialchars_decode('<script type="text/javascript" src="js/login.js"></script>'));
}
  else {
    echo (htmlspecialchars_decode('<script type="text/javascript" src="js/exit.js"></script>'));
  }
?>
