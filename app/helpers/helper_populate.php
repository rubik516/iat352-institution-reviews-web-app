<?php
    include("helper_database.php");
    function populateInstitutions($institutions) {
        foreach ($institutions as $institution => $info) {
            insertInstitution($info);
        }
    }

    function populateInstitutionRanks($institutionRanks) {
        foreach ($institutionRanks as $rank => $info) {
            insertInstitutionRank($info);
        }
    }

    function insertInstitution($institutionInfo) {
        $values = prepareInstitutionValues($institutionInfo);
        $query = "INSERT INTO " . INSTITUTION_INFO . " VALUES " . "(". $values . ");";
        if (!queryDatabase($query)) {
            echo "Error occurred!";
            disconnectFromDatabase();
            exit;
        }
    }

    function insertInstitutionRank($rankInfo) {
        $values = prepareRankValues($rankInfo);
        $query = "INSERT INTO " . INSTITUTION_RANK . " VALUES " . "(". $values . ");";
        if (!queryDatabase($query)) {
            echo "Error occurred!";
            disconnectFromDatabase();
            exit;
        }
    }

    function prepareInstitutionValues($institutionInfo) {
        return "NULL, " . // for auto increment id
            "\"" . $institutionInfo["university_name"] . "\", " .
            "\"" . $institutionInfo["country"] . "\", " .
            "-1, " . // world_rank
            "-1, " . // national_rank
            doubleval($institutionInfo["teaching"]) . ", " .
            "-1, " . // alumni_employment_rank
            doubleval($institutionInfo["income"]) . ", " .
            doubleval($institutionInfo["citations"]) . ", " .
            doubleval($institutionInfo["research"]) . ", " .
            "-1, " . // influence_rank
            doubleval($institutionInfo["international"]) . ", " .
            doubleval(intval(str_replace(",", "", $institutionInfo["num_students"]))) . ", " .
            doubleval($institutionInfo["international_students"]) . ", " .
            "\"" . $institutionInfo["female_male_ratio"] . "\"";
    }

    function prepareRankValues($rankInfo) {
        return "\"" . $rankInfo["institution"] . "\", " .
            intval($rankInfo["world_rank"]) . ", " .
            intval($rankInfo["national_rank"]) . ", " .
            intval($rankInfo["alumni_employment"]) . ", " .
            intval($rankInfo["influence"]);
    }

    function readInstitutionsFromCSV($filename) {
        try {
            $file = @fopen($filename, 'r');
            if (!$file) {
                throw new Exception("File open failed");
                exit;
            }

            $columns = extractColumnsForInstitution($file);
            $institutions = array();
            while ($line = fgetcsv($file)) {
                unset($line[0], $line[8], $line[10], $line[13]);
                $institutionInfo = array();
                foreach($columns as $index => $columnName) {
                    $institutionInfo[$columnName] = $line[$index];
                }
                $institutions[$line[1]] = $institutionInfo;
            }
            fclose($file);
            return $institutions;
        } catch (Exception $exception) {
            echo "No data available";
            exit;
        }
    }

    function readInstitutionRankFromCSV($filename) {
        try {
            $file = @fopen($filename, 'r');
            if (!$file) {
                throw new Exception("File open failed");
                exit;
            }

            $columns = extractColumnsForInstitutionRank($file);
            $ranks = array();
            while ($line = fgetcsv($file)) {
                unset($line[4], $line[6], $line[7], $line[9], $line[10], $line[11], $line[12], $line[13]);
                $rank_info = array();
                foreach($columns as $index => $columnName) {
                    $rank_info[$columnName] = $line[$index];
                }
                $ranks[$line[1]] = $rank_info;
            }
            fclose($file);
            return $ranks;
        } catch (Exception $exception) {
            echo "No data available";
            exit;
        }
    }

    function extractColumnsForInstitution($file) {
        $columns = fgetcsv($file); // the header row
        unset($columns[0], $columns[8], $columns[10], $columns[13]); // remove unnecessary columns
        return $columns;
    }

    function extractColumnsForInstitutionRank($file) {
        $columns = fgetcsv($file); // the header row
        unset($columns[4], $columns[6], $columns[7], $columns[9], $columns[10], $columns[11], $columns[12], $columns[13]); // remove unnecessary columns
        return $columns;
    }
?>
