<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
 
   header("Location: login.php"); // Kullanıcı giriş yapmamışsa login.php sayfasına yönlendirilir
   exit(); // Yönlendirme sonrası kod çalışmasını durdurur
}
?>