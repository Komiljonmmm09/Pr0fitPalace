<?php
require_once('php/db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) || empty($password)) {
        echo "Заполните все поля";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE (login = :login OR email = :login) AND password = :password");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['login'] = $userData['login'];
            $_SESSION['email'] = $userData['email'];
            $_SESSION['password'] = $userData['password'];
            $_SESSION['registration_time'] = $userData['registration_time'];
            $_SESSION['percent'] = $userData['percent'];
            $_SESSION['referral_code'] = $referralCode;
            $_SESSION['account'] = $userData['account'];
            header("Location: index.php");
            exit();
        } else {
            echo '<script>alert("Неправильный логин, email или пароль!");</script>';
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация </title>
    <style>
        :not(:defined) {
            color: rgb(233, 233, 233);
        }

        h3 {
            color: rgb(233, 233, 233);
        }

        body {
            background-color: black;
            user-select: none;
        }

        form {
            box-shadow: 0px 0px 37px 18px rgba(34, 60, 80, 0.2);
            width: 30vw;
            margin: auto;
            background-color: #212121;
            padding: 30px;
        }

        .block_for_login_page_url {
            margin: auto;
            background-color: #212121;
            margin-top: 2vh;
            width: 30vw;
            padding: 30px;
            padding-top: .1vh;
            padding-bottom: .1vh;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #141414;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
        }

        button {
            border: none;
            outline: none;
            cursor: pointer;
            color: rgb(49, 49, 49);
            border-radius: 2px;
            font-size: 22px;
            width: 35%;
            height: 6.7vh;
            left: 60%;
        }

        label {
            color: #f1f1f1;
        }

        .container {
            background-color: #000000;
            padding: 20px;
            margin: auto;
            top: 10vh;
            position: relative;
            height: auto;
        }

        .privacy_policy_checkbox {
            position: relative;
            left: -14vw;
            top: 5.1vh;
        }

        .label_for_privacy_policy_checkbox {
            margin-left: 2vw;

        }

        footer {
            display: flex;
            justify-content: center;
            margin-top: 5vh;
        }

        .footer_links {
            line-height: 16px;
            color: #8d97a0;
            font-size: 14px;
            font-family: "-apple-system", BlinkMacSystemFont, Arial, sans-serif;
            white-space: nowrap;
            margin: 0 24px 16px 0;
            text-decoration: none;
        }
    </style>
</head>
</head>

<body>
    <div style="height:10vh"></div>
    <form method="post" action="login.php">
        <h1 style="text-align:center;  color: rgb(233, 233, 233);">Авторизация</h1>
        <label for="login">Ваш логин или Email:</label>
        <input type="text" id="login" name="login" required><br><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="checkbox" onclick="ShowPassword()" style="margin-left: -14vw;" autocomplete="off">
        <p style="color: white; margin-top:-5.3vh; margin-left:2vw;"> Показать пароль</p> <br>
        <input type="submit" value="Войти" style="background-color: #558cb7; color:white">
    </form>
    <div class="block_for_login_page_url">
        <h4 style="text-align:center; color: rgb(233, 233, 233);">Ещё нет аккаунта? <a href="register.php"
                style="text-decoration:none;color: #558cb7;">Зарегистрируйтесь</a>
        </h4>
    </div>
    <footer>
        <div style="height:28px;position: relative;"></div>
        <a href="#" class="footer_links">Русский</a>
        <a href="#" class="footer_links">О сервисе</a>
        <a href="#" class="footer_links">Обратная связь</a>
        <a href="#" class="footer_links">Соглашение </a>
    </footer>
    <script>
        function ShowPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>