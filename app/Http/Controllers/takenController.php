<?php

$action = $_POST['action'];

if($action == "create") {

    //Variabelen vullen
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $deadline = $_POST['deadline'];
    $Status = $_POST['status'];
    $user = $_POST['user'];
    $created_at = $_POST['created_at'];



    //1. Verbinding
    require_once '../../../backend/conn.php';

    //2. Query
    $query = "INSERT INTO taken (titel, beschrijving, afdeling, deadline, status, user, created_at) VALUES(:titel, :beschrijving, :afdeling, :deadline, :status, :user, :created_at)";
    
    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
    ":titel" => $titel,
    ":beschrijving" => $beschrijving,
    ":afdeling" => $afdeling,
    ":deadline" => $deadline,
    ":status" => $status,
    ":created_at" => $created_at,
    ":user" => $user
    ]);
    header("Location: ../../../index.php?msg=Melding opgeslagen");
}


if($action == "edit"){

    //Variabelen vullen
    $attractie = $_POST['attractie'];
    $capaciteit = $_POST['capaciteit'];
    $melder = $_POST['melder'];
    $overige_info = $_POST['overige_info'];
    $id = $_POST['id'];



    // if(empty($overige_info) or (empty($attractie)) or (empty($type)) or (empty($capaciteit)) or (empty($melder))); 
    // {
    //     $errors[] = "vul alle velden in.";
    // }


    if(isset($_POST['prioriteit']))
    {
    $prioriteit = 1;
    }
    else
    {
    $prioriteit = 0;
    }



    // if(isset($errors)){
    //     print_r($errors);
    //     die();
    // }


    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "UPDATE meldingen SET attractie = :attractie, capaciteit = :capaciteit,
    melder = :melder, prioriteit = :prioriteit, overige_info = :overige_info
    WHERE id = :id";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":prioriteit" => $prioriteit,
    ":overige_info" => $overige_info,
    ":id" => $id
    ]);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding is aangepast!");
}
if($action == "delete") {

    //variabelen vullen
    $id = $_POST['id'];

    //1. verbinding
    require_once '../../../config/conn.php';

    //2. query
    $query = "DELETE FROM meldingen WHERE id = :id";

    //3. prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
    ":id" => $id
    ]);

    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding is verwijderd!");
}

?>