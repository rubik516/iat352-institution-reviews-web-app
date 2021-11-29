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

    function getInstitutionFromDatabase($institutionName) {
        global $db;
        connectToDatabase();
        $getInstitutionByNameQuery = constructGetInstitutionByNameQuery();
        $statement = $db->prepare($getInstitutionByNameQuery);
        $statement->bind_param("s", $institutionName);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $result->free_result();
        disconnectFromDatabase();
        return $row;
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
?>