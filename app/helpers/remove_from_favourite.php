<?php
    include("helper_pages.php");
    if (isset($_GET['institutionToBeRemoved'])) {
        removeFromFavourite("user@example.com", $_GET['institutionToBeRemoved']);
    } else {
        echo "Error occurred! Can't remove from favourite!";
        exit;
    }
?>