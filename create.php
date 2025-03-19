<?php require_once 'head.php'; ?>

<h2>Nieuwe taak toevoegen</h2>
<form action="index.php" method="POST">
    Titel: <input type="text" name="title" required><br>
    Beschrijving: <input type="text" name="description" required><br>
    Afdeling: 
    <select name="department">
        <option value="personeel">Personeel</option>
        <option value="horeca">Horeca</option>
        <option value="techniek">Techniek</option>
        <option value="inkoop">Inkoop</option>
        <option value="klantenservice">Klantenservice</option>
        <option value="groen">Groen</option>
    </select><br>
    <button type="submit" name="add_task">Toevoegen</button>
</form>