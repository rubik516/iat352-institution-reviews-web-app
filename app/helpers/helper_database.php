<?php
    include("dbconnect.php");
    function connectToDatabase() {
        global $db;
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($db->connect_errno) {
            $db->close();
            echo "Unable to popularize data at the moment.";
            exit;
        }
    }

    function disconnectFromDatabase() {
        global $db;
        $db->close();
    }

    function freeQueryResult($result) {
        $result->free_result();
    }

    function queryDatabase($query) {
        global $db;
        return $db->query($query);
    }

    function fetchInstitutions() {
        $fetchInstitutionsQuery = constructFetchInstitutionsQuery();
        if (!queryDatabase($fetchInstitutionsQuery)) {
            echo "Error occurred!";
            disconnectFromDatabase();
            exit;
        }
        return queryDatabase($fetchInstitutionsQuery);
    }

    function fetchCountries() {
        $fetchCountryQuery = constructFetchCountriesQuery();
        if (!queryDatabase($fetchCountryQuery)) {
            echo "Error occurred!";
            disconnectFromDatabase();
            exit;
        }
        return queryDatabase($fetchCountryQuery);
    }

    function getInstitutionByNameOrCountry($queriedString) {
        global $db;
        $getInstitutionQuery = "";
        if (queryByInstitutionName()) {
            $getInstitutionQuery = constructGetInstitutionByNameQuery();
        } elseif (queryByCountry()) {
            $getInstitutionQuery = constructGetInstitutionsByCountry();
        } else {
            echo "Error occured";
            disconnectFromDatabase();
            exit;
        }
        $statement = $db->prepare($getInstitutionQuery);
        $statement->bind_param("s", $queriedString);
        $statement->execute();
        return $statement->get_result();
    }

    function constructFetchInstitutionsQuery() {
        global $institutionName, $institutionCountry, $worldRank, $numStudents,
               $internationalStudentPercentage, $internationalOutlook;
        return "SELECT " . $institutionName . ", " .
            $institutionCountry . ", " .
            $worldRank . ", " .
            $numStudents . ", " .
            $internationalOutlook . ", " .
            $internationalStudentPercentage .
            " FROM " . INSTITUTION . " ORDER BY " . $institutionName . " ASC";
    }

    function constructFetchCountriesQuery() {
        global $institutionCountry;
        return "SELECT DISTINCT " . $institutionCountry .
                " FROM " . INSTITUTION .
                " ORDER BY " . $institutionCountry . " ASC;";
    }

    function constructGetInstitutionByNameQuery() {
        global $institutionName;
        return "SELECT * FROM " . INSTITUTION .
                " WHERE " . $institutionName . " = ?";
    }

    function constructGetInstitutionsByCountry() {
        global $institutionCountry;
        return "SELECT * FROM " . INSTITUTION .
            " WHERE " . $institutionCountry . " = ?";
    }

    function queryByInstitutionName() {
        return isset($_GET['institution']);
    }

    function queryByCountry() {
        return isset($_GET['country']);
    }
?>