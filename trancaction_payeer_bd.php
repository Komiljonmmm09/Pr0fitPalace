<?php
session_start();
$login = $_SESSION['login'];
$account = $_SESSION['account'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ProfitPalace.ru";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$phone_number = $conn->real_escape_string($_REQUEST['phone_number']);
$card_number = $conn->real_escape_string($_REQUEST['card_number']);
$amount = $conn->real_escape_string($_REQUEST['amount']);

if ($account < $amount) {
    echo "Недостаточно средств для вывода средств.";
    exit();
}
$sql = "INSERT INTO transactions_payeer (phone_number, Receivers_wallet, amount, login) VALUES ('$phone_number', '$card_number', '$amount', '$login')";

if ($conn->query($sql) === TRUE) {
    echo "Данные успешно вставлены в базу данных.";
    echo "<br>";
    echo "<a href='index.php'>На главную страницу </a>";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>