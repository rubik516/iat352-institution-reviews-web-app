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

        if (isFavourite($clickedInstitution['name'])) {
            echo "<p class=\"button favourited\">In my favourite list</p>";
        } else {
            echo "<a href=\"./helpers/add_to_favourite.php\" class=\"button add-favourite\">Add To My Favourite</a>";
        }
    ?>
</main>

<?php
    include("includes/footer.php");
?>


