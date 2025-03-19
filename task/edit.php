<?php include '../head.php'; ?>
<body>
    <?php include '.../header.php'; ?>
    <form action="../app/Http/Controllers/takenController.php" method="post">
    <input type="hidden" name="action" value="create">

    <div class="form-group">
                <label for="titel">Titel:</label>
                <input type="text" name="titel" id="titel" class="form-input">
            </div>

            <div class="form-group">
                <label for="afdeling">afdeling</label>
                <select name="type">
                    <option value="personeel">Achtbaan</option>
                    <option value="horeca">Draaiend</option>
                    <option value="techniek">Kinder</option>
                    <option value="inkoop">Horeca</option>
                    <option value="klantenservice">Show</option>
                    <option value="groen">Water</option>
                </select>
                </div>

            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input">
            </div>
    </form>
</body>
</html>