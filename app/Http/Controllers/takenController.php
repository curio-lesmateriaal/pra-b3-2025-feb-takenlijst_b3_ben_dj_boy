<?php

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == "create")  {

        // Variabelen vullen
        $titel = $_POST['titel'];
        $beschrijving = $_POST['beschrijving'];
        $afdeling = $_POST['afdeling'];
        $deadline = $_POST['deadline'];
        $status = $_POST['status'];

        // 1. Verbinding
        require_once '../../../backend/conn.php';

        // 2. Query
        $query = "INSERT INTO taken (titel, beschrijving, afdeling, deadline, status) 
                  VALUES(:titel, :beschrijving, :afdeling, :deadline, :status)";

        // 3. Prepare
        $statement = $conn->prepare($query);

        // 4. Execute
        ($statement->execute([
            ":titel" => $titel,
            ":beschrijving" => $beschrijving,
            ":afdeling" => $afdeling,
            ":deadline" => $deadline,
            ":status" => $status
        ])); 
            header("Location: ../../../index.php?msg=Melding opgeslagen");
            exit;
            
    }
} else {
    echo "Geen actie gespecificeerd.";
    exit;
}

?>

<?php

if ($action == "edit") {

    // Variabelen vullen
    $id = $_POST['id']; 
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];


    // 1. Verbinding
    require_once '../../../backend/conn.php';

    // 2. Query
    $query = "UPDATE taken 
              SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, 
                  deadline = :deadline, status = :status
              WHERE id = :id";

    // 3. Prepare
    $statement = $conn->prepare($query);

    // 4. Execute
    if ($statement->execute([
        ":id" => $id,
        ":titel" => $titel,
        ":beschrijving" => $beschrijving,
        ":afdeling" => $afdeling,
        ":deadline" => $deadline,
        ":status" => $status
    ])) {
        header("Location: ../../../index.php?msg=Melding opgeslagen");
        exit;
    } else {
        echo "Geen actie gespecificeerd.";
        exit;
    }
}


if ($action == "delete") {

        //variabelen vullen
        $id = $_POST['id'];

        //1. verbinding
        require_once '../../../backend/conn.php';

        //2. query
        $query = "DELETE FROM taken WHERE id = :id";

        //3. prepare
        $statement = $conn->prepare($query);

        //4. Execute
        $statement->execute([
            ":id" => $id
        ]);

        header("Location: ../../../index.php?msg=Melding is verwijderd!");
        exit;
}
?>