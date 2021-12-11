<?php
    include("helper_pages.php");

    session_start();
    if (!isset($_SESSION['email'])) {
        header('location: ../login.php');
    } else {
        $user = $_SESSION['email'];
        if (isset($_POST['favouriteInstitution'])) {
            insertFavouriteInstitution($user, $_POST['favouriteInstitution']);
            echo "inserted";
        } else {
            echo "Error occurred! Can't add to favourite!";
            exit;
        }
    }
?>