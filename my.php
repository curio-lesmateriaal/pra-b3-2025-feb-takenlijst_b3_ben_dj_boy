<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}

require_once __DIR__ . '/../backend/config.php';
require_once __DIR__ . '/../backend/conn.php';
?>

<!DOCTYPE html>
<html lang="nl">

<?php require_once '../head.php'; ?>
<?php require_once '../header.php'; ?>

<body>
<div class="container">
    <h1>Mijn Taken</h1>

    <?php
    $user_id = intval($_SESSION['user_id']);

    $sql = "SELECT titel, beschrijving, afdeling, status, deadline
            FROM taken 
            WHERE user = :user_id 
            ORDER BY deadline ASC";

    $statement = $conn->prepare($sql);
    $statement->execute(['user_id' => $user_id]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Afdeling</th>
                <th>Status</th>
                <th>Deadline</th>
              </tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["titel"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["beschrijving"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["afdeling"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["deadline"]) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Geen taken gevonden.</p>";
    }
    ?>
</div>
</body>

</html>
