<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

if (isset($_SESSION['user_id'])) {
    $user_id = intval($_SESSION['user_id']); // veilig integer maken

    require_once '../backend/config.php';
    require_once '../backend/conn.php';
    require_once '../head.php';
    require_once '../header.php';

    $ttaken = []; // Lege array voor taken

    $filter = $_GET['filter'] ?? '';
    ?>

    <div class="Filter">
        <form action="" method="GET">
            <label for="filter">Filter op afdeling: </label>
            <select name="filter" id="filter">
                <option value="personeel">Personeel</option>
                <option value="horeca">Horeca</option>
                <option value="techniek">Techniek</option>
                <option value="inkoop">Inkoop</option>
                <option value="klantenservice">Klantenservice</option>
                <option value="groen">Groen</option>
            </select>
            <input type="submit" value="Filteren">
        </form>
    </div>

    <?php
    if (!empty($filter)) {
        // Haal alle taken van deze afdeling met status To-do, Doing of Done
        $tquery = "SELECT * FROM taken 
                   WHERE status IN ('To-do', 'Doing', 'Done') 
                   AND afdeling = :filter 
                   ORDER BY deadline ASC";
        $tstatement = $conn->prepare($tquery);
        $tstatement->execute(['filter' => $filter]);
        $ttaken = $tstatement->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <main>
        <h2><?php echo htmlspecialchars($filter); ?></h2>

        <?php if (!empty($ttaken)): ?>
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>Titel</th>
                    <th>Afdeling</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Bewerken</th>
                </tr>
                <?php foreach ($ttaken as $taak): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($taak['titel']); ?></td>
                        <td><?php echo htmlspecialchars($taak['afdeling']); ?></td>
                        <td><?php echo htmlspecialchars($taak['deadline']); ?></td>
                        <td><?php echo htmlspecialchars($taak['status']); ?></td>
                        <td>
                            <a href="/task/edit.php?id=<?php echo $taak['id']; ?>">
                                <button>Bewerk</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Geen taken gevonden voor afdeling: <strong><?php echo htmlspecialchars($filter); ?></strong>.</p>
        <?php endif; ?>
    </main>

    <?php require_once '../footer.php'; 
} else {
    echo "Je bent niet ingelogd";
}
?>
