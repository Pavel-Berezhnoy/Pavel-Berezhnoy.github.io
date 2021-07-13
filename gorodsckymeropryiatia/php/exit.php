<?php
foreach($_COOKIE as $key => $value) setcookie($key, '', time() - 60*60*24*7, '/');
 ?>
