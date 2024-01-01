<?php
session_start();
require_once 'php/db.php';
$login = $_SESSION['login'];

$sql = "SELECT time FROM bonuses WHERE login_account_id=? ORDER BY time DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();
$last_time = $result->fetch_assoc()['time'];

if ($result->num_rows > 0) {
    $current_time = date('Y-m-d H:i:s');
    $time_diff = strtotime($current_time) - strtotime($last_time);
    if ($time_diff >= 86400) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $account = rand(1, 7);
            $time = date('Y-m-d H:i:s');

            $sql = "INSERT INTO bonuses (login_account_id, time, Bonus) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $login, $time, $account);
            $stmt->execute();

            $sql = "UPDATE users SET account=account+? WHERE login=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $account, $login);
            $stmt->execute();

            echo "<pre>Ваш бонус: $account Время получения : $time </pre>";
        } else {
            echo '<form method="post" action="bonus.php"><button type="submit" value="Активировать бонус" class="button_activate_bonus">Активировать бонус</button></form>';
        }
    } else {
        $time_remaining = 86400 - $time_diff;
        echo "Доступно через: <span id='countdown'></span>";
        echo "<script>
                var timeLeft = $time_remaining;
                var countdown = document.getElementById('countdown');
                function updateCountdown() {
                    if (timeLeft > 0) {
                        countdown.innerHTML = new Date(timeLeft * 1000).toISOString().substr(11, 8);
                        timeLeft--;
                        setTimeout(updateCountdown, 1000);
                    }
                }
                updateCountdown();
            </script>";
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $account = rand(1, 7);
        $time = date('Y-m-d H:i:s');

        $sql = "INSERT INTO bonuses (login_account_id, time, Bonus) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $login, $time, $account);
        $stmt->execute();

        $sql = "UPDATE users SET account=account+? WHERE login=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $account, $login);
        $stmt->execute();

        echo "<pre>Ваш бонус: $account Время получения : $time </pre>";
    } else {
        echo '<form method="post" action="bonus.php"><button type="submit" value="Активировать бонус" class="button_activate_bonus">Активировать бонус</button></form>';
    }
}
$conn->close();
?>