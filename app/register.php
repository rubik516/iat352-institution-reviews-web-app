<?php
    include("helpers/helper_pages.php");
    $title = "Register";
    setHeaderAndPageTitle($title);

    include("includes/navbar.php");
    include("helpers/helper_authentication.php");

    if(!empty($_POST["registerBtn"])) {
        $username = $_POST["username"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password_confirm = $_POST["password_confirm"];
}

?>
<main>
    <div class="container">
        <div class="login-container">
            <div class="register-form col-md-4 col-md-offset-4">
                <!-- REGISTER FORM  -->
                <form id="register-form" action="register.php" name="registerForm" method="post" autocomplete='off'>
                    <h2>Register Account</h2>

                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" class='form-control' id="username" name="username" placeholder="Enter your username" required>
                    </div>

                    <div class="field">
                        <label for="first-name">First Name</label>
                        <input type="text" class='form-control' id="first-name" name="first_name" placeholder="Enter your first name" required>
                    </div>

                    <div class="field">
                        <label for="last-name">Last Name</label>
                        <input type="text" class='form-control' id="last-name" placeholder='Enter your last name' name="last_name" required>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" class='form-control' id="email" placeholder='Enter your email' name="email" required>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" class='form-control' id="password" placeholder='Enter your password' name="password" required>
                    </div>

                    <div class="field">
                        <label for="password_confirm">Confirm Password</label>
                        <input type="password" class='form-control' id="password_confirm" placeholder='Confirm your password' name="password_confirm" required>
                    </div>

                    <button type="submit" class="registerBtn" name="registerBtn">Register</button>

                    <p class="authentication-secondary">
                        Already a member? <a href="login.php">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>