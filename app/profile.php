<?php
    session_start();

    include("helpers/helper_pages.php");
    $title = "My Profile";
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }
?>

<main>
    <h1>My Profile</h1>
    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p>Welcome <strong><?php echo $_SESSION['first_name']; ?></strong></p>
        <?php endif ?>
    </div>

</main>

<?php
include("includes/footer.php");
?>