<?php
include 'gorev_guncelle.php';
?>

<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_name'])) {
    $user_id = $_SESSION['user_id'];
    $task_name = $_POST['task_name'];
    $task_number = $_POST['task_number'];

    $sql = "INSERT INTO tasks (user_id, task_number, task_name, is_completed) VALUES ($user_id, $task_number, '$task_name', 0)";
    mysqli_query($conn, $sql);
    header("Location: create_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev Listesi Oluştur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Görev Listesi Oluştur</h2>
    <form method="POST" action="create_list.php">
        <input type="number" name="task_number" placeholder="Görev Sayısı" required>
        <input type="text" name="task_name" placeholder="Görev Adı" required>
        <button type="submit">Görev Ekle</button>
    </form>

    <div class="todo-table">
        <table>
            <thead>
                <tr>
                    <th>Görev Sayısı</th>
                    <th>Yapılacak Görev</th>
                    <th>Yapıldı</th>
                    <th>Yapılmadı</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['user_id'];
                $result = mysqli_query($conn, "SELECT * FROM tasks WHERE user_id = $user_id");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['task_number']}</td>";
                    echo "<td>{$row['task_name']}</td>";
                    echo "<td><a href='update_task.php?id={$row['id']}&status=1'>✔</a></td>";
                    echo "<td><a href='update_task.php?id={$row['id']}&status=0'>✘</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
