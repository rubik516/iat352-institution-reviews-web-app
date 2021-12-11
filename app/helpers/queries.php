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
?>