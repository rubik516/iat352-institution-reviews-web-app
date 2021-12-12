<?php
    if (isset($_GET['rank-option'])) {
        connectToDatabase();
        $result = filterInstitutionsByRank($_GET['rank-option']);
        displayInstitutionSummary($result);
        freeQueryResult($result);
        disconnectFromDatabase();
    } else {
        echo "Error occurred";
        exit;
    }
    ?>



<?php
include("includes/footer.php");
?>
