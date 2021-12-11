<?php
include("includes/header.php");
include('./helpers/helper_pages.php');
include('helpers/helper_authentication.php');
include("includes/navbar.php");

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
                <form action="register.php" name="registerForm" method="post" autocomplete='off'>
                    <h2>Register Account</h2>

                    <div class="form-group pt-2">
                        <input type="text" class='form-control' placeholder='username' name="username">
                    </div>
                    <div class="form-group pt-2">
                        <input type="text" class='form-control' placeholder='first name' name="first_name">
                    </div>
                    <div class="form-group pt-2">
                        <input type="text" class='form-control' placeholder='last name' name="last_name">
                    </div>
                    <div class="form-group pt-2">
                        <input type="email" class='form-control' placeholder='email' name="email">
                    </div>
                    <div class="form-group pt-2">
                        <input type="password" class='form-control' placeholder='password' id='password' name="password">
                    </div>
                    <div class="form-group pt-2">
                        <input type="password" class='form-control' placeholder='confirmed password'  id='password_confirm' name="password_confirm">
                    </div>
                    <div class="form-group pt-2">
                        <button type="submit" class="registerBtn" name="registerBtn">Register</button>
                    </div>
                    <!-- <p>
                        Already a member? <a href="login.php">Sign in</a>
                    </p> -->
                </form>
            </div>
        </div>
    </div>
</main>

