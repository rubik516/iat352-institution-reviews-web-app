<?php
    include("helper_populate.php");

    $institution_file = "institutionsData.csv";
    $institutions = readInstitutionsFromCSV($institution_file);

    $rank_file = "ranksData.csv";
    $institution_ranks = readInstitutionRankFromCSV($rank_file);

    connectToDatabase();
    populateInstitutions($institutions);
    populateInstitutionRanks($institution_ranks);
    disconnectFromDatabase();
?>