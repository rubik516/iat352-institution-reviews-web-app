<?php
    include("helper_pages.php");

    session_start();
    $user = $_SESSION['email'];
    if (isset($_POST['institutionToBeRemoved'])) {
        removeFromFavourite($user, $_POST['institutionToBeRemoved']);
    } else {
        echo "Error occurred! Can't remove from favourite!";
        exit;
    }
?>