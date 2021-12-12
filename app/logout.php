<?php

    include("helpers/helper_pages.php");
    $title = "You're logged out";
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");

    session_start();
    unset($_SESSION);
    session_destroy();
?>

<main>
    <h2>You are logged out</h2>
</main>

<?php
include("includes/footer.php");
?>