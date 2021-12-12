<?php
    include("dbconnect.php");
    include("queries.php");

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

    function sanitizeInput($input) {
        global $db;
        return $db->real_escape_string($input);
    }

    function fetchInstitutions($requiredSorting) {
        $query = fetchInstitutionsQuery();
        if ($requiredSorting) {
            $query .= orderBy(getSortingOption());
        }
        return queryDatabase($query);
    }

    function fetchCountries() {
        $query = fetchCountriesQuery();
        return queryDatabase($query);
    }

    function fetchMyFavourite($user) {
        $query = fetchFavouriteInstitutionsQuery($user);
        return queryDatabase($query);
    }

    function getInstitutionsByCountry($queriedCountry, $requiredSorting) {
        global $db;
        $query = getInstitutionsByCountryQuery();

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
        $query = getInstitutionByNameQuery();
        $statement = $db->prepare($query);
        $statement->bind_param("s", $queriedName);
        $statement->execute();
        return $statement->get_result();
    }

    function insertFavouriteInstitution($user, $institutionName) {
        global $db;
        $query = insertFavouriteInstitutionQuery();

        connectToDatabase();
        $statement = $db->prepare($query);
        $statement->bind_param("ss", $user, $institutionName);
        $statement->execute();
        // INSERT is a non-DML operation, so free_result is not necessary
        disconnectFromDatabase();
    }

    function removeFromFavourite($user, $institutionName) {
        global $db;
        $query = removeFromFavouriteQuery();

        connectToDatabase();
        $statement = $db->prepare($query);
        $statement->bind_param("ss", $user, $institutionName);
        $statement->execute();
        // DELETE is a non-DML operation, so free_result is not necessary
        disconnectFromDatabase();
    }

    function isFavourite($user, $institutionName) {
        global $db;
        $query = isFavouriteInstitutionQuery($user);

        connectToDatabase();
        $statement = $db->prepare($query);
        $statement->bind_param("s", $institutionName);
        $statement->execute();
        $result = $statement->get_result();
        $count = $result->fetch_assoc()['institution_count'];
        freeQueryResult($result);
        disconnectFromDatabase();

        return $count > 0;
    }

    function insertInstitutionComment($body, $commenter, $institutionName) {
        global $db;
        $query = insertInstitutionCommentQuery();

        connectToDatabase();
        $cleanedInput = sanitizeInput($body);
        $statement = $db->prepare($query);
        $statement->bind_param("sss", $cleanedInput, $commenter, $institutionName);
        $statement->execute();
        // INSERT is a non-DML operation, so free_result is not necessary
        disconnectFromDatabase();
    }

    function fetchCommentsOnInstitution($institutionName) {
        global $db;
        $query = fetchCommentOnInstitutionQuery();

        $statement = $db->prepare($query);
        $statement->bind_param("s", $institutionName);
        $statement->execute();
        return $statement->get_result();
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