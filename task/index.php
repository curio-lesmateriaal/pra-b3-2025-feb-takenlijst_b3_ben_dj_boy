<?php
require_once '../backend/config.php';

require_once '../head.php';

require_once '../header.php';


//1. Verbinding
require_once '../backend/conn.php';

//2. Query
$query = "SELECT * FROM taken WHERE status = 'To-do'";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute();

//5. fetch
$taken = $statement->fetchAll(PDO::FETCH_ASSOC);

//2. Query
$tquery = "SELECT * FROM taken WHERE status = 'Doing'";

//3. Prepare
$tstatement = $conn->prepare($tquery);

//4. Execute
$tstatement->execute();

//5. fetch
$ttaken = $tstatement->fetchAll(PDO::FETCH_ASSOC);
?>
    
    <main>
        <h2>To-Do</h2>
        <table>
            <tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Afdeling</th>
                <th>deadline</th>
                <th></th>
            </tr>
            <?php foreach ($taken as $taak): ?>
                <tr>
                    <td><?php echo $taak['titel']; ?></td>
                    <td><?php echo $taak['beschrijving']; ?></td>
                    <td><?php echo $taak['afdeling']; ?></td>
                    <td><?php echo $taak['deadline']; ?></td>
                    <td><a href="/task/edit.php?id=<?php echo $taak['id']?>"><button>Bewerk</button></a></td>
                </tr>
                
            <?php endforeach; ?>
        </table>
        <h2>Doing</h2>
        <table>
            <tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Afdeling</th>
                <th>deadline</th>
                <th></th>
            </tr>
            <?php foreach ($ttaken as $ttaak): ?>
                <tr>
                    <td><?php echo $ttaak['titel']; ?></td>
                    <td><?php echo $ttaak['beschrijving']; ?></td>
                    <td><?php echo $ttaak['afdeling']; ?></td>
                    <td><?php echo $ttaak['deadline']; ?></td>
                    <td><a href="/task/edit.php?id=<?php echo $ttaak['id']?>"><button>Bewerk</button></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>

<?php require_once '../footer.php'; ?>
