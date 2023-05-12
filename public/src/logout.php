<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
<!-- This file logs out the user by destroying the current 
session and redirecting to the login page. -->