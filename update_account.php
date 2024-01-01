<?php
session_start();
require_once('php/db.php');

if (isset($_POST['login']) && isset($_POST['newAccount'])) {
    $login = $_POST['login'];
    $newAccountValue = $_POST['newAccount'];
    $updateSql = "UPDATE users SET account = $newAccountValue WHERE login='$login'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Account updated successfully";
    } else {
        echo "Error updating account: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
$conn->close();
?>