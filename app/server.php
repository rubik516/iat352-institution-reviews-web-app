<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$first_name = "";
$last_name = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'world_institution');

// REGISTER USER
if (is_post_request()) {
    if (isset($_POST['registerBtn'])) {


        // receive all input values from the form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password_confirm = mysqli_real_escape_string($db, $_POST['password_confirm']);

        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
    
        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $securePassword = md5($password); //encrypt the password before saving in the database
    
            $query = "INSERT INTO users (username, email, password, first_name, last_name) 
                    VALUES('$username', '$email', '$securePassword', '$first_name', '$last_name')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['success'] = "You are now logged in";
            header('location: profile.php');
        }
    }

    
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username && $password)) {
        array_push($errors, "Username and password is required");
    }
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $securePassword = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$securePassword'";

        $result = mysqli_query($db, $query);
     
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;          
            $_SESSION['success'] = "You are now logged in";
          header('location: profile.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }

?>

