const register_button = document.getElementById("registerForTheEvent");

register_button.addEventListener("click", registerForTheEvent);
const URL = window.location.href.split('/');
const jsonURL = {
    url: URL[URL.length-1]
}
function registerForTheEvent() {
    let Request = CreateRequest();
    Request.open("POST", "../php/registerForTheEvent.php");
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    Request.send(JSON.stringify(jsonURL));
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {
                let button_sign = document.getElementsByClassName("button-signup")[0];
                let response = document.getElementsByClassName("post__errors")[0].getElementsByTagName("span")[0];
                if (Request.responseText == "Ваша заявка отправлена!"){
                    response.style.color = 'green';
                    button_sign.classList.add("button-signup_successful");
                    button_sign.textContent = "Заявка отправлена";
                }
                if (Request.responseText == "Вы уже зарегистрированы") {
                    response.style.color = 'red';
                }
                if (Request.responseText == "Вы не авторизованы"){
                    response.style.color = 'red';
                    Form_login_Show();
                }
                response.textContent = Request.responseText;
            }
        }
    }
}

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
}