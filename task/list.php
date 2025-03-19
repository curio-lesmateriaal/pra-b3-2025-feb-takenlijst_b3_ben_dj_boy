<?php
include '../backend/config.php';
include '../app/Http/Controllers/takenController.php';


//1. Verbinding
require_once 'backend/conn.php';

//2. Query
$query = "SELECT * FROM takenlijst";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute();

//5. fetch
$taken = $statement->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include '../includes/head.php'; ?>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h2>Takenlijst</h2>
        <table>
            <tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Afdeling</th>
                <th>deadline</th>
                <th>Status</th>
            </tr>
            <?php while ($task = $tasks->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $taken['titel']; ?></td>
                    <td><?php echo $taken['beschrijving']; ?></td>
                    <td><?php echo $taken['afdeling']; ?></td>
                    <td><?php echo $taken['deadline']; ?></td>
                    <td><?php echo $taken['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>