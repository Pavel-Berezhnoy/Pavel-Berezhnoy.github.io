const block = document.getElementsByClassName("wrapper")[0];
let hider;
if(window.screen.width < 768){
    block.classList.add("menu_hide");
    hider = false;
}
if (window.screen.width > 768) {
    block.classList.remove("menu_hide");
    hider = true;
}

function hideShowMenu(){
    if(hider === true){
        block.classList.add("menu_hide");
        hider = false;
        return;
    }
    if (hider === false) {
        block.classList.remove("menu_hide");
        hider = true;
    }
}
const checkboxHeader = document.getElementsByName("header_records");
const checkboxBlock = document.getElementsByClassName("checkboxes");
let counter_checkboxes = 0;
function checkbox_active() {
	if (checkboxHeader[0].checked == true) {
		for (let i = 0; i < checkboxBlock.length; i++) {
			checkboxBlock[i].checked = true;
			counter_checkboxes = checkboxBlock.length;
		}
	}
	if (checkboxHeader[0].checked == false) {
		for (let i = 0; i < checkboxBlock.length; i++) {
			checkboxBlock[i].checked = false;
			counter_checkboxes = 0;
		}
	}

}
for (let i = 0; i < checkboxBlock.length; i++) {
	checkboxBlock[i].addEventListener("click", () => {
		if (checkboxBlock[i].checked == false) {
			counter_checkboxes -= 1;
		}
		if (checkboxBlock[i].checked == true) {
			counter_checkboxes += 1;
		}
		if (counter_checkboxes == checkboxBlock.length) {
			checkboxHeader[0].checked = true;
		}
		if (counter_checkboxes != checkboxBlock.length) {
			checkboxHeader[0].checked = false;
		}
	});
}

const mobileBlock = document.getElementsByClassName("application__block-mobile");
const mobileIcon = document.getElementsByClassName("application__mobile-menu-icon");
const actionList = document.getElementsByClassName("application__sublist-action");
for (let i = 0; i < mobileIcon.length; i++) {
	let menuBool = true;
	mobileIcon[i].addEventListener('click', () => {
		if (menuBool === true) {
			mobileBlock[i].classList.add("application__block-mobile_active");
			mobileIcon[i].classList.add("application__mobile-menu-icon_active");
			actionList[i].classList.add("application__sublist-action_active");
			menuBool = false;
			return;
		} 
		if (menuBool === false) {
			mobileBlock[i].classList.remove("application__block-mobile_active");
			mobileIcon[i].classList.remove("application__mobile-menu-icon_active");
			actionList[i].classList.remove("application__sublist-action_active");
			menuBool = true;
		}
	});
}