<?php
$host = 'localhost';
$dbname = 'ProfitPalace.ru';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $dbname);
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
} ?>