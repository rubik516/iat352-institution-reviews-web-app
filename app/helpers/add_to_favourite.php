<?php
    include("helper_pages.php");
    if (isset($_GET['fave_institution'])) {
        connectToDatabase();
        $result = getInstitutionByName($_GET['fave_institution']);
        $favouriteInstitution = $result->fetch_assoc();
        insertFavouriteInstitution($favouriteInstitution['name']);
        freeQueryResult($result);
        disconnectFromDatabase();
    } else {
        echo "Error occurred! Can't add to favourite!";
        exit;
    }
    header("Location: \"../favourite.php");
    exit();
?>