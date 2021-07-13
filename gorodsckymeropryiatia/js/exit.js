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

function exit() {
  Request = CreateRequest();
      Request.open("POST",'../php/exit.php');
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    Request.send();
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {
              {
              window.location.href = 'http://' + document.location.host;
              }
            }
        }
  }
}
