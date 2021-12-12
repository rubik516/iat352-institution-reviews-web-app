<?php
    session_start();
    include("helpers/helper_pages.php");
    $title = "My Favourite";
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");
?>

<main>
    <h1>My Favourite</h1>
    <?php
        if (isset($_SESSION['email'])) {
            connectToDatabase();
            $favourites = fetchMyFavourite($_SESSION['email']);
            if ($favourites->num_rows > 0) {
                displayInstitutionSummary($favourites);
            } else {
                echo "<h2 class='no-data-message'>No favourite institution in your list</h2>";
            }
            freeQueryResult($favourites);
            disconnectFromDatabase();
        }
    ?>
</main>

<?php
    include("includes/footer.php");
?>
