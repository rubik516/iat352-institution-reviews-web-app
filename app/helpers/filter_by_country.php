<?php
    include("helper_pages.php");

    if (isset($_GET['country'])) {
        connectToDatabase();
        $result = getInstitutionByNameOrCountry($_GET['country']);
        displayInstitutionSummary($result);
        freeQueryResult($result);
        disconnectFromDatabase();
    } else {
        echo "Error occurred";
        exit;
    }
?>