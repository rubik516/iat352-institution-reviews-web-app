<?php
include("includes/header.php");
include('./helpers/helper_pages.php');
include('server.php');
include("includes/navbar.php");
include("includes/header.php");

if(!empty($_POST["registerBtn"])) {
    $username = $_POST["username"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password_1 = $_POST["password_1"];
    $password_2 = $_POST["password_2"];
}
?>
<main>
    <div class="container">
        <div class="login-container">
            <div class="register-form col-md-4 col-md-offset-4">
                <!-- REGISTER FORM  -->
                <?php include('errors.php'); ?>
                <form action="login.php" method="post" autocomplete='off'>
                    <h2>Register Account</h2>

                    <!-- USERNAME  -->
                    <div class="form-group pt-2">
                        <input type="text" class='form-control' placeholder='username' name="username" value="<?php echo $username; ?>">
                    </div>
                    <div class="form-group pt-2">
                        <input type="text" class='form-control' placeholder='first name' name="first_name" value="<?php echo $first_name; ?>">
                    </div>
                    <div class="form-group pt-2">
                        <input type="text" class='form-control' placeholder='last name' name="last_name" value="<?php echo $last_name; ?>">
                    </div>
                    <div class="form-group pt-2">
                        <input type="email" class='form-control' placeholder='email' name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group pt-2">
                        <input type="password" class='form-control' placeholder='password' name="password_1">
                    </div>
                    <div class="form-group pt-2">
                        <input type="password" class='form-control' placeholder='confirmed password' name="password_2">
                    </div>
                    <div class="form-group pt-2">
                        <button type="submit" class="registerBtn" name="registerBtn">Register</button>
                    </div>
                    <p>
                        Already a member? <a href="login.php">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>

