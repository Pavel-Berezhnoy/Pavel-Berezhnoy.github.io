// open-close mobile-menu
menu = document.getElementsByClassName('header-nav_mobile')[0];
menu.addEventListener('click',Open_Close_MobileMenu);
bool=true;
function Open_Close_MobileMenu()
{
  block = document.getElementsByClassName('header-nav_mobile')[0];
  block2 = document.getElementsByClassName('header-nav')[0];
  block4 = document.getElementsByClassName('header-logo_mobile')[0];
  if (bool == true){
    block.classList.add("mobile_active");
    block2.classList.add("mobile_active");
    document.body.classList.add("not_scroll");
    bool = false;
  }
  else{
    bool = true;
    block.classList.remove("mobile_active");
    block2.classList.remove("mobile_active");
    document.body.classList.remove("not_scroll");
  }

}

// resize blocks content
BlockNews = document.getElementsByClassName("block-1");
BlockContent = document.getElementsByClassName('block-1_content');
BlockPicture = document.getElementsByClassName('block-1_picture');
BlockInfo = document.getElementsByClassName('big-info');
BlockTitle = document.getElementsByClassName('block-1_title');
BlockDescription = document.getElementsByClassName('block-1_description');
BlockCategory = document.getElementsByClassName('block-1_category_hidden');
ContentRows = document.getElementsByClassName('content_rows');
function ContentSizeSmall()
{
ContentRows[0].classList.add('content_blocks');
  for (var i = 0; i < BlockNews.length; i++) {
    BlockNews[i].classList.add("block-plate-1");
    BlockNews[i].classList.add("block-1_static");
    BlockContent[i].classList.add("block-plate-1_content");
    BlockPicture[i].classList.add("block-plate-1_picture");
    BlockInfo[i].classList.remove("block-1_info");
    BlockTitle[i].classList.add('block-plate-1_title');
    BlockDescription[i].classList.add('block-plate-1_description');
    BlockCategory[i].classList.add('block-plate-1_category');

  }

}
function ContentSizeBig()
{
ContentRows[0].classList.remove('content_blocks');
  for (var i = 0; i < BlockNews.length; i++) {
    BlockNews[i].classList.remove("block-plate-1");
    BlockNews[i].classList.remove("block-1_static");
    BlockContent[i].classList.remove("block-plate-1_content");
    BlockPicture[i].classList.remove("block-plate-1_picture");
    BlockInfo[i].classList.add("block-1_info");
    BlockTitle[i].classList.remove('block-plate-1_title');
    BlockDescription[i].classList.remove('block-plate-1_description');
    BlockCategory[i].classList.remove('block-plate-1_category');

  }

}

//Header account Name
let accountName = document.getElementsByClassName('header-authorisation_name')[0].textContent;
let disableSublist = document.getElementsByClassName('header-authorisation_list');
let shortName = '';
if (accountName.length <= 12) {
  shortName = accountName;
} else {
  for (let i = 0; i < 9; i++) {
    shortName += accountName[i];
  }
  shortName += '...';
}
// if (accountName == "") {
//   disableSublist[0].classList.remove('header-authorisation_menu');
// } else {
//   disableSublist[0].classList.add('header-authorisation_menu');
// }
document.getElementsByClassName('header-authorisation_name')[0].textContent = shortName;

//button click 
let buttons = document.getElementsByClassName("btn");
for (let i = 0; i < buttons.length; i++) {
  let button = buttons[i];
  buttons[i].addEventListener('click', (event)=> {
    let buttonWidth = button.offsetWidth;
    let buttonHeight = button.offsetHeight;
    if(buttonWidth >= buttonHeight) {
      buttonHeight = buttonWidth;
    } else {
      buttonWidth = buttonHeight;
    }
    let x = event.offsetX - buttonWidth / 2;
    let y = event.offsetY - buttonHeight / 2;
    let point = document.createElement('div');
    point.style.width = buttonWidth + 'px';
    point.style.height = buttonHeight + 'px';
    point.style.top = y + 'px';
    point.style.left = x + 'px';
    point.classList.add('btn_point');
    button.appendChild(point);
    setTimeout(()=> {
      point.remove();
    },250)
  });
}

//active menu link
let nav_items = document.getElementsByClassName("header-nav_link");
for (let i = 0; i < nav_items.length; i++) {
  let link = nav_items[i].getElementsByTagName("a");
  if (link[0].href.split('/')[3] == window.location.href.split('/')[3]) {
    nav_items[i].classList.add("header-nav_link-active");
  }
}



