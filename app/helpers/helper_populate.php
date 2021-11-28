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

    function populateInstitutions($institutions) {
        foreach ($institutions as $institution => $info) {
            insertInstitution($info);
        }
    }

    function populateInstitutionRanks($institution_ranks) {
        foreach ($institution_ranks as $rank => $info) {
            insertInstitutionRank($info);
        }
    }

    function insertInstitution($institution_info) {
        global $db;
        $values = prepareInstitutionValues($institution_info);
        $query = "INSERT INTO " . INSTITUTION_INFO . " VALUES " . "(". $values . ");";
        if ($db->query($query) === false) {
            echo "Error occured: " . $db->error;
        }
    }

    function insertInstitutionRank($rank_info) {
        global $db;
        $values = prepareRankValues($rank_info);
        $query = "INSERT INTO " . INSTITUTION_RANK . " VALUES " . "(". $values . ");";
        if ($db->query($query) === false) {
            echo "Error occured: " . $db->error;
        }
    }

    function prepareInstitutionValues($institution_info) {
        return "NULL, " . // for auto increment id
            "\"" . $institution_info["university_name"] . "\", " .
            "\"" . $institution_info["country"] . "\", " .
            "-1, " . // world_rank
            "-1, " . // national_rank
            doubleval($institution_info["teaching"]) . ", " .
            "-1, " . // alumni_employment_rank
            doubleval($institution_info["income"]) . ", " .
            doubleval($institution_info["citations"]) . ", " .
            doubleval($institution_info["research"]) . ", " .
            "-1, " . // influence_rank
            doubleval($institution_info["international"]) . ", " .
            doubleval(intval(str_replace(",", "", $institution_info["num_students"]))) . ", " .
            doubleval($institution_info["international_students"]) . ", " .
            "\"" . $institution_info["female_male_ratio"] . "\"";
    }

    function prepareRankValues($rank_info) {
        return "\"" . $rank_info["institution"] . "\", " .
            intval($rank_info["world_rank"]) . ", " .
            intval($rank_info["national_rank"]) . ", " .
            intval($rank_info["alumni_employment"]) . ", " .
            intval($rank_info["influence"]);
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
                $institution_info = array();
                foreach($columns as $index => $column_name) {
                    $institution_info[$column_name] = $line[$index];
                }
                $institutions[$line[1]] = $institution_info;
            }
            fclose($file);
            return $institutions;
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
                foreach($columns as $index => $column_name) {
                    $rank_info[$column_name] = $line[$index];
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

    function extractColumnsForInstitutionRank($file) {
        $columns = fgetcsv($file); // the header row
        unset($columns[4], $columns[6], $columns[7], $columns[9], $columns[10], $columns[11], $columns[12], $columns[13]); // remove unnecessary columns
        return $columns;
    }
?>
