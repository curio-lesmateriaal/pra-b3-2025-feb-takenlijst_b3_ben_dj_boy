<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

    <header>
        <h1>Task Manager</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="list.php">Takenlijst</a></li>
                <li><a href="edit.php">Nieuwe taak</a></li>
            </ul>
        </nav>
    </header>
<body>
        
    <form action="../app/Http/Controllers/takenController.php" method="post">
    <input type="hidden" name="action" value="create">
    <input type="hidden" name="status" value="To-do">

    <div class="form-group">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" class="form-input">
            </div>

            <div class="form-group">
                <label for="user">Maker:</label>
                <input type="text" name="user" id="user" class="form-input">
            </div>

            <div class="form-group">
                <label for="afdeling">afdeling</label>
                <select name="type">
                    <option value="personeel">Personeel</option>
                    <option value="horeca">Horeca</option>
                    <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</option>
                </select>
                </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="form-input">
            </div>

            <div class="form-group">
            <input type="submit" value="Maken">
            </div>
    </form>
</body>
</html>