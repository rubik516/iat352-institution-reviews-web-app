<?php
    include("helper_pages.php");

    session_start();
    if (!isset($_SESSION['email'])) {
        $response = array('redirect' => "login.php");
        echo json_encode($response);
        exit;
    } else {
        $user = $_SESSION['email'];
        if (isset($_POST['institutionComment'])) {
            $comment = $_POST['institutionComment'];
            $institution = $_POST['onInstitution'];
            insertInstitutionComment($comment, $user, $institution);
            $response = array('success' => "success");
            echo json_encode($response);
        } else {
            echo "Error occurred! Can't add comment!";
            exit;
        }
    }
?>