<?php
session_start();

// Check of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Verbinding met de database
    require_once 'config.php';
    require_once 'conn.php';

    // 2. Input ophalen en schoonmaken
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // 3. Query voorbereiden
    $query = "SELECT * FROM users WHERE username = :username";
    $statement = $conn->prepare($query);
    $statement->execute(['username' => $username]);

    // 4. Resultaat ophalen
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // 5. Gebruiker gevonden?
    if (!$user) {
        die("Gebruiker bestaat niet.");
    }

    // 6. Wachtwoord controleren
    if (!password_verify($password, $user['password'])) {
        die("Wachtwoord is onjuist.");
    }

    // 7. Sessie starten met ID en naam
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name']; // Zorg dat de kolom 'name' bestaat

    // 8. Redirect naar de hoofdpagina
    header("Location: ../logs/index.php");
    exit;

} else {
    // Als je deze pagina probeert te openen zonder POST, terugsturen
    header("Location: ../login.php");
    exit;
}