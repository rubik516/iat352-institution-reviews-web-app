<?php
    include("helper_populate.php");

    $institution_file = "../data/institutionsData.csv";
    $institutions = readInstitutionsFromCSV($institution_file);

    $rank_file = "../data/ranksData.csv";
    $institution_ranks = readInstitutionRankFromCSV($rank_file);

    connectToDatabase();
    populateInstitutions($institutions);
    populateInstitutionRanks($institution_ranks);
    disconnectFromDatabase();
?>