<?php
    include("helpers/helper_database.php");

    function setHeaderAndPageTitle($title) {
        ob_start();
        include("includes/header.php");
        $bufferTitle = ob_get_contents();
        ob_end_clean();

        $bufferTitle = str_replace("%PAGE_TITLE%", $title, $bufferTitle);
        echo $bufferTitle;
    }

    function displayInstitutions() {
        connectToDatabase();
        $institutions = fetchInstitutions();
        displayInstitutionSummary($institutions);
        freeQueryResult($institutions);
        disconnectFromDatabase();
    }

    function displayInstitutionSummary($institutions) {
        echo "<div class='item-list grid three-columns'>";
        foreach($institutions as $institution) {
            echo "<div class='item-card'>";
            echo "<p class='title'>" . displayContentOrNotAvailable($institution['name']) . "</p>";
            echo "<p>" . displayContentOrNotAvailable($institution['country']) . "</p>";
            echo "<p>" . displayContentOrNotAvailable($institution['world_rank']) . "</p>";
            echo "<p>" . displayContentOrNotAvailable($institution['international_outlook_score']) . "</p>";
            echo "<p>" . displayContentOrNotAvailable($institution['num_students']) . "</p>";
            echo "<p>" . displayContentOrNotAvailable($institution['international_students']) . "</p>";
            echo "</div>";
        }
        echo "</div>";
    }

    function displayContentOrNotAvailable($data) {
        return ($data == -1 or $data == 0 or $data == null) ? "N/A" : $data;
    }
?>