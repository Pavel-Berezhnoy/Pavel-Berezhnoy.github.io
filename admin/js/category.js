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

function AddCategory() {
    let response;
    let NameCategory = document.getElementsByClassName('category__add-field')[0].value;
    let url = window.location.href.split("/");
    let cutUrl = url[0] + "//" + url[2] + "/" + url[3] + "/" + url[4];
    Request = CreateRequest();
    JSONobj = {
        name: NameCategory,
    }
    Request.open("POST", cutUrl + "/add");
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    Request.send(JSON.stringify(JSONobj));
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {
                response = JSON.parse(Request.responseText);
                responseHandler(response);
            }
        }
    }
}

function responseHandler(response) {
  if (response.result === "success") {
    location.reload();
  } else {
    let err = document.getElementsByClassName('category__errors')[0];
    err.textContent = response.description;
  }
}