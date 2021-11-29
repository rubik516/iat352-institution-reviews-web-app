<?php
    include("helpers/helper_pages.php");
    $title = "Institution List";
    setHeaderAndPageTitle($title);
?>

<h1>Browse Universities Around The World</h1>

<?php
    displayCountriesList();
    displayInstitutions();
    include("includes/footer.php");
?>

