<?php
    include("helper_populate.php");

    $institutionFile = "../data/institutionsData.csv";
    $institutions = readInstitutionsFromCSV($institutionFile);

    $rankFile = "../data/ranksData.csv";
    $institutionRanks = readInstitutionRankFromCSV($rankFile);

    connectToDatabase();
    populateInstitutions($institutions);
    populateInstitutionRanks($institutionRanks);
    disconnectFromDatabase();
?>