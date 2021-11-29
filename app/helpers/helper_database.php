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
        $fetchInstitutionsQuery = constructFetchInstitutionQuery();
        if (!queryDatabase($fetchInstitutionsQuery)) {
            echo "Error occurred!";
            disconnectFromDatabase();
            exit;
        }
        return queryDatabase($fetchInstitutionsQuery);
    }

    function constructFetchInstitutionQuery() {
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


?>