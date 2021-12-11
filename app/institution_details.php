<?php
    ob_start();
    include("index.php");
    ob_end_clean();

    global $clickedInstitution;
    $clickedInstitution = getClickedInstitution();
    $title = $clickedInstitution['name'];
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");
?>

<main>
    <?php
        echo "<h1>" . $title . "</h1>";
        displayInstitutionDetails($clickedInstitution);

        session_start();
        if (!isset($_SESSION['email'])) {
            echo "<a href=\"./helpers/add_to_favourite.php\" class=\"button add-favourite\">Add To My Favourite</a>";
        } else {
            $user = $_SESSION['email'];
            if (isFavourite($user, $clickedInstitution['name'])) {
                echo "<p class=\"button favourited\">In My Favourite List</p>";
                echo "<a href=\"./helpers/remove_from_favourite.php\" class=\"button remove-favourite\">Remove From My Favourite</a>";
            } else {
                echo "<a href=\"./helpers/add_to_favourite.php\" class=\"button add-favourite\">Add To My Favourite</a>";
            }
        }
    ?>
</main>

<?php
    include("includes/footer.php");
?>


