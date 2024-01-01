<?php
session_start();
require_once('php/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $referralCode = $_POST['referral'];
    $registrationTime = date('Y-m-d H:i:s');
    $percent = 1;
    $checkUserQuery = "SELECT * FROM users WHERE login = '$login' OR email = '$email'";
    $checkUserResult = $conn->query($checkUserQuery);
    if ($checkUserResult->num_rows > 0) {
        echo "<script>
        var result = confirm('Пользователь с таким логином или адресом электронной почты уже существует!');
        if (result) {
          window.location.href = 'register.php'; 
        }
      </script>
       ";


        exit();
    }
    if (!empty($referralCode)) {
        $referralQuery = "SELECT * FROM users WHERE referral_code = '$referralCode'";
        $referralResult = $conn->query($referralQuery);
        if ($referralResult->num_rows > 0) {
            $referralUser = $referralResult->fetch_assoc();
            $referralUserId = $referralUser['id'];
            $updateBalanceQuery = "UPDATE users SET account = account + 20 WHERE id = '$referralUserId'";
            $conn->query($updateBalanceQuery);
        }
        $account = (!empty($referralCode)) ? 15 : 0;
    } else {
        $account = 0;
    }
    $percent = 1;
    $referralCode = generateReferralCode($login);

    $insertUserQuery = "INSERT INTO users (login, email, password, account, registration_time, referral_code, percent, currentTime)
                        VALUES ('$login', '$email', '$password', '$account', '$registrationTime', '$referralCode', 1, 0)";
    $conn->query($insertUserQuery);
    $conn->close();

    $_SESSION['login'] = $userData['login'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION['password'] = $userData['password'];
    $_SESSION['registration_time'] = $userData['registration_time'];
    $_SESSION['percent'] = $userData['percent'];
    $_SESSION['currentTime'] = $userData['currentTime'];
    $_SESSION['referral_code'] = $referralCode;
    $_SESSION['account'] = $userData['account'];
    header('Location: index.php');
    exit();

}
function generateReferralCode($login)
{
    $randomDigits = mt_rand(1000, 9999);
    return $login . $randomDigits;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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

<body>
    <form action="register.php" method="POST" autocomplete="off">
        <h1 style="text-align:center;  color: rgb(233, 233, 233);">Регистрация</h1>
        <label for="login">Логин:</label>
        <input type="text" name="login" required autocomplete="off">
        <br>
        <input type="password" id="password" name="password" autocomplete="off"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Должно содержать по крайней мере одно число, одну заглавную и строчную буквы, а также не менее 8 и более символов"
            required>
        <br>
        <input type="checkbox" onclick="ShowPassword()" style="margin-left: -14vw;" autocomplete="off">
        <p style="color: white; margin-top:-5.3vh; margin-left:2vw;"> Показать пароль</p> <br>
        <label for="email">Эл.почта:</label>
        <input type="email" name="email" required autocomplete="off">
        <br>
        <label for="referral">Реферал (если есть):</label>
        <input type="text" id="referral" name="referral">
        <br>
        <input type="checkbox" name="privacy_policy" required class="privacy_policy_checkbox" autocomplete="off">
        <label class="label_for_privacy_policy_checkbox" for="privacy_policy">Я согласен с политикой
            конфиденциальности</label>

        <input type="submit" value="Зарегистрироваться" style="background-color: #558cb7; color:white">
    </form>
    <div class="block_for_login_page_url">
        <h4 style="text-align:center; color: rgb(233, 233, 233);">Уже зарегистрированы? <a href="login.php"
                style="text-decoration:none;color: #558cb7;">Войдите</a>
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