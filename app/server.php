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
if (isset($_POST['registerBtn'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password, first_name, last_name) 
  			  VALUES('$username', '$email', '$password', '$first_name', '$last_name')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['success'] = "You are now logged in";
        header('location: profile.php');
    }
}

if (isset($_POST['login_user'])) {
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
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
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
// if (isset($_POST['loginBtn'])) {
//     $username = mysqli_real_escape_string($db, $_POST['username']);
//     $password = mysqli_real_escape_string($db, $_POST['password']);

//     if (empty($username)) {
//         echo "Username is required";
//     }
//     if (empty($password)) {
//         echo "password is required";
//     }

    
//   }
?>

