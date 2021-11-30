<?php
    include("helpers/helper_pages.php");
    $title = "My Favourite";
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");
?>

<main>
    <h1>My Favourite</h1>
    <?php
        connectToDatabase();
        $favourites = fetchMyFavourite("user@example.com");
        displayInstitutionSummary($favourites);
        freeQueryResult($favourites);
        disconnectFromDatabase();
    ?>
</main>

<?php
    include("includes/footer.php");
?>
