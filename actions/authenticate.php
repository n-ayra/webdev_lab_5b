<?php
session_start();
include '../includes/Database.php';
include '../includes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $Matric = $_POST['Matric'];
    $Password = $_POST['Password'];

    $userDetails = $user->getUser($Matric);
    if ($userDetails && Password_verify($Password, $userDetails['Password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['Matric'] = $userDetails['Matric'];
        $_SESSION['Role'] = $userDetails['Role'];
        header("Location: ../pages/display.php");
        exit();
    } else {
        echo $error_message = "Invalid username or password, try <a href='login_form.php'>login</a> again.";
    }
}
?>
