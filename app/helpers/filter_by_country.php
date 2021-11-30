<?php
    include("helper_pages.php");

    if (isset($_GET['country'])) {
        connectToDatabase();
        $result = getInstitutionsByCountry(getQueriedCountry(), requiredSorting());
        displayInstitutionSummary($result);
        freeQueryResult($result);
        disconnectFromDatabase();
    } else {
        echo "Error occurred";
        exit;
    }
?>