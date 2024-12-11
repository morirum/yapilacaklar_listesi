<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <a href="giris_yap.php" class="nav-button">Giriş Yap</a>
            <a href="uye_ol.php" class="nav-button">Üye Ol</a>
        </div>
        <div class="nav-right">
            <img src="logo.png" alt="Logo" class="logo"> <!-- Logo yerleştir -->
        </div>
    </nav>

    <div class="content">
        <h1>Yapılacaklar Listesi Uygulaması</h1>
        <p>Giriş yapmadığınız için yapılan tasarımların sadece görünüşü gösterilmektedir.</p>
        <p>Giriş yaptıktan sonra yapacaklar listenizi oluşturabilirsiniz!</p>



        <form method="POST" class="task-form">
            <input type="text" name="task" placeholder="Yeni görev ekleyin" required>
            <button type="submit">Görev Ekle</button>
        </form>

        <?php
        // Görev listesi için oturum başlat
        if (!isset($_SESSION['tasks'])) {
            $_SESSION['tasks'] = [];
        }

        // Yeni görev ekleme
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
            $_SESSION['tasks'][] = [
                'name' => htmlspecialchars($_POST['task']),
                'completed' => false
            ];
        }




        // Görev listesi için oturum başlat
        if (!isset($_SESSION['tasks'])) {
            $_SESSION['tasks'] = [];
        }

        // Yeni görev ekleme
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
            $_SESSION['tasks'][] = [
                'name' => htmlspecialchars($_POST['task']),
                'completed' => false
            ];
        }

        // Görev işlemleri (tamamla/sil)
        if (isset($_GET['action'], $_GET['index'])) {
            $index = (int)$_GET['index'];
            if ($_GET['action'] === 'delete') {
                unset($_SESSION['tasks'][$index]);
            } elseif ($_GET['action'] === 'toggle') {
                $_SESSION['tasks'][$index]['completed'] = !$_SESSION['tasks'][$index]['completed'];
            }
            $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Dizinleri yeniden düzenle
        }



foreach ($_SESSION['tasks'] as $index => $task) {
    echo '<table class="task-table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Sil</th>';
    echo '<th>Durum</th>';
    echo '<th>Görev</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    foreach ($_SESSION['tasks'] as $index => $task) {
        echo '<tr>';
        
        // Çöp kovası simgesi (silme butonu)
        echo '<td><a href="?action=delete&index=' . $index . '" class="delete-btn" style="color: red;">🗑️</a></td>';
        
        // Durum butonu (çarpı ve tik işareti)
        echo '<td>';
        echo '<a href="?action=toggle&index=' . $index . '" class="toggle-btn" style="color: red;">❌</a>'; 
        echo '<a href="?action=toggle&index=' . $index . '" class="toggle-btn" style="color: green;">✔️</a>'; 
        echo '</td>';
        
        // Görev adı
        echo '<td><span class="' . ($task['completed'] ? 'completed' : '') . '">' . 
            ($task['completed'] ? '<s>' . $task['name'] . '</s>' : $task['name']) . 
            '</span></td>';
        
        echo '</tr>';
    }
    
            echo '</tbody>';
            echo '</table>';
 
    }
    ?>




    </div>
</body>
</html>