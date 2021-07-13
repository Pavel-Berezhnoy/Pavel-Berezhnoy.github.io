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
}

function getDataChart() {
    let response;
    Request = CreateRequest();
    let url = window.location.href.split("/");
    let cutUrl = url[0] + "//" + url[2] + "/" + url[3] + "/" + url[4];
    Request.open("POST", cutUrl + "/getChart");
    Request.send();
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {
                response = JSON.parse(Request.responseText);
                responseParser(response);
            }
        }
    }
}
document.addEventListener("DOMContentLoaded", () => {
    getDataChart();
});

function responseParser(response) {
    let date = new Array();
    let count = new Array();
    for (let i = 0; i < response.length; i++) {
        date.push(response[i].date);
        count.push(response[i].count);
    }
    createChart(date,count);
}

function createChart(date,count){
    const config = {
        type: 'line',
        data: {
            labels: date,
            datasets: [{
                label: 'Количество заявок',
                data: count,
                backgroundColor: 'rgba(0,124,186,1)',
                borderColor: 'rgba(0,124,186,1)',
                pointBackgroundColor: 'rgba(255,255,255,1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            //responsive:false
        },
    };
    let canvas = document.getElementById('chart');
    let ctx = canvas.getContext("2d");
    ctx.fillStyle = "green";
    var myChart = new Chart(
        ctx,
        config
    );
}