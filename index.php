<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<body>
    
    <div class="container">


    <?php foreach ($tasks as $task): ?>
    <tr>
        <td><?= $task['title'] ?></td>
        <td><?= $task['description'] ?></td>
        <td><?= $task['department'] ?></td>
        <td><?= $task['status'] ?></td>
        <td>
            <a href="?delete=<?= $task['id'] ?>">Verwijderen</a>
            <form method="POST" style="display:inline;">
                <input te="type="hidden"  name="id" value="<?= $task['id'] ?>">
                <input typext" name="title" value="<?= $task['title'] ?>">
                <input type="text" name="description" value="<?= $task['description'] ?>">
                <select name="department">
                    <option value="personeel">Personeel</option>
                    <              <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</ooption value="horeca">Horeca</option>
                </select>
                <select name="status">
                    <option value="todo">Todo</option>
                    <option value="done">Done</option>
                </select>
                <button type="submit" name="update_task">Bewerken</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>


    </div>

</body>

</html>
