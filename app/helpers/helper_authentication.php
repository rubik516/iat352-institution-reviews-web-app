<?php
    session_start();
    $errors = array();

////    // initializing variables
//    $username = "";
//    $email    = "";
//    $first_name = "";
//    $last_name = "";

    if (is_post_request()) {
        if (isset($_POST['registerBtn'])) {
            register();
        }

        if (isset($_POST['login_user'])) {
            login();
        }
    }

    function register() {
        global $errors;

        // connect to the database
        $db = mysqli_connect('localhost', 'root', '', 'world_institution');

        // receive all input values from the form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password_1); //encrypt the password before saving in the database

            $query = "INSERT INTO " . USER . " (email, username, password, first_name, last_name) 
                        VALUES('$email', '$username', '$password', '$first_name', '$last_name')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            mysqli_close($db);
            header('location: profile.php');
        }
    }

    function login() {
        global $errors;

        // connect to the database
        $db = mysqli_connect('localhost', 'root', '', 'world_institution');
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM " . USER . " WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $user = mysqli_fetch_assoc($results);
                $_SESSION['username'] = $username;
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['success'] = "You are now logged in";
                mysqli_free_result($results);
                mysqli_close($db);
                header('location: profile.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>