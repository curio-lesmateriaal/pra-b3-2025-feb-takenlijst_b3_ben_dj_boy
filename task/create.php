<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}
?>

<?php require_once __DIR__ . '/../backend/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require_once '../head.php'; ?>


<?php require_once '../header.php'; ?>

<?php  
if (isset($_SESSION['user_id'])) {
    $user_id = intval($_SESSION['user_id']); // veilig integer maken ?>

    <form action="<?php echo $base_url; ?>/app/Http/Controllers/takenController.php" method="POST">
        <input type="hidden" name="action" value="create">
        <input type="hidden" name="status" value="To-do">

        <div class="form-group">
            <label for="titel">Titel: </label>
            <input type="text" name="titel" id="titel" class="form-input">
        </div>

        <div class="form-group">
            <label for="afdeling">Afdeling: </label>
            <select name="afdeling">
                <option value="personeel">Personeel</option>
                <option value="horeca">Horeca</option>
                <option value="techniek">Techniek</option>
                <option value="inkoop">Inkoop</option>
                <option value="klantenservice">Klantenservice</option>
                <option value="groen">Groen</option>
            </select>
        </div>
        <div class="date-input">
        <div class="form-group">
            <label for="deadline">Deadline: </label>
            <input type="date" name="deadline" id="deadline" class="form-input">
        </div>


        <div class="form-group">
            <label for="beschrijving">Beschrijving: </label>
            <textarea name="beschrijving" rows="6" style="width: 600px;"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Maken">
        </div>
    </form>

    <?php require_once '../footer.php'; 
} elseif (empty($_SESSION['user_id'])) { // Verwijder puntkomma hier
    echo "Je bent niet ingelogd";
}
?>
