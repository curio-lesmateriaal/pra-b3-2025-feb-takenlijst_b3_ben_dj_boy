<?php 
//variabelen vullen
    $id = $_POST['id'];

    //1. verbinding
    require_once '../../../backend/conn.php';

    //2. query
    $query = "DELETE FROM meldingen WHERE id = :id";

    //3. prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
    ":id" => $id
    ]);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding is verwijderd!");
     ?>