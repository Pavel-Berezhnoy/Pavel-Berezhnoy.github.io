// create object XMLHttpRequest
function CreateRequest() {
    var Request = false;

    if (window.XMLHttpRequest) {
        //Gecko-совместимые браузеры, Safari, Konqueror
        Request = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        //Internet explorer
        try {
            Request = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (CatchException) {
            Request = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }

    if (!Request) {
        alert("Невозможно создать XMLHttpRequest");
    }

    return Request;
};

function Form_login_Show() {
    FormLoginBackground = document.getElementsByClassName('background-login')[0];
    FormLoginBackground.classList.remove("hide_login_background");
    FormLoginBackground.classList.add("show_login_background");
    FormLogin = document.getElementsByClassName('login')[0];
    FormLogin.classList.remove("hide_login_block");
    FormLogin.classList.add("show_login_block");
    Check = false;
    FormLogin.addEventListener('click', Ckeck_click_login);
    FormLoginBackground.addEventListener('click', Form_login_Hide);
    button = document.getElementsByClassName('login_item-4')[0];
    sign = document.getElementsByClassName('login_authorization')[0];
    registration = document.getElementsByClassName('login_registration')[0];
    document.body.style.overflow = 'hidden';
    window.addEventListener("keydown", EventHandlerEnter);
};
function EventHandlerEnter(event){
    console.log("complete");
    if (event.keyCode !== 13){
        return;
    }
    login_validate();
}
function Ckeck_click_login() {
    Check = true;
};

function Form_login_Hide() {
    if (Check == false) {
        FormLoginBackground.classList.remove("show_login_background");
        FormLoginBackground.classList.add("hide_login_background");
        FormLogin.classList.remove("show_login_block");
        FormLogin.classList.add("hide_login_block");
        document.body.style.overflow = 'inherit';
    };
    Check = false;
    window.removeEventListener("keydown",EventHandlerEnter);
};

function login_validate() {
    let Email = document.getElementById('author-name').value;
    let Password = document.getElementById('author-pass').value;
    let notification = document.getElementById("author-error");
    Request = CreateRequest();
    JSONobj = {
        Email: Email,
        password: Password
    };
    if (button.value == 'Войти') {
        Request.open("POST", '../php/login.php');
    } else {
        Request.open("POST", '../php/registration.php');
    };
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    Request.send(JSON.stringify(JSONobj));
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {
                let response = JSON.parse(Request.responseText);
                notification.textContent = response.description;
                notification.style.color = "red";
                if (response.action == "registration" && response.status == "successful") {
                    notification.style.color = "green";
                }
                if (response.action == "login" && response.status == "successful") {
                    notification.style.color = "green";
                    setTimeout(() => {
                        location.reload();
                    }, 200);
                }
            }
        }
    }
};

function Mod_Login() {
    button.value = 'Войти';
    sign.classList.add("login_active");
    registration.classList.remove("login_active");

};

function Mod_Registration() {
    sign.classList.remove("login_active");
    registration.classList.add("login_active");
    button.value = 'Зарегистрироваться';
};
