<?php
ob_start(); // Start output buffering

session_start();

// Zorg ervoor dat de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

// Controleer of er een actie is ingesteld
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Zorg ervoor dat actie geldig is
    if ($action == "create") {
        // Variabelen vullen, controleren op mogelijke ontbrekende gegevens
        $titel = $_POST['titel'] ?? '';
        $beschrijving = $_POST['beschrijving'] ?? '';
        $afdeling = $_POST['afdeling'] ?? '';
        $deadline = $_POST['deadline'] ?? '';
        $status = $_POST['status'] ?? '';

        // Hier kun je een validatie of sanitatie van de input toevoegen, bijvoorbeeld:
        if (empty($titel) || empty($beschrijving)) {
            // Stuur een foutmelding terug als vereist
            header("Location: ../../../index.php?msg=Vul alle velden in.");
            exit;
        }

        // Verbinding met de database
        require_once '../../../backend/conn.php';

        // Query voor het toevoegen van een taak
        $query = "INSERT INTO taken (titel, beschrijving, afdeling, deadline, status, user) 
                  VALUES(:titel, :beschrijving, :afdeling, :deadline, :status, :user)";
        $statement = $conn->prepare($query);

        // Execute statement
        $statement->execute([
            ":titel" => $titel,
            ":beschrijving" => $beschrijving,
            ":afdeling" => $afdeling,
            ":deadline" => $deadline,
            ":status" => $status,
            ":user" => $_SESSION['user_id']
        ]);

        // Redirect na succesvolle toevoeging
        header("Location: ../../../index.php?msg=Melding opgeslagen");
        exit;
    }

    if ($action == "edit") {
        // Variabelen vullen
        $id = $_POST['id'] ?? ''; 
        $titel = $_POST['titel'] ?? '';
        $beschrijving = $_POST['beschrijving'] ?? '';
        $afdeling = $_POST['afdeling'] ?? '';
        $deadline = $_POST['deadline'] ?? '';
        $status = $_POST['status'] ?? '';

        // Controleer of alle noodzakelijke velden zijn ingevuld
        if (empty($id) || empty($titel) || empty($beschrijving)) {
            header("Location: ../../../index.php?msg=Vul alle velden in.");
            exit;
        }

        // Verbinding met de database
        require_once '../../../backend/conn.php';

        // Query voor het updaten van een taak
        $query = "UPDATE taken 
                  SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, 
                      deadline = :deadline, status = :status
                  WHERE id = :id";
        $statement = $conn->prepare($query);

        // Execute statement
        if ($statement->execute([
            ":id" => $id,
            ":titel" => $titel,
            ":beschrijving" => $beschrijving,
            ":afdeling" => $afdeling,
            ":deadline" => $deadline,
            ":status" => $status
        ])) {
            // Redirect na succesvolle update
            header("Location: ../../../index.php?msg=Melding opgeslagen");
            exit;
        } else {
            // Foutmelding bij mislukte update
            header("Location: ../../../index.php?msg=Er is iets misgegaan.");
            exit;
        }
    }

    if ($action == "delete") {
        // Variabelen vullen
        $id = $_POST['id'] ?? '';

        // Zorg ervoor dat het id bestaat
        if (empty($id)) {
            header("Location: ../../../index.php?msg=Geen taak geselecteerd.");
            exit;
        }

        // Verbinding met de database
        require_once '../../../backend/conn.php';

        // Query voor het verwijderen van een taak
        $query = "DELETE FROM taken WHERE id = :id";
        $statement = $conn->prepare($query);

        // Execute statement
        $statement->execute([":id" => $id]);

        // Redirect na succesvolle verwijdering
        header("Location: ../../../index.php?msg=Melding is verwijderd!");
        exit;
    }

    if ($action == "filter") {
        // Variabelen vullen
        $filter = $_POST['filter'] ?? '';  // fallback naar lege string

        // Redirect naar filterpagina
        header("Location: ../../../task/filter.php?filter=$filter");
        exit;
    }
}

ob_end_flush(); // Verzend de gebufferde output naar de browser
?>
