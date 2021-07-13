<div class="background-login">
    <div class="login">
      <div class="change-mode">
        <p class="login_authorization login_active" onclick="Mod_Login()">Войти</p>
        <div class="login_line"></div>
        <p class="login_registration" onclick="Mod_Registration()">Регистрация</p>
      </div>
      <div class="login_items">
        <div><input class="login_item-1" id="author-name" type="text" placeholder="E-mail"></div>
        <div><input class="login_item-2" id="author-pass" type="password" placeholder="Пароль"></div>
        <div><span class="login_item-3" id="author-error"></span></div>
        <div class="btn-login btn">
          <input class="login_item-4 button-login" type="button" name="" value="Войти" onclick="login_validate()">
        </div>
      </div>
    </div>
  </div>
