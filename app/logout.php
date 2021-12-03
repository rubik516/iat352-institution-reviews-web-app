<?php
include("helpers/helper_pages.php");
include("includes/navbar.php");
include("includes/header.php");

// TODO: Remove the username session
session_start();
unset($_SESSION);
session_destroy();
?>