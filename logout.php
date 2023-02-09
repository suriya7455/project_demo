<?php
ob_start();
session_start();
// remove session from variables
unset($_SESSION['guild_member']);
unset($_SESSION['guild_member_login']);
// remove all sesion
// session_destroy();
header('Location:login.php');
