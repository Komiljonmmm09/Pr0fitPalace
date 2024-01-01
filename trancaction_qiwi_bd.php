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
$amount = $conn->real_escape_string($_REQUEST['amount']);
$kiwi_wallet_number = $conn->real_escape_string($_REQUEST['kiwi_wallet_number']);

if ($account < $amount) {
    echo "Недостаточно средств для вывода средств.";
    echo "'<br>'";
    echo "<a href='index.php'>На главную страницу </a>";

    exit();
}

$sql = "INSERT INTO transactions_qiwi (phone_number, kiwi_wallet_number, amount, login) VALUES ('$phone_number','$kiwi_wallet_number' ,'$amount', '$login')";

if ($conn->query($sql) === TRUE) {
    echo "Данные успешно вставлены в базу данных.";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>