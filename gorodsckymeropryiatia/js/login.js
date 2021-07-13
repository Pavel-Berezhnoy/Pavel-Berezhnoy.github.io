// create object XMLHttpRequest
function CreateRequest()
{
    var Request = false;

    if (window.XMLHttpRequest)
    {
        //Gecko-совместимые браузеры, Safari, Konqueror
        Request = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        //Internet explorer
        try
        {
             Request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (CatchException)
        {
             Request = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }

    if (!Request)
    {
        alert("Невозможно создать XMLHttpRequest");
    }

    return Request;
}
function Form_login_Show()

{
FormLoginBackground = document.getElementsByClassName('background-login')[0];
FormLoginBackground.classList.remove("hide_login_background");
FormLoginBackground.classList.add("show_login_background");
FormLogin = document.getElementsByClassName('login')[0];
FormLogin.classList.remove("hide_login_block");
FormLogin.classList.add("show_login_block");
  Check = false;
  FormLogin.addEventListener('click',Ckeck_click_login);
  FormLoginBackground.addEventListener('click',Form_login_Hide);
  button = document.getElementsByClassName('login_item-4')[0];
  sign = document.getElementsByClassName('login_authorization')[0];
  registration = document.getElementsByClassName('login_registration')[0];
}
function Ckeck_click_login()

{
  Check = true;

}
function Form_login_Hide()

{
  if (Check==false) {
    FormLoginBackground.classList.remove("show_login_background");
    FormLoginBackground.classList.add("hide_login_background");
    FormLogin.classList.remove("show_login_block");
    FormLogin.classList.add("hide_login_block");
  }
  Check = false;
}

function login_validate()

{
  Name = document.getElementById('author-name').value;
  Password = document.getElementById('author-pass').value;
    Request = CreateRequest();
      JSONobj = {
        name: Name,
        password: Password
      }
      if (button.value == 'Войти') {
        Request.open("POST",'../php/login.php');
      }
      else {
        Request.open("POST",'../php/registration.php');
        console.log(JSONobj);
      }

      Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      Request.send(JSON.stringify(JSONobj));
      Request.onload = function () {
          if (Request.readyState === Request.DONE) {
              if (Request.status === 200) {
                alert(Request.responseText);
                if(Request.responseText=='Вы успешно авторизовались!' || Request.responseText=='Вы успешно зарегестрированы! Авторизуйтесь'){
                location.reload();
                }
              }
          }
    }
}
function Mod_Login()
{
  button.value = 'Войти';
  sign.classList.add("login_active");
  registration.classList.remove("login_active");

}
function Mod_Registration()
{
  sign.classList.remove("login_active");
  registration.classList.add("login_active");
  button.value = 'Зарегестрироваться';
}
