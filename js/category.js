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


function AddCategory(){
  NameCategory = document.getElementById('title_new_category').value;
  Request = CreateRequest();
    JSONobj = {
      name: NameCategory,
    }
      Request.open("POST",'../php/add-category.php');
      console.log(JSONobj);
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    Request.send(JSON.stringify(JSONobj));
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {

              if(Request.responseText=='Категория добавлена'){
              location.reload();
              }
              else {
                alert(Request.responseText);
              }
            }
        }
  }
}


function RemoveCategory(NameCategory){
  Request = CreateRequest();
    JSONobj = {
      name: NameCategory,
    }
      Request.open("POST",'../php/remove-category.php');
      console.log(JSONobj);
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    Request.send(JSON.stringify(JSONobj));
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {

              if(Request.responseText=='Успешно удалено'){
              location.reload();
              }
              else {
                alert(Request.responseText);
              }
            }
        }
  }
}
