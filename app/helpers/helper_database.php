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
        if (!$db->query($query)) {
            echo "Error occurred!";
            disconnectFromDatabase();
            exit;
        }
        return $db->query($query);
    }

    function fetchInstitutions($requiredSorting) {
        $query = constructFetchInstitutionsQuery();
        if ($requiredSorting) {
            $query .= orderBy(getSortingOption());
        }
        return queryDatabase($query);
    }

    function fetchCountries() {
        $query = constructFetchCountriesQuery();
        return queryDatabase($query);
    }

    function fetchMyFavourite($user) {
        $query = constructFetchFavouriteInstitutionsQuery($user);
        return queryDatabase($query);
    }

    function getInstitutionsByCountry($queriedCountry, $requiredSorting) {
        global $db;
        $query = constructGetInstitutionsByCountryQuery();

        if ($requiredSorting) {
            $query .= orderBy(getSortingOption());
        }
        $statement = $db->prepare($query);
        $statement->bind_param("s", $queriedCountry);
        $statement->execute();
        return $statement->get_result();
    }

    function getInstitutionByName($queriedName) {
        global $db;
        $query = constructGetInstitutionByNameQuery();
        $statement = $db->prepare($query);
        $statement->bind_param("s", $queriedName);
        $statement->execute();
        return $statement->get_result();
    }

    function insertFavouriteInstitution($institutionName) {
        $query = constructInsertFavouriteInstitutionQuery($institutionName);
        if (!queryDatabase($query)) {
            echo "Error occurred! Cannot insert new favourite!";
            disconnectFromDatabase();
            exit;
        }
    }

    function isFavourite($institutionName) {
        $query = "SELECT count(*) AS count FROM " . FAVOURITE . " WHERE institution = \"" . $institutionName . "\";";

        connectToDatabase();
        $result = queryDatabase($query);
        $count = $result->fetch_assoc()['count'];
        freeQueryResult($result);
        disconnectFromDatabase();
        return $count > 0;
    }

    function constructFetchInstitutionsQuery() {
        return "SELECT * FROM " . INSTITUTION;
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

    function constructGetInstitutionsByCountryQuery() {
        global $institutionCountry;
        return "SELECT * FROM " . INSTITUTION .
            " WHERE " . $institutionCountry . " = ?";
    }

    function constructInsertFavouriteInstitutionQuery($institutionName) {
        return "INSERT INTO " . FAVOURITE . " VALUES " . "(\"user@example.com\", \"" . $institutionName . "\");";
    }

    function constructFetchFavouriteInstitutionsQuery($user) {
        global $institutionName;
        return "SELECT ". INSTITUTION . ".* FROM " . INSTITUTION . " JOIN " . FAVOURITE .
            " ON " . FAVOURITE . ".user = \"" . $user .
            "\" AND " . $institutionName . " = " . FAVOURITE . ".institution" .
            " ORDER BY " . $institutionName . ";";
    }

    function orderBy($option) {
        $orderBy = " ORDER BY " . $option;
        if ($option == 'name' or $option == 'world_rank') {
            $orderBy .= " ASC;";
        } else {
            $orderBy .= " DESC;";
        }
        return $orderBy;
    }

    function queryByCountry() {
        return isset($_GET['country']) && !empty($_GET['country']);
    }

    function requiredSorting() {
        return isset($_GET['sortBy']) && !empty($_GET['sortBy']);
    }

    function getQueriedCountry() {
        if(queryByCountry()) {
            return $_GET['country'];
        }
    }

    function getSortingOption() {
        if (requiredSorting()) {
            return $_GET['sortBy'];
        }
    }
?>