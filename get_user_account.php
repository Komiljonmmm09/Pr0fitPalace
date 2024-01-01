<?php
session_start();
require_once('php/db_pdo.php');

if (isset($_SESSION['login'], $_SESSION['email'])) {
    $login = $_SESSION['login'];
    $email = $_SESSION['email'];

    $currentTime = time();
    $lastGiftTime = $_SESSION['last_gift_time'] ?? 0;

    $timeSinceLastGift = $currentTime - $lastGiftTime;

    if ($timeSinceLastGift >= 86400) {
        $giftNumbers = array(1, 1, 1, 5, 1, 1, 1, 1, 1, 10, 2, 15, 2, 15, 10, 15, 20, 10, 20, 10, 1, 1, 2, 1, 2, 100);
        $randomGift = $giftNumbers[array_rand($giftNumbers)];
        $updateBalanceQuery = "UPDATE users SET account = account + $randomGift WHERE login = '$login' OR email = '$email'";
        $conn->query($updateBalanceQuery);
        $_SESSION['last_gift_time'] = $currentTime;
        echo json_encode([
            'giftReceived' => true,
            'giftAmount' => $randomGift,
            'nextGiftTime' => $lastGiftTime + 86400
        ]);
    } else {
        $timeUntilNextGift = $lastGiftTime + 86400 - $currentTime;
        echo json_encode([
            'giftReceived' => false,
            'timeUntilNextGift' => formatTime($timeUntilNextGift)
        ]);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'Session data not set']);
}

function formatTime($seconds)
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    return "$hours:$minutes:00";
}
?>