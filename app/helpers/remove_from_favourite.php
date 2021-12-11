<?php
    include("helper_pages.php");

    session_start();
    $user = $_SESSION['email'];
    if (isset($_GET['institutionToBeRemoved'])) {
        removeFromFavourite($user, $_GET['institutionToBeRemoved']);
    } else {
        echo "Error occurred! Can't remove from favourite!";
        exit;
    }
?>