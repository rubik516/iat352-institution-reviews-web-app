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
        global $institutions;
        $institutions = fetchInstitutions();
        displayInstitutionSummary($institutions);
        freeQueryResult($institutions);
        disconnectFromDatabase();
    }

    function displayCountriesList() {
        connectToDatabase();
        $countries = fetchCountries();
        populateCountryDropdown($countries);
        freeQueryResult($countries);
        disconnectFromDatabase();
    }

    function getClickedInstitution() {
        if (isset($_GET['institution'])) {
            $institutionName = $_GET['institution'];
            return getInstitutionFromDatabase($institutionName);
        }
    }

    function displayInstitutionSummary($institutions) {
        echo "<div class='item-list grid three-columns'>";
        foreach($institutions as $institution) {
            echo "<div class='item-card'>";
            echo "<a href='institution_details.php?institution=" . $institution['name'] . "'>";
            echo "<p class='title'>" . contentOrNotAvailable($institution['name']) . "</p>";
            echo "<p>" . contentOrNotAvailable($institution['country']) . "</p>";
            echo "<p>World rank: " . contentOrNotAvailable($institution['world_rank']) . "</p>";
            echo "<p>International Outlook Score: " . contentOrNotAvailable($institution['international_outlook_score']) . "</p>";
            echo "<p>Number of Students: " . contentOrNotAvailable($institution['num_students']) . "</p>";
            echo "<p>International Students Percentage: " . displayPercentage(contentOrNotAvailable($institution['international_students'])) . "</p>";
            echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }

    function displayInstitutionDetails($institution) {
        echo "<p>Country: " . contentOrNotAvailable($institution['country']) . "</p>";
        echo "<p>World rank: " . contentOrNotAvailable($institution['world_rank']) . "</p>";
        echo "<p>National rank: " . contentOrNotAvailable($institution['national_rank']) . "</p>";
        echo "<p>Education Quality Score: " . contentOrNotAvailable($institution['education_quality_score']) . "</p>";
        echo "<p>Alumni Employment Rank: " . contentOrNotAvailable($institution['alumni_employment_rank']) . "</p>";
        echo "<p>Income score: " . contentOrNotAvailable($institution['income_score']) . "</p>";
        echo "<p>Citation Score: " . contentOrNotAvailable($institution['citation_score']) . "</p>";
        echo "<p>Research Score: " . contentOrNotAvailable($institution['research_score']) . "</p>";
        echo "<p>Influence Rank: " . contentOrNotAvailable($institution['influence_rank']) . "</p>";
        echo "<p>International Outlook Score: " . contentOrNotAvailable($institution['international_outlook_score']) . "</p>";
        echo "<p>Number of students: " . contentOrNotAvailable($institution['num_students']) . "</p>";
        echo "<p>International Students Percentage: " . displayPercentage(contentOrNotAvailable($institution['international_students'])) . "</p>";
        echo "<p>Female : Male Ratio: " . contentOrNotAvailable($institution['female_male_ratio']) . "</p>";
    }

    function populateCountryDropdown($countries) {
        echo "<select id='country-dropdown' name='country-dropdown'>";
        foreach($countries as $country) {
            echo "<option value='" . $country['country'] . "'>" . $country['country'] . "</option>";
            print_r($country);
        }
        echo "</select>";
    }

    function contentOrNotAvailable($data) {
        return ($data == -1 or $data == 0 or $data == null) ? "N/A" : $data;
    }

    function displayPercentage($value) {
        if ($value != "N/A") {
            return strval($value*100) . "%";
        }
    }
?>