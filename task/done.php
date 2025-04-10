<?php
require_once '../backend/config.php';

require_once '../head.php';

require_once '../header.php';

?>

    <div class="Filter">
        <form action="<?php echo $base_url; ?>/app/Http/Controllers/takenController.php" method="POST">

        <input type="hidden" name="action" value="filter-done">

            <label for="filter">Filter: </label>
            <select name="filter">
                <option value="">--alles weergeven--</option>
                <option value="personeel">Personeel</option>
                <option value="horeca">Horeca</option>
                <option value="techniek">Techniek</option>
                <option value="inkoop">Inkoop</option>
                <option value="klantenservice">Klantenservice</option>
                <option value="groen">Groen</option>
            </select>
            <input type="submit" value="filteren">
        </form>
    </div>

<?php
// filter
$filter = $_GET['filter'] ?? '';

if (!empty($filter)) {
    //1. Verbinding
    require_once '../backend/conn.php';

    //2. Query
    $query = "SELECT * FROM taken WHERE status = 'done' AND afdeling = '$filter' ORDER BY deadline ASC";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute();

    //5. fetch
    $taken = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else{
    //1. Verbinding
    require_once '../backend/conn.php';

    //2. Query
    $query = "SELECT * FROM taken WHERE status = 'Done' ORDER BY deadline ASC";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute();

    //5. fetch
    $taken = $statement->fetchAll(PDO::FETCH_ASSOC);

}

?>
    
    <main>
        <h2>Done</h2>
        <table>
            <tr>
                <th>Titel</th>
                <th>Afdeling</th>
                <th>deadline</th>
                <th></th>
            </tr>
            <?php foreach ($taken as $taak): ?>
                <tr>
                    <td><?php echo $taak['titel']; ?></td>
                    <td><?php echo $taak['afdeling']; ?></td>
                    <td><?php echo $taak['deadline']; ?></td>
                    <td><a href="/task/edit.php?id=<?php echo $taak['id']?>"><button>Bewerk</button></a></td>
                </tr>
                
            <?php endforeach; ?>
        </table>
    </main>

<?php require_once '../footer.php'; ?>
