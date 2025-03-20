<?php require_once __DIR__ . '/../backend/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require_once '../head.php'; ?>


<?php require_once '../header.php'; ?>

<?php
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("Geen ID opgegeven.");
    }
    
    $id = (int) $_GET['id'];
    

    //1. Verbinding
    require_once '../backend/conn.php';

    //2. Query
    $query = "SELECT * FROM taken where id = :id";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":id" => $id
    ]);

    //5. fetch
    $taken = $statement->fetch(PDO::FETCH_ASSOC);
?>

    <form action="<?php echo $base_url; ?>../app/Http/Controllers/takenController.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $taken['id']; ?>">

        <div class="form-group">
            <label for="titel">Titel: </label>
            <input type="text" name="titel" id="titel" class="form-input" value="<?php echo $taken['titel']; ?>">
        </div>

        <div class="form-group">
            <label for="user">Maker: </label>
            <select name="user">
                <option value="1" <?php echo ($taken['user'] == "1") ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo ($taken['user'] == "2") ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo ($taken['user'] == "3") ? 'selected' : ''; ?>>3</option>
            </select>
        </div>


        <div class="form-group">
            <label for="afdeling">Afdeling: </label>
            <select name="afdeling">
                <option value="personeel" <?php echo ($taken['afdeling'] == "personeel") ? 'selected' : ''; ?>>Personeel</option>
                <option value="horeca" <?php echo ($taken['afdeling'] == "horeca") ? 'selected' : ''; ?>>Horeca</option>
                <option value="techniek" <?php echo ($taken['afdeling'] == "techniek") ? 'selected' : ''; ?>>Techniek</option>
                <option value="inkoop" <?php echo ($taken['afdeling'] == "inkoop") ? 'selected' : ''; ?>>Inkoop</option>
                <option value="klantenservice" <?php echo ($taken['afdeling'] == "klantenservice") ? 'selected' : ''; ?>>Klantenservice</option>
                <option value="groen" <?php echo ($taken['afdeling'] == "groen") ? 'selected' : ''; ?>>Groen</option>
            </select>
        </div>


        <div class="form-group">
            <label for="deadline">Deadline: </label>
            <input type="date" name="deadline" id="deadline" class="form-input" value="<?php echo $taken['deadline']; ?>">
        </div>

        <div class="form-group">
            <label for="created_at">Gemaakt op: </label>
            <input type="date" name="created_at" id="created_at" class="form-input" value="<?php echo $taken['created_at']; ?>">
        </div>

        <div class="form-group">
            <label for="beschrijving">Beschrijving: </label>
            <textarea name="beschrijving" rows="6" style="width: 600px;"><?php echo $taken['beschrijving']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status: </label>
            <select name="status">
                <option value="To-do" <?php echo ($taken['status'] == "To-do") ? 'selected' : ''; ?>>To-do</option>
                <option value="Doing" <?php echo ($taken['status'] == "Doing") ? 'selected' : ''; ?>>Doing</option>
                <option value="Done" <?php echo ($taken['status'] == "Done") ? 'selected' : ''; ?>>Done</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="aanpassen">
        </div>
    </form>

    <form action="<?php echo $base_url; ?>/app/Http/Controllers/takenController.php" method="POST">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $taken['id']; ?>">
            <input type="submit" value="Verwijderen">
        </form>

    <?php require_once '../footer.php'; ?>