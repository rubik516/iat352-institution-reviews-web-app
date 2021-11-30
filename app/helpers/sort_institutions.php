<?php
include("helper_pages.php");

if (isset($_GET['sortBy'])) {
    connectToDatabase();
    if (queryByCountry()) {
        $result = getInstitutionsByCountry(getQueriedCountry(), getSortingOption());
    } else {
        $result = fetchInstitutions(requiredSorting());
    }
    displayInstitutionSummary($result);
    freeQueryResult($result);
    disconnectFromDatabase();
} else {
    echo "Error occurred";
    exit;
}
?>