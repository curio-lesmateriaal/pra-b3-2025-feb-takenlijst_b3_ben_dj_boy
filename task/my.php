<?php require_once __DIR__ . '/../backend/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php require_once '../head.php'; ?>


<?php require_once '../header.php'; ?>

<?php


    if (isset($_SESSION['user_id'])) {
        $user_id = intval($_SESSION['user_id']); // veilig integer maken

        // Query om alleen de taken op te halen van de ingelogde gebruiker
        $sql = "SELECT titel, beschrijving, afdeling, status, deadline, created_at 
                FROM taken 
                WHERE user = $user_id 
                ORDER BY deadline ASC";

        $result = $conn->query($sql);

        echo "<h1>Mijn Taken</h1>";

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["titel"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["beschrijving"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["afdeling"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["deadline"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } elseif (empty($_SESSION['user_id'])); {
            echo "Je bent niet ingelogd";
        }
