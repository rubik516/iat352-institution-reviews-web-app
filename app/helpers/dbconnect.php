<?php
    // Info for database connection
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";
    const DB_NAME = "world_institution";

    // Name of tables
    const INSTITUTION_INFO = "institution_info";
    const INSTITUTION_RANK = "institution_rank";
    const INSTITUTION = "institution";
    const USER = "user";
    const FAVOURITE = "favourite";

    // Columns for INSTITUTION
    $institutionId = "institution.institution_id";
    $institutionName = "institution.name";
    $institutionCountry = "institution.country";
    $worldRank = "institution.world_rank";
    $nationalRank = "institution.national_rank";
    $educationQuality = "institution.education_quality_score";
    $alumniEmployment = "institution.alumni_employment_rank";
    $incomeScore = "institution.income_score";
    $citationScore = "institution.citation_score";
    $researchScore = "institution.research_score";
    $influenceRank = "institution.influence_rank";
    $internationalOutlook = "institution.international_outlook_score";
    $numStudents = "institution.num_students";
    $internationalStudentPercentage = "institution.international_students";
    $femaleMaleRadio = "institution.female_male_ratio";

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$db = 'world_institution';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass , $db) or die($conn);	
?>