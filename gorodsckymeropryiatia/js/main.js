/*Header_img = document.getElementsByClassName('header-background_item')[0];
PositionWindow = window.pageYOffset;
Header_img.style.height = "80vh"
window.addEventListener('scroll', function() {
if(pageYOffset>PositionWindow){
  Height = Header_img.style.height.split("v")[0];
  Header_img.style.height = Height-1 + "vh";
  PositionWindow = window.pageYOffset;
  console.log(Header_img.style.height);
}
else {
  Height = Header_img.style.height.split("v")[0];
  Height++;
  Header_img.style.height = Height + "vh";
  console.log(Header_img.style.height);
  PositionWindow = window.pageYOffset;
}
});
*/
/*
  Header_img = document.getElementsByClassName('header-background')[0];
  Wrapper_header = document.getElementsByClassName('header')[0];
  Header_title = document.getElementsByClassName('header-bottom')[0];
  Header_img.style.transition = "0.7s";
  Header_img.style.height = "80vh";
  Wrapper_header.style.position = "sticky";
  Wrapper_header.style.top = "0";
  Header_title.style.transition = "0.7s";
  var deny_close = false;
  window.addEventListener('scroll', function() {
  PositionWindow = window.pageYOffset;

  if(PositionWindow == 0){


  }
  else{
        deny_close = true;
        console.log(deny_close );
      Header_img.style.height = "10vh";
      Header_title.style.overflow = "hidden";
      Header_title.style.height = "0";

  }
  });
  */
// open-close mobile-menu
menu = document.getElementsByClassName('header-nav_mobile')[0];
menu.addEventListener('click',Open_Close_MobileMenu);
bool=true;
function Open_Close_MobileMenu()
{
  block = document.getElementsByClassName('header-nav_mobile')[0];
  block2 = document.getElementsByClassName('header-nav')[0];
  if (bool == true){
    block.classList.add("mobile_active");
    block2.classList.add("mobile_active");
    document.body.classList.add("not_scroll");
    bool = false;
  }
  else{
    bool = true;
    console.log("complete");
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
