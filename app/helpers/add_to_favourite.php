<?php
    include("helper_pages.php");
    if (isset($_GET['favouriteInstitution'])) {
        insertFavouriteInstitution($_GET['favouriteInstitution']);
    } else {
        echo "Error occurred! Can't add to favourite!";
        exit;
    }
?>