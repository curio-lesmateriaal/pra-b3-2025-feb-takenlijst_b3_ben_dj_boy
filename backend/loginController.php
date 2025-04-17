<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once 'config.php';
    require_once 'conn.php';

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = :username";
    $statement = $conn->prepare($query);
    $statement->execute(['username' => $username]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);
 
    if (!$user) {
        die("Gebruiker bestaat niet.");
    }

    if ($password !== $user['password']) {
        die("Wachtwoord is onjuist.");
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['naam'];

    header("Location: ../task/index.php");
    exit;

} else {
    header("Location: ../login/login.php");
    exit;
}
