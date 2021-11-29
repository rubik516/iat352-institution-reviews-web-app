<?php
    ob_start();
    include("index.php");
    ob_end_clean();

    global $clickedInstitution;
    $clickedInstitution = getClickedInstitution();

    $title = $clickedInstitution['name'];
    setHeaderAndPageTitle($title);

    echo "<h1>" . $title . "</h1>";
    displayInstitutionDetails($clickedInstitution);

    include("includes/footer.php");
?>


