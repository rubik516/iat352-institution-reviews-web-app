<?php
    include("helpers/helper_pages.php");
    $title = "My Favourite";
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");
?>

<main>
    <h1>My Favourite</h1>
    <?php
        session_start();
        if (isset($_SESSION['email'])) {
            connectToDatabase();
            $favourites = fetchMyFavourite($_SESSION['email']);
            displayInstitutionSummary($favourites);
            freeQueryResult($favourites);
            disconnectFromDatabase();
        }
    ?>
</main>

<?php
    include("includes/footer.php");
?>
