<?php
    include("helper_pages.php");

    session_start();
    if (!isset($_SESSION['email'])) {
        header('location: ../login.php');
    }

    $user = $_SESSION['email'];
    if (isset($_GET['favouriteInstitution'])) {
        insertFavouriteInstitution($user, $_GET['favouriteInstitution']);
        echo "inserted";
    } else {
        echo "Error occurred! Can't add to favourite!";
        exit;
    }
?>