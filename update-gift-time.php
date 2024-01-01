<?php
session_start();
require_once('php/db.php');

if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];

    $stmt = $conn->prepare("SELECT * FROM gifts WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        echo "Вы уже получили подарок!";
    } else {
        $currentTime = time();
        $stmt = $conn->prepare("INSERT INTO gifts (login, gift_received_time) VALUES (:login, :gift_received_time)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':gift_received_time', $currentTime);
        $stmt->execute();

        echo "Поздравляем! Вы получили подарок!";
    }
} else {
    http_response_code(403);
    echo "Пользователь не авторизован";
}
?>