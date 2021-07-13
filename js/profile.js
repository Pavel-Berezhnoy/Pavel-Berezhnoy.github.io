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

let inputElements = document.getElementById("portfolio_img-add");
let inputElement_2 = document.getElementById("portfolio_document-add");
let avatar = document.getElementById("profile-avatar_img-add");
if (inputElements != null || avatar != null || inputElement_2 != null) {
    inputElements.addEventListener("input", uploadImages);
    avatar.addEventListener("input", uploadImages);
    inputElement_2.addEventListener("input", uploadImages);
}

function uploadImages() {
    let formData = new FormData(document.loadImage);
    Request = CreateRequest();
    Request.open("POST", "../php/load-files-portfolio.php");
    Request.send(formData);
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {
                profileReload();
            }
        }
    }
}

function deleteImage() {
    let srcImage = document.getElementsByClassName("opening-img_img-active")[0].src;
    let imageSource = srcImage.split("/");
    Request = CreateRequest();
    Request.open("POST", "../php/delete-file.php");
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    JSONobj = {
        id_img: imageSource[imageSource.length - 1]
    };
    Request.send(JSON.stringify(JSONobj));
    Request.onload = function () {
        if (Request.readyState === Request.DONE) {
            if (Request.status === 200) {
                profileReload();
            }
        }
    }
}

let documentDel = document.getElementsByClassName("porfolio_document-remove");
for(let i = 0; documentDel.length > i; i++){
    documentDel[i].addEventListener("click", () => {
        let srcFile = document.getElementsByClassName("portfolio_document")[i];
        let sourceFile = srcFile.dataset.filename;
        Request = CreateRequest();
        Request.open("POST", "../php/delete-file.php");
        Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        JSONobj = {
            id_file: sourceFile
        };
        Request.send(JSON.stringify(JSONobj));
        Request.onload = function () {
            if (Request.readyState === Request.DONE) {
                if (Request.status === 200) {
                    profileReload();
                }
            }
        }
    });
}

function profileReload() {
    location.reload();
}

let item_img = document.getElementsByClassName("portfolio-item")[0];
let profile_items = document.getElementsByClassName("profile_portfolio-items");
console.log(profile_items);
if (item_img != null ) {
    for (let i = 0; i < profile_items.length; i++) {
        profile_items[i].style.gridAutoRows = item_img.clientWidth + "px";
    }
    window.addEventListener("resize", updateSizeItem);
}

function updateSizeItem() {
    for (let i = 0; i < profile_items.length; i++) {
        profile_items[i].style.gridAutoRows = item_img.clientWidth + "px";
    }
}

//open profile about list
let about = document.getElementsByClassName("profile-about");
let aboutP = about[0].getElementsByTagName("p");
let about_arrow = document.getElementsByClassName("profile-about_arrow");
let aboutHeight = getComputedStyle(aboutP[0]).height.split("px");
if (aboutHeight[0] >= 36) {
    about[0].addEventListener('click', () => {
        aboutP[0].classList.add('profile-about_active');
        about_arrow[0].classList.add('profile-about_arrow_active');
    });
} else {
    aboutP[0].classList.add('profile-about_active');
}

about_arrow[0].addEventListener('click', () => {
    aboutP[0].classList.remove('profile-about_active');
    about_arrow[0].classList.remove('profile-about_arrow_active');
});

//portfolio

let profile_arrow = document.getElementsByClassName("profile_portfolio-arrow");
for (let i = 0; i < profile_items.length; i++) {
    profile_arrow[i].style.display = "none";
    let arrowBool = true;
    let items_collection = profile_items[i].getElementsByClassName("portfolio-item");
    if (items_collection.length >= 3) {
        for (let j = 3; j < items_collection.length; j++) {
            items_collection[j].style.display = "none";
            profile_arrow[i].style.display = "flex";
        }
    };
    profile_arrow[i].addEventListener("click", () => {
        if (arrowBool == true) {
            for(let j = 0; items_collection.length > j; j++){
                items_collection[j].style.display = "block";
                profile_arrow[i].style.transform = 'rotate(180deg)';
                arrowBool = false;
            }
            return;
        }
        if (arrowBool == false) {
            for(let j = 3; items_collection.length > j; j++){
                items_collection[j].style.display = "none";
                profile_arrow[i].style.transform = 'rotate(0deg)';
                arrowBool = true;
            }
            return;
        }
        
    });
}
//image open
let openBackground = document.getElementsByClassName('img-opening_background');
let openImg = document.getElementsByClassName("img-opening_big-img");
let imgOn = document.getElementsByClassName('opening-img_img');
let avatarImg = document.getElementsByClassName('avatar_img');
let noImgAdd = document.getElementsByClassName('profile-avatar_img-add-button2');
let newElements = document.getElementsByClassName('img-opening_big-img-content');
let slides = document.getElementsByClassName("slider-item");
let now = 0;
for (let i = 0; i < slides.length; i++) {
    let element = document.createElement("img");
    element.classList.add("opening-img_img")
    element.src = slides[i].src;
    newElements[0].append(element);
}

