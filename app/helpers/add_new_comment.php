<?php
    include("helper_pages.php");

    session_start();
    if (!isset($_SESSION['email'])) {
        header('location: ../login.php');
    } else {
        $user = $_SESSION['email'];
        if (isset($_POST['institutionComment'])) {
            $comment = $_POST['institutionComment'];
            $institution = $_POST['onInstitution'];
            insertInstitutionComment($comment, $user, $institution);
            echo "inserted";
        } else {
            echo "Error occurred! Can't add comment!";
            exit;
        }
    }
?>