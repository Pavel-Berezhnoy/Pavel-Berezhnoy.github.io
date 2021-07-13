<?php
function CheckAdmin(){
    if (($_COOKIE[role])==admin){
        return true;
    }
}
function CheckLogin(){
    if (isset($_COOKIE[name]) && isset($_COOKIE[password])){
        return true;
    }
    else {
      return false;
    }
}
?>