for (let i = 0; i < slides.length; i++) {
    slides[i].addEventListener('click', () => {
        openBackground[0].classList.add('img-opening_active');
        openImg[0].classList.add('img-opening_active');
        document.body.style.overflow = 'hidden';
        imgOn[i].classList.add("opening-img_img-active");
        now = i;
    });
}

//slider
function slider() {
    for (let i = 0; i < imgOn.length; i++) {
        imgOn[i].classList.remove("opening-img_img-active");
    }
    imgOn[now].classList.add("opening-img_img-active");
}

function slider_back() {
    if (now - 1 == -1) {
        now = imgOn.length - 1;
    } else {
        now--;
    }
    slider();
}

function slider_next() {
    if (now + 1 == imgOn.length) {
        now = 0;
    } else {
        now++;
    }
    slider();
}
let xdistance;
let ydistance;
function handeTouchStart(e) {
    ydown = e.touches[0].clientY;
    xdown = e.touches[0].clientX;
};
function handeTouchMove(e) {
    if (!ydown || !xdown) return;

    xmove = e.touches[0].clientX;
    ymove = e.touches[0].clientY;

    xdistance = xdown - xmove;
    ydistance = ydown - ymove;

    if (Math.abs(xdistance) > Math.abs(ydistance)) {
        if (xdistance > 60) {
            slider_next();
            ydown = null;
            xdown = null;
        } 
        if (xdistance < -60) {
            slider_back();
            ydown = null;
            xdown = null;
        }
    }
}

function handeTouchEnd() {
    if (ydistance > 60 || ydistance < -60) {
        openBackground[0].classList.remove('img-opening_active');
        openImg[0].classList.remove('img-opening_active');
        changeBlock[0].classList.remove('change-block_active');
        for (let i = 0; i < imgOn.length; i++) {
            imgOn[i].classList.remove("opening-img_img-active");
        }
        ydown = null;
        xdown = null;
        setTimeout(() => {
            document.body.style.overflow = '';
        },150)
    }
}

document.getElementsByClassName("img-opening_big-img")[0].addEventListener("touchstart", handeTouchStart);
document.getElementsByClassName("img-opening_big-img")[0].addEventListener("touchmove", handeTouchMove);
document.getElementsByClassName("img-opening_big-img")[0].addEventListener("touchend", handeTouchEnd);

openBackground[0].addEventListener('click', () => {
    openBackground[0].classList.remove('img-opening_active');
    openImg[0].classList.remove('img-opening_active');
    changeBlock[0].classList.remove('change-block_active');
    for (let i = 0; i < imgOn.length; i++) {
        imgOn[i].classList.remove("opening-img_img-active");
    }
    now = 0;
    document.body.style.overflow = '';
});

//change block dots
const dotsFooter = document.getElementsByClassName("profile_change-block-footer")[0];
let interval;
function dotsAnimation() {
    let checker = 0;
    dotsFooter.style.opacity = '1';
    const dots = document.getElementsByClassName("profile_change-block-dots");
    interval = setInterval(() => {
        for(let i = 0; i < dots.length; i++){
            dots[i].classList.remove("profile_change-block-dots_active");
        }
        dots[checker].classList.add("profile_change-block-dots_active");
        checker++;
         if (checker > dots.length - 1) 
            checker = 0;
    }, 300);
}

//change profile button
let changeBlock = document.getElementsByClassName('profile_change-block');

function profileChangeBlock() {
    openBackground[0].classList.add('img-opening_active');
    changeBlock[0].classList.add('change-block_active');
    document.body.style.overflow = 'hidden';
}

function profileChangeBlockClose() {
    openBackground[0].classList.remove('img-opening_active');
    changeBlock[0].classList.remove('change-block_active');
    document.body.style.overflow = '';
}

function uploadProfileData() {
    let changename = document.getElementById('change_name').value;
    let surname = document.getElementById('change_surname').value;
    let phone = document.getElementById('change_phone').value;
    let birthday = document.getElementById('change_birthdate').value;
    let aboutChange = document.getElementById('change_description').value;
    Request = CreateRequest();
    JSONobj = {
        Name: changename,
        Surname: surname,
        PhoneNumber: phone,
        Birthday: birthday,
        About: aboutChange
    };
    Request.open("POST", '../php/updateProfile.php');
    Request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    Request.send(JSON.stringify(JSONobj));
    dotsAnimation();
    updatePage(JSONobj);
    Request.onload = function () {
            if (Request.readyState === Request.DONE) {
                if (Request.status === 200) {
                    setTimeout(() => {
                        clearInterval(interval);
                        dotsFooter.style.opacity = '0';
                    }, 2000)
                }
            }
        }
}
function updatePage(data){
    document.getElementsByClassName('profile-name')[0].innerHTML= `${data['Name']} ${data['Surname']}`;
    document.getElementsByClassName('profile-about')[0].getElementsByTagName("p")[0].getElementsByTagName('span')[1].innerHTML= `${data['About']}`;
    document.getElementsByClassName('profile-birth-date')[0].getElementsByTagName('span')[1].innerHTML= `${data['Birthday']}`;
    document.getElementsByClassName('profile-number')[0].getElementsByTagName('span')[1].innerHTML= `${data['PhoneNumber']}`;
}