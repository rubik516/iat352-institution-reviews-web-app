<?php
    function fetchInstitutionsQuery() {
        return "SELECT * FROM " . INSTITUTION;
    }

    function fetchCountriesQuery() {
        global $institutionCountry;
        return "SELECT DISTINCT " . $institutionCountry .
            " FROM " . INSTITUTION .
            " ORDER BY " . $institutionCountry . " ASC;";
    }

    function fetchFavouriteInstitutionsQuery($user) {
        global $institutionName;
        return "SELECT ". INSTITUTION . ".* FROM " . INSTITUTION . " JOIN " . FAVOURITE .
            " ON " . FAVOURITE . ".user = \"" . $user .
            "\" AND " . $institutionName . " = " . FAVOURITE . ".institution" . ";";
    }

    function filterInstitutionsByRankQuery() {
        return "SELECT * FROM " . INSTITUTION . " WHERE " . INSTITUTION . ".world_rank BETWEEN ? AND ? ORDER BY " .
            INSTITUTION . ".world_rank;";
    }

    function getInstitutionByNameQuery() {
        global $institutionName;
        return "SELECT * FROM " . INSTITUTION .
            " WHERE " . $institutionName . " = ?";
    }

    function getInstitutionsByCountryQuery() {
        global $institutionCountry;
        return "SELECT * FROM " . INSTITUTION .
            " WHERE " . $institutionCountry . " = ?";
    }

    function insertFavouriteInstitutionQuery() {
        return "INSERT INTO " . FAVOURITE . " VALUES " . "(?, ?);";
    }

    function isFavouriteInstitutionQuery($user) {
        return "SELECT count(*) AS institution_count FROM " . FAVOURITE .
            " WHERE user = \"" . $user . "\" AND institution = ?;";
    }

    function removeFromFavouriteQuery() {
        return "DELETE FROM " . FAVOURITE .
            " WHERE user = ? AND institution = ?;";
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

    function insertInstitutionCommentQuery() {
        // NULL value for the first field since it will be auto incremented in the database
        // NOW() takes the current time in the format YYYY-MM-DD HH:MM:SS
        return "INSERT INTO " . COMMENT . " VALUES " . "(NULL, ?, NOW(), ?, ?);";
    }

    function fetchCommentOnInstitutionQuery() {
        return "SELECT " . COMMENT . ".body, " . COMMENT . ".datetime_posted, " .
            USER . ".first_name, " . USER . ".last_name, " . USER . ".username" .
            " FROM " . COMMENT . " JOIN " . USER . " ON " . COMMENT . ".commenter = " . USER . ".email" .
            " WHERE " . COMMENT . ".on_institution = ?" .
            " ORDER BY " . COMMENT . ".datetime_posted DESC;";
    }
?>