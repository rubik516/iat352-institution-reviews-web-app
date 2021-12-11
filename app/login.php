<?php
include("includes/header.php");
include('./helpers/helper_pages.php');
include('helpers/helper_authentication.php');
include("includes/navbar.php");
?>


<main>
    <div class="container">
        <div class="login-container">
            <div class="login-form col-md-4 col-md-offset-4">
                <!-- LOGIN FORM  -->
                <form action="login.php" method="post" autocomplete='off'>
                    <?php include('helpers/errors.php'); ?>
                    <h2>Log in to your account</h2>
                    <!-- LOG IN  -->
                    <div class="form-group pt-2">
                        <input type="text" class='form-control' name="username" placeholder="username" required>
                    </div>
                    <!-- PASSWORD  -->
                    <div class="form-group pt-2 pb-2">
                        <input type="password" class='form-control' name="password" placeholder="password" required>
                    </div>

                    <div class="form-group pt-2">
                        <button type="submit" class="registerBtn" name="login_user">Login</button>
                    </div>
                    <div class="noAccount">
                        <a href="register.php">REGISTER</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<?php
include("includes/footer.php");
?>