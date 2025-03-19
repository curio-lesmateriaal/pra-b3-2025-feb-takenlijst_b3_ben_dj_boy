<?php

$action = $_POST['action'];

if($action == "create") {

    //Variabelen vullen
    $id = $_POST['id'];
    $titel = $_POST['titel'];
    $Beschrijving = $_POST['Beschrijving'];
    $Afdeling = $_POST['Afdeling'];
    $deadline = $_POST['deadline'];
    $Status = $_POST['Status'];
    $user = $_POST['user'];
    $created_at = $_POST['created_at'];





    //1. Verbinding
    require_once '../../../backend/conn.php';

    //2. Query
    $query = "INSERT INTO takenlijst (attractie, capaciteit, melder, type, prioriteit, overige_info) VALUES(:attractie, :capaciteit, :melder, :type, :prioriteit, :overige_info)";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
    ":attractie" => $attractie,
    ":capaciteit" => $capaciteit,
    ":melder" => $melder,
    ":type" => $type,
    ":prioriteit" => $prioriteit,
    ":overige_info" => $overige_info
    ]);
    header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");
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