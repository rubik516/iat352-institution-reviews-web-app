<?php
    include("includes/header.php");
    include('helpers/helper_authentication.php');
    include("includes/navbar.php");
?>


<main>
    <div class="container">
        <div class="login-container">
            <div class="login-form col-md-4 col-md-offset-4">
                <!-- LOGIN FORM  -->
                <form id="login-form" action="login.php" method="post" autocomplete='off'>
                    <?php include('helpers/errors.php'); ?>
                    <h2>Log in to your account</h2>

                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" class='form-control' id="username" name="username" placeholder="Enter your username" required>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" class='form-control' id="password" name="password" placeholder="password" required>
                    </div>

                    <button type="submit" class="registerBtn" name="login_user">Login</button>

                    <p class="authentication-secondary">
                        Not yet a member? <a href="register.php">Become a member</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
    include("includes/footer.php");
?>