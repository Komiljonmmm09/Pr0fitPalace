<?php
session_start();
require_once('php/db.php');

if (isset($_SESSION['login'], $_SESSION['email'], $_SESSION['password'], $_SESSION['registration_time'])) {
    $login = $_SESSION['login'];
    $timestamp = $_SESSION['registration_time'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $percent = $_SESSION['percent'];
    $account = $_SESSION['account'];

    if (isset($login) || isset($email)) {
        $sql = "SELECT account FROM users WHERE login = '$login' OR email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $foundAccount = $row['account'];
        }
    }
    $sql = "SELECT id, referral_code, currentTime FROM users WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['id'];
            $currentTime = $row['currentTime'];
            $referral_code = $row['referral_code'];
        }
    }
    $receivedTime = date('Y-m-d H:i:s');

} else {
    header('Location: start.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/index.css">
    <title>ProfitPalace ||
        <?php echo $login ?>
    </title>
    <style>
        footer {
            height: 40px;
        }

        #countdown {
            font-size: 27px;
        }

        footer h3 {
            word-wrap: nowrap;
            margin-top: 10px;
        }

        .button_activate_bonus {
            background-color: rgba(0, 0, 0, 0);
            border: none;
            margin-left: 43vw;
            margin-top: 10vh;
        }

        .content-paysystems>a {
            text-decoration: none;
            color: rgb(233, 233, 233);
        }

        @import url('https://fonts.googleapis.com/css?family=Exo:400,700');

        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: 'Exo', sans-serif;
            user-select: none;
        }


        .context {
            width: 100%;
            position: fixed;
            top: 50vh;

        }

        .context h1 {
            text-align: center;
            color: #fff;
            font-size: 50px;
        }


        .area {
            background: #4e54c8;
            background: -webkit-linear-gradient(to left, #8f94fb, #4e54c8);
            width: 100%;
            height: 100vh;


        }

        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 25s linear infinite;
            bottom: -150px;

        }

        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }


        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }

        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .circles li:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }

        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .circles li:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }

        .circles li:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }

        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }

        @keyframes animate {

            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }

        }

        #creditCardForm {
            max-width: 400px;
            margin-top: -97vh;
            margin-left: 32vw;
            background-color: rgba(0, 0, 0, 0.815);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8.9px);
            -webkit-backdrop-filter: blur(8.9px);
            border: 1px solid rgba(255, 255, 255, 0.19);
            padding: 20px;
            position: relative;
            z-index: 2;
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }

        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            border: solid 0.03px white;
            animation: bounce 1s infinite alternate;
            z-index: -1;
        }



        .input-container {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        input {
            width: calc(100% - 40px);
            padding: 10px;
            margin-top: 20px;
            color: #ff0000a6;
            border: none;
            border-bottom: 2px solid #00f7ff80;
            outline: none;
            font-size: 16px;
            background-color: transparent;

        }

        .card-icon {
            position: absolute;
            top: 30px;
            right: 10px;
            width: 24px;
            height: 24px;
            background-size: contain;
        }

        label {
            position: absolute;
            top: 20px;
            left: 10px;
            pointer-events: none;
            color: #00ffffb7;
            transition: 0.3s ease-out;
        }

        input:focus+label,
        input:valid+label {
            top: 0;
            font-size: 12px;
            color: #ff0000a6;
        }

        input:focus {
            border-bottom: 2px solid #ff0000a6;
        }

        #submitBtn {
            width: 70%;
            padding: 12px;
            background-color: #4caf50;
            color: #ffffff;
            cursor: pointer;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        #submitBtn:hover {
            background-color: #45a049;
        }

        #creditCardForm h2 {
            text-align: center;
            color: #cfcfcf;
        }

        @media (max-width: 600px) {
            .circle {
                display: none;
            }
        }

        .container_content-paysystems {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
            grid-auto-columns: 1fr;
            gap: 3px 0px;
            grid-auto-flow: row;
            grid-template-areas:
                "content-paysystems content-paysystems-forms";
        }

        .content-paysystems {
            grid-area: content-paysystems;
        }

        .content-paysystems-forms {
            grid-area: content-paysystems-forms;
        }

        .content-paysystem {
            margin-top: 18px;
        }

        .content-paysystem {
            max-width: 655px;
            min-height: 105px;
            background-color: rgb(14, 14, 14);
            border-radius: 10px;
            padding-top: 12px;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            color: #d3d3d3;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.267);
        }

        .content-paysystem:hover {
            transition: 0.25s;
            background-color: rgb(29, 29, 29);
        }

        .content-paysystem:active {
            transition: 0.15s;
            background-color: rgb(48, 48, 48)
        }

        .paysystem-icon {
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100% 100%;
            min-width: 58px;
            min-height: 59px;
        }

        .paysystem-info {
            margin-left: 15px;
        }

        .paysystem-info-title {
            font-size: 23px;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
        }

        .paysystem-info-desc {
            margin-top: 3px;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            max-width: 375px;
        }

        .cancel_button {
            width: 90%;
            margin-left: 5%;
            background-color: #5b0eeb;
            margin-top: 4vh;
            border: none;
            color: white;
            font-size: 24px;
            border-radius: 30px;
            box-shadow: rgba(189, 0, 0, 0.1) 0px 4px 12px;
            padding: 6px 0 6px 0px;
            transition: all .2s;
        }

        .cancel_button:hover {
            background-color: #6d5dfc;
        }

        .info_user_block {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            background-color: #212121;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
            margin-top: 10px;
            border-radius: 30px;
            width: 100%;
            height: 10vh;
            max-height: 10vh;
        }

        .info_user_block h3 {
            margin-top: .7vh;
        }

        .info_user_block h4 {
            margin-top: .7vh;
        }

        .info_user_block h3,
        h4 {
            margin-left: .8vh;
        }

        #succes_copy {
            position: absolute;
            width: 250px;
            height: 60px;
            border-radius: 20px;
            background-color: #3cc762;
            color: white;
            padding: 10px;
            margin-top: 65vh;
            animation: .7s rrrrrrrr;
            animation-fill-mode: forwards;
        }

        @keyframes rrrrrrrr {
            from {
                left: -10vh;
                opacity: 0;
            }

            to {
                left: 0vh;
                opacity: 1;
            }
        }

        #succes_copy h2 {
            position: relative;
            font-size: 24px;
            margin-top: 1px;
            text-align: center;
        }

        #succes_copy h3 {
            position: relative;
            margin-top: -5px;
            font-size: 18px;
            text-align: center;
        }

        .about_page .ceneter {
            position: relative;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            background-color: #0d0c0c;
            border-radius: 30px;
            margin-left: .3vw;
            padding-top: 40px;
            padding-bottom: 60px;
            width: 95vw;
            box-shadow: rgba(255, 255, 255, 0.24) 0px 3px 8px;
        }

        .withdraw_money {
            background-color: #3cc762;
        }

        .about_page .ceneter h3 {
            color: rgb(233, 233, 233);
        }

        #myFrame {
            margin-top: 10vh;
            height: 300vh;
        }
    </style>

</head>

<body>
    <header>
        <nav>
            <a href="index.php">
                <h1>Logo</h1>
            </a>
            <a onclick="open_user_page()" id="user_page_button"
                style="color:rgb(0, 255, 0);white-space: nowrap; margin-left:-30px;">
                Личний кабинет </a>
            <a onclick="open_bonus_page()" id="bonus_page_button"> Бонус</a>
            <a onclick="open_about_page()" id="about_page_button" style="white-space: nowrap;">О нас </a>
            <a onclick="open_static_page()" id="static_page_button">Статистика</a>
            <a onclick="open_contacts_page()" id="contacts_page_button" style="white-space: nowrap;">Наши контакты</a>
            <a href="https://t.me/Pr0fitPalace">TELEGRAM ЧАТ</a>
            <a href="logout.php" style="margin-left:45px;">
                <svg fill="#ffffff" height="34px" width="34px" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="-11.55 -11.55 408.07 408.07" xml:space="preserve" stroke="#ffffff"
                    stroke-width="14.628898000000001">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g id="Sign_Out">
                                <path
                                    d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03 C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03 C192.485,366.299,187.095,360.91,180.455,360.91z">
                                </path>
                                <path
                                    d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279 c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179 c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z">
                                </path>
                            </g>
                            <g> </g>
                            <g> </g>
                            <g> </g>
                            <g> </g>
                            <g> </g>
                            <g> </g>
                        </g>
                    </g>
                </svg></a>
        </nav>
    </header>
    <div class="home_page_block" id="home_page_block">
        <div style="height:10vh"></div>
        <div class="main_in_user_page1">
            <div class="title_for_main_in_user_page">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <h1>Личный кабинет,
                    <?php echo $login ?>!
                </h1>

            </div>
            <div class="photo_in_home_page_user_page">
                <div class="img_for_home_page_header_block_in_user_page">
                    <img src="assets/img/slide1-person.png" alt="">
                </div>
                <div class="text_for_home_page_in_user_page"></div>
            </div>
            <div class="block_for_-my_earnings">
                <h1>
                    Мой заработок:
                </h1>
                <div id="error_for_insufficient_funds"></div>
                <div id="account">
                </div>
                <div style="height:30px;"></div>
                <a onclick="openWithdrawMoneyPage()" class="withdraw_money" id="withdraw_money">Вывести
                    Заработок</a>
            </div>
            <div class="block_for_top_up_your-balance">
                <div class="info_user_block" onclick="copyVariableToClipboard('<?php echo $email; ?>')">
                    <svg style="margin-top:-.3vh;" width="64px" height="64px" style="margin-top:2vh;"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.75 5.25L3 6V18L3.75 18.75H20.25L21 18V6L20.25 5.25H3.75ZM4.5 7.6955V17.25H19.5V7.69525L11.9999 14.5136L4.5 7.6955ZM18.3099 6.75H5.68986L11.9999 12.4864L18.3099 6.75Z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                    <div class="name_and_tetle_for_info_user_block">
                        <h3>Ваш Email</h3>
                        <h4>
                            <?php echo $email ?>
                        </h4>
                    </div>
                </div>
                <div class="info_user_block" onclick="copyVariableToClipboard('<?php echo $login; ?>')">
                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <circle cx="12" cy="6" r="4" stroke="#ffffff" stroke-width="1.5"></circle>
                            <path
                                d="M15 20.6151C14.0907 20.8619 13.0736 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C15.866 13 19 14.7909 19 17C19 17.3453 18.9234 17.6804 18.7795 18"
                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                    <div class="name_and_tetle_for_info_user_block">
                        <h3>Ваш Login</h3>
                        <h4>
                            <?php echo $login ?>
                        </h4>
                    </div>
                </div>
                <div class="info_user_block" onclick="copyVariableToClipboard('<?php echo $user_id; ?>')">
                    <svg width="64px" height="64px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                        class="iconify iconify--emojione-monotone" preserveAspectRatio="xMidYMid meet" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M39 19.434h-5.384v25.133H39c2.969 0 5.386-2.322 5.386-5.174V24.609c0-2.853-2.417-5.175-5.386-5.175"
                                fill="#ffffff"></path>
                            <path
                                d="M52 2H12C6.477 2 2 6.477 2 12v40c0 5.523 4.477 10 10 10h40c5.523 0 10-4.477 10-10V12c0-5.523-4.477-10-10-10M23 49h-4V15h4v34m26-9.607a9.251 9.251 0 0 1-.787 3.738a9.592 9.592 0 0 1-2.143 3.055a10.032 10.032 0 0 1-3.178 2.059A10.302 10.302 0 0 1 39 49H29V15h10c1.348 0 2.657.254 3.893.754c1.19.484 2.26 1.176 3.178 2.059s1.638 1.912 2.143 3.053A9.294 9.294 0 0 1 49 24.609v14.784"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                    <div class="name_and_tetle_for_info_user_block">
                        <h3>Ваш ID</h3>
                        <h4>
                            <?php echo $user_id ?>
                        </h4>
                    </div>
                </div>
                <div class="info_user_block" onclick="copyVariableToClipboard('<?php echo $referral_code; ?>')">
                    <svg fill="#ffffff" width="64px" height="64px" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M20,18a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1H13V9.858a4,4,0,1,0-2,0V12H4a1,1,0,0,0-1,1v4a1,1,0,0,0,2,0V14h6v3a1,1,0,0,0,2,0V14h6v3A1,1,0,0,0,20,18ZM12,8a2,2,0,1,1,2-2A2,2,0,0,1,12,8ZM23,21a1,1,0,0,1-1,1H18a1,1,0,0,1,0-2h4A1,1,0,0,1,23,21ZM1,21a1,1,0,0,1,1-1H6a1,1,0,0,1,0,2H2A1,1,0,0,1,1,21Zm13-1a1,1,0,0,1,0,2H10a1,1,0,0,1,0-2Z">
                            </path>
                        </g>
                    </svg>
                    <div class="name_and_tetle_for_info_user_block">
                        <h3>Ваш реферал для приглашение </h3>
                        <h4>
                            <?php echo $referral_code ?>
                        </h4>
                    </div>
                </div>
                <div class="info_user_block" onclick="copyVariableToClipboard('<?php echo $timestamp; ?>')">
                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        stroke="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M12 8V12L15 15" stroke="#ffffff" stroke-width="2" stroke-linecap="round">
                            </path>
                            <circle cx="12" cy="12" r="9" stroke="#ffffff" stroke-width="2"></circle>
                        </g>
                    </svg>
                    <div class="name_and_tetle_for_info_user_block">
                        <h3>Дата регистрации </h3>
                        <h4>
                            <?php echo $timestamp ?>
                        </h4>
                    </div>
                </div>
                <a href="top_up_your_balance.html" class="top_up_your_balance">Пополнить </a>

                <div id="succes_copy" style="display:none">
                    <h2>Копирование </h2>
                    <h3>Успешно скопирован</h3>
                </div>
            </div>

        </div>
        <p class="arrow_down">▼</p>
        <!-- Другие о сервисе -->
        <div class="container_others">
            <div class="main_2_block_in_main_2" style=" margin-top: 210px;">
                <div class="main_2_photo_img">
                    <img src="assets/img/molnia-1.png" alt="">

                </div>
                <div class="text_main_2">
                    <h1>Что такое ProfitPalace? </h1>
                    <h3>ProfitPalace - уникальное приложение, которое монетизирует твой неиспользуемый
                        Интернет-трафик,
                        помогая различным компаниям участвовать в различных исследованиях.</h3>
                </div>
            </div>
            <div class="main_2_1_block_in_main_2">
                <div class="for_title_in_main_2_block">
                    <h1>А сколько можно заработать?</h1>
                    <h3>Заработок зависит от множества параметров: от вашего местоположения, провайдера,
                        потребностей
                        наших
                        партнеров и непосредственно от вас.</h3>
                </div>
                <div class="for_img_im_main_2_block"> <img src="assets/img/block-2.png" alt=""></div>
            </div>
        </div>

        <div class="container_others" style="margin-top:-15vh;">
            <div class="main_2_1_block_in_main_2">
                <div class="for_title_in_main_2_block">
                    <h1>А сколько можно заработать?</h1>
                    <h3>Заработок зависит от множества параметров: от вашего местоположения, провайдера,
                        потребностей
                        наших
                        партнеров и непосредственно от вас.</h3>
                </div>
                <div class="for_img_im_main_2_block"> <img src="assets/img/block-2.png" alt=""></div>
            </div>

            <div class="main_2_block_in_main_2" style="opacity: 1; margin-left:2.5%">
                <div class="main_2_photo_img">
                    <img src="assets/img/block-3.png" alt="">
                </div>
                <div class="text_main_2">
                    <h1>Абсолютно пассивно</h1>
                    <h3>Пока вы работаете или занимаетесь своими делами, происходит настоящее чудо - "ProfitPalace"
                        зарабатывает для вас реальные деньги, которые можно вывести сразу</h3>
                </div>
            </div>
        </div>
        <h3 style="text-align:center; margin-top:-300px">Выводить средства можно на самые популярные платежные
            системы
            автоматически, в течение пары минут без ограничений.</h3>
        <section class="payout_section">
            <div class="logo_banks"><img src="assets/img/sbrf.png" alt="">
                <h1>Сбербанк(РФ) </h1>
            </div>
            <div class="logo_banks"><img src="assets/img/qiwi.png" alt="">
                <h1>QIWI-кошелек</h1>
            </div>
            <div class="logo_banks"><img src="assets/img/Payeer.png" alt="">
                <h1>Payeer</h1>
            </div>
            <div class="logo_banks"><img src="assets/img/dc_logo.png" alt="">
                <h1>DCity</h1>
            </div>
        </section>
        <section class="payout_section">
            <h1 style="text-align:center">Для более эффективного заработка, рекомендуйте наше приложение другим
                людям и
                получайте от 15% от их заработка
            </h1>
            <img src="assets/img/persons.png" alt="" style="width:60vw; margin-left:2.5%;">
        </section>
        <pre>

        </pre>
        <h3 style="text-align:center;">Получить ваш реферальный код или ссылку можно в приложении, после регистрации
        </h3>

        <div class="container_others" style="margin-top:15vh;">
            <div class="main_2_1_block_in_main_2" style="opacity: 1; margin-left:2.5%; background-color:white">
                <div class="for_title_in_main_2_block">
                    <h1 style="color:black">Платные услуги
                    </h1>
                    <h3 style="color:black">Нет возможности или желания подключать дополнительные устройства или
                        приглашать
                        людей? Не беда! Наш сервис предлагает покупку множителей или активных рефералов. Обратите
                        внимание -
                        пользоваться платными услугами не обязательно.</h3>
                </div>
                <div class="for_img_im_main_2_block"> <img src="assets/img/ruble-block3.png" alt=""></div>
            </div>
            <div class="main_2_block_in_main_2" style="opacity: 1; margin-left:2.5%; background-color:white">
                <div class="main_2_photo_img">
                    <img src="assets/img/referal-block1.png" alt="" style="width:250px">
                </div>
                <div class="text_main_2">
                    <h1 style="color:black">Реферальная система</h1>
                    <h3 style="color:black">Реферальная система - неотъемлемая часть любого сервиса, мы - не
                        является
                        исключением :) Поэтому, мы
                        очень щедро благодарим пользователей - при приглашении нового человека, вы всегда будете
                        получаеть
                        15% от его заработка. При этом, данная ставка является минимальной и может быть увеличена
                    </h3>
                </div>
            </div>
        </div>
        <pre>

        </pre>
        <h2 style="text-align:center; color:white">Надеемся, что мы вас заинтересовали приложением.
            Скачать, установить и начать зарабатывать очень просто!</h2>
    </div>
    <div id="static_page" class="static_page" style="display:none;">
        <div style="height:15vh"></div>
        <?php
        require_once('php/db.php');
        $sql = "SELECT COUNT(*) FROM users";
        $result = $conn->query($sql);
        $onlineUsers = $result->fetch_row()[0];
        $sql = "SELECT SUM(account) FROM users";
        $result = $conn->query($sql);
        $totalAccount = $result->fetch_row()[0];
        ?>
        <p style="10vh"></p>
        <h3>Количество пользователей:
            <?php echo $onlineUsers; ?>
        </h3>
        <h3>Общая сумма account:
            <?php echo $totalAccount; ?>
        </h3>
        <iframe id="myFrame" src="static_table.php" style="width:100%; overflow: hidden;"></iframe>
        <script>
            function myFunction() {
                var iframe = document.getElementById("myFrame");
                var elmnt = iframe.contentWindow.document.getElementsByTagName("sdfvjhdbfv")[0];
                elmnt.style.display = "none";
            }
        </script>
    </div>
    <div class="1bonus_page" id="1bonus_page" style="display:none">
        <div class="bonus_page">
            <div style="height:10vh"></div>
            <div class="main_bonus_page_1">
                <div class="main_1_left_in_bonus_page">
                    <br>
                    <br>
                    <br>
                    <h1 style="color:#ecb102">
                        Ежедневный подарок
                    </h1><br>
                    <h3>
                        Дорогие друзья! Хотим искреннее вас поблагодарить за участие в нашем проекте за то, что
                        помогаете нам и
                        нашим партнерам.
                    </h3>

                    <br>
                    <h3>И поэтому мы дарим вам подарок <br>каждые 24 часа. Оставайтесь с нами,<br> как можно дольше.
                    </h3>
                </div>
                <h1 class="main_1_right_in_bonus_page_h1">
                    Какой подарок можно получить?
                </h1>
                <div class="main_1_right_in_bonus_page">
                    <div class="main_1_right_in_bonus_page_1">
                        <div class="present_block_in_right_block" style="margin-left: 11vw;">
                            <svg width="84px" height="84px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M3 21H21M3 18H21M5.82333 3.00037C6.2383 3.36683 6.5 3.90285 6.5 4.5C6.5 5.60457 5.60457 6.5 4.5 6.5C3.90285 6.5 3.36683 6.2383 3.00037 5.82333M5.82333 3.00037C5.94144 3 6.06676 3 6.2 3H17.8C17.9332 3 18.0586 3 18.1767 3.00037M5.82333 3.00037C4.94852 3.00308 4.46895 3.02593 4.09202 3.21799C3.71569 3.40973 3.40973 3.71569 3.21799 4.09202C3.02593 4.46895 3.00308 4.94852 3.00037 5.82333M3.00037 5.82333C3 5.94144 3 6.06676 3 6.2V11.8C3 11.9332 3 12.0586 3.00037 12.1767M3.00037 12.1767C3.36683 11.7617 3.90285 11.5 4.5 11.5C5.60457 11.5 6.5 12.3954 6.5 13.5C6.5 14.0971 6.2383 14.6332 5.82333 14.9996M3.00037 12.1767C3.00308 13.0515 3.02593 13.531 3.21799 13.908C3.40973 14.2843 3.71569 14.5903 4.09202 14.782C4.46895 14.9741 4.94852 14.9969 5.82333 14.9996M5.82333 14.9996C5.94144 15 6.06676 15 6.2 15H17.8C17.9332 15 18.0586 15 18.1767 14.9996M21 12.1771C20.6335 11.7619 20.0973 11.5 19.5 11.5C18.3954 11.5 17.5 12.3954 17.5 13.5C17.5 14.0971 17.7617 14.6332 18.1767 14.9996M21 12.1771C21.0004 12.0589 21 11.9334 21 11.8V6.2C21 6.06676 21 5.94144 20.9996 5.82333M21 12.1771C20.9973 13.0516 20.974 13.5311 20.782 13.908C20.5903 14.2843 20.2843 14.5903 19.908 14.782C19.5311 14.9741 19.0515 14.9969 18.1767 14.9996M20.9996 5.82333C20.6332 6.2383 20.0971 6.5 19.5 6.5C18.3954 6.5 17.5 5.60457 17.5 4.5C17.5 3.90285 17.7617 3.36683 18.1767 3.00037M20.9996 5.82333C20.9969 4.94852 20.9741 4.46895 20.782 4.09202C20.5903 3.71569 20.2843 3.40973 19.908 3.21799C19.5311 3.02593 19.0515 3.00308 18.1767 3.00037M14 9C14 10.1046 13.1046 11 12 11C10.8954 11 10 10.1046 10 9C10 7.89543 10.8954 7 12 7C13.1046 7 14 7.89543 14 9Z"
                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                            <h3>Подарочные коины</h3>
                            <h4 style="margin-top:-1vh;"> 1-100₽</h4>
                        </div>
                        <div class="present_block_in_right_block">
                            <svg width="84px" height="84px" viewBox="0 0 24 24" version="1.1" xml:space="preserve"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                fill="#ffffff" stroke="none">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            opacity: 0.2;
                                            fill: none;
                                            stroke: #000000;
                                            stroke-width: 5.000000e-02;
                                            stroke-miterlimit: 10;
                                        }
                                    </style>
                                    <g id="Layer_1"></g>
                                    <g id="Layer_2">
                                        <path
                                            d="M19.5,4h-15C3.1,4,2,5.1,2,6.5v1c0,1.2,0.9,2.2,2,2.4V16c0,2.2,1.8,4,4,4h8c2.2,0,4-1.8,4-4V9.9c1.1-0.2,2-1.2,2-2.4v-1 C22,5.1,20.9,4,19.5,4z M18,16c0,1.1-0.9,2-2,2H8c-1.1,0-2-0.9-2-2v-6h3v4c0,0.3,0.2,0.7,0.5,0.9c0.3,0.2,0.7,0.2,1,0l1.6-0.8 l1.6,0.8C13.7,15,13.8,15,14,15c0.2,0,0.4,0,0.5-0.1c0.3-0.2,0.5-0.5,0.5-0.9v-4h3V16z M11,10h2v2.4l-0.6-0.3 C12.3,12,12.2,12,12,12s-0.3,0-0.4,0.1L11,12.4V10z M20,7.5C20,7.8,19.8,8,19.5,8H19h-5h-4H5H4.5C4.2,8,4,7.8,4,7.5v-1 C4,6.2,4.2,6,4.5,6h15C19.8,6,20,6.2,20,6.5V7.5z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <h3>Скидка на заказ</h3>
                            <h4 style="margin-top:-1vh;">15% - 30%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p style="height:10vh"></p>
        <p style="text-align:center">
        <div class="bonus_image_block" id="activateButton"
            style="display:flex; flex-direction:column; margin-left:20px;">
            <h1 style="color:#ecb102">Ежедневный подарок </h1>
            <h1>
                <?php include 'bonus.php'; ?>
            </h1>
        </div>
        <iframe id="myFrame" src="bonus_table.php" style="width:100%; overflow: hidden;"></iframe>
        <script>
            function myFunction() {
                var iframe = document.getElementById("myFrame");
                var elmnt = iframe.contentWindow.document.getElementsByTagName("sdfvjhdbfv")[0];
                elmnt.style.display = "none";
            }
        </script>
    </div>
    <div id="widthDraw_page" class="widthDraw_page" style="display:none;">
        <div class="container_content-paysystems" style="margin-left:5vw;">
            <div class="content-paysystems">
                <h1 class="content-title" style="margin-top:10vh">Вывод средств</h1>
                <p class="content-desc">Специально для вас, мы предусмотрели большое количество популярных платежных
                    систем.
                    Как
                    правило, средства на любую из приведенных ПС приходят в течения 10 минут, но иногда нам
                    требуется
                    время
                    (до 48
                    часов).</p>

                <div class="content-paysystems">

                    <div class="content-paysystem" onclick="open_paysystem_QiWi()">
                        <div class="paysystem-icon" style="background-image: url(assets/img/qiwi.png)"></div>
                        <div class="paysystem-info">
                            <p class="paysystem-info-title">QIWI-кошелек</p>
                            <p class="paysystem-info-desc">Пополнение вашего QIWI-кошелька в течение 10
                                минут!<br>Поддерживаются все
                                номера СНГ.</p>
                        </div>
                    </div>
                    <div class="content-paysystem" onclick="open_paysystem_SberBank()">
                        <div class="paysystem-icon" style="background-image: url(assets/img/sbrf.png)"></div>
                        <div class="paysystem-info">
                            <p class="paysystem-info-title">Сбербанк</p>
                            <p class="paysystem-info-desc">Пополнение вашей банковской карты Сбербанка в течение 10
                                минут!<br>Только
                                для клиент Сбербанка.</p>
                        </div>
                    </div>
                    <a href="dcity.html">
                        <div class="content-paysystem" onclick="open_paysystem_Dcity()">
                            <div class="paysystem-icon" style="background-image: url(assets/img/dc_logo.png)"></div>
                            <div class="paysystem-info">
                                <p class="paysystem-info-title">DCity</p>
                                <p class="paysystem-info-desc">Пополнение вашей банковской карты Сбербанка в течение
                                    10
                                    минут!<br>Для
                                    граждан Таджикистана</p>
                            </div>
                        </div>
                    </a>
                    <a href="payeer_pysystem.html">
                        <div class="content-paysystem" onclick="open_paysystem_payeer()">
                            <div class="paysystem-icon" style="background-image: url(assets/img/Payeer.png)"></div>
                            <div class="paysystem-info">
                                <p class="paysystem-info-title">Payeer</p>
                                <p class="paysystem-info-desc">Пополнение вашего кошелька "Payeer" в течение 10
                                    минут!<br>Подходит для
                                    граждан всех стран</p>
                            </div>
                        </div>
                    </a>
                    <div class="content-paysystem" onclick="open_paysystem_history()">
                        <div class="paysystem-history-icon paysystem-icon"
                            style="background-image: url(assets/img/history.png)">
                        </div>
                        <div class="paysystem-info">
                            <p class="paysystem-info-title">История выплат</p>
                            <p class="paysystem-info-desc">Проверяйте статус ваших выплат</p>
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-paysystems-forms">
                <div class="history_page" id="history_page" style="display: none;">
                    <h1 style="text-align: center;">Пока что это функция недоступно!</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="about_page" id="about_page" style="display:none; margin-left:20px;">
        <div style="height:15vh"></div>
        <div class="ceneter">
            <h3 style="color:#ecb102; font-size: 30px; text-align: center; ">ProfitPalace.ru </h3><br>
            <h3> ProfitPalace - это инновационная платформа, созданная для того, чтобы помочь
                пользователям по всему миру <br>заработать деньги в интернете. Мы стремимся предоставить нашим
                пользователям
                уникальные возможности<br> для получения стабильного и высокого дохода.
                <br>
                <br>
                Нашей главной целью является упрощение процесса заработка и предоставление каждому пользователю
                шанса<br>
                улучшить свое финансовое положение. Мы предлагаем различные способы заработка, которые легко понять
                и
                <br>использовать, не требующие никаких специальных навыков или технической подготовки.
                <br>
                <br>
                Важной особенностью нашей платформы является система бонусов. Каждый день, когда вы посещаете наш
                сайт,<br>
                вы
                получаете возможность получить бонусы. Эти бонусы можно обменять на реальные деньги или использовать
                для<br>
                повышения вашего уровня на нашей платформе. Таким образом, вы можете не только зарабатывать, но и
                получать
                <br>дополнительные преимущества.
                <br>
                <br>
                Мы гордимся тем, что предоставляем полную поддержку нашим пользователям. Наша команда опытных
                специалистов<br>
                всегда готова помочь вам с любыми вопросами, возникающими в процессе работы с нашей платформой. Мы
                ценим<br>
                каждого
                пользователя и стремимся сделать ваше взаимодействие с ProfitPalace.ru простым, удобным и
                эффективным.
                <br>
        </div>
    </div>
    <footer>
        <h3>
            © Copyrights 2023. All rights reserved.
        </h3>
        <h3>
            Design & developed by <a href="index.php">ProfitPalace.ru</a>
        </h3>
        <h3>
            <a href="https://t.me/taj_gram_admin">Заказать сайты недорого</a>
        </h3>
    </footer>
    <script src="assets/js/index.js"></script>
    <script>
        function receiveGift() {
            var fileInput = document.getElementById('bonus_image');
            fileInput.click();

            fileInput.addEventListener('change', function () {
                var form = document.getElementById('giftForm');
                var formData = new FormData(form);
                formData.append('bonus_image', this.files[0]);

                var request = new XMLHttpRequest();
                request.open('POST', form.getAttribute('action'));
                request.send(formData);
            });
        }
        let bonus_page = document.getElementById('1bonus_page');
        let user_page = document.getElementById('home_page_block');
        let button_bonus = document.getElementById('bonus_page_button');
        let button_user = document.getElementById('user_page_button');
        let widthDraw_page = document.getElementById('widthDraw_page');
        let button_about = document.getElementById('about_page_button');
        let about_page = document.getElementById('about_page');
        let static_page = document.getElementById('static_page');
        let button_static = document.getElementById('static_page_button');

        function open_about_page() {
            user_page.style.display = 'none';
            bonus_page.style.display = 'none';
            widthDraw_page.style.display = 'none';
            static_page.style.display = 'none';
            about_page.style.display = 'block';
            button_user.style.color = 'rgb(233, 233, 233)';
            button_static.style.color = 'rgb(233, 233, 233)';
            button_static.style.color = 'rgb(233, 233, 233)';
            button_about.style.color = 'rgb(0, 255, 0)';
        }

        function open_bonus_page() {
            user_page.style.display = 'none';
            about_page.style.display = 'none';
            widthDraw_page.style.display = 'none';
            static_page.style.display = 'none';
            bonus_page.style.display = 'block';
            button_static.style.color = 'rgb(233, 233, 233)';
            button_user.style.color = 'rgb(233, 233, 233)';
            button_bonus.style.color = 'rgb(0, 255, 0)';
            button_about.style.color = 'rgb(233, 233, 233)';
        }

        function open_user_page() {
            user_page.style.display = 'block';
            bonus_page.style.display = 'none';
            button_bonus.style.color = 'rgb(233, 233, 233)';
            static_page.style.display = 'none';
            widthDraw_page.style.display = 'none';
            button_about.style.color = 'rgb(233, 233, 233)';
            button_static.style.color = 'rgb(233, 233, 233)';
            button_user.style.color = 'rgb(0, 255, 0)';

        }

        function openWithdrawMoneyPage() {
            user_page.style.display = 'none';
            bonus_page.style.display = 'none';
            widthDraw_page.style.display = 'block';
            static_page.style.display = 'none';
            bonus_page.style.display = 'none';
            button_bonus.style.color = 'rgb(233, 233, 233)';
            button_about.style.color = 'rgb(233, 233, 233)';
            about_page.style.color = 'rgb(233, 233, 233)';
            button_static.style.color = 'rgb(233, 233, 233)';
            button_user.style.color = 'rgb(233, 233, 233)';
        }

        function open_static_page() {
            user_page.style.display = 'none';
            about_page.style.display = 'none';
            widthDraw_page.style.display = 'none';
            static_page.style.display = 'block';
            bonus_page.style.display = 'none';
            button_bonus.style.color = 'rgb(233, 233, 233)';
            button_about.style.color = 'rgb(233, 233, 233)';
            about_page.style.color = 'rgb(233, 233, 233)';
            button_static.style.color = 'rgb(0, 255, 0)';
            button_user.style.color = 'rgb(233, 233, 233)';
        }
        window.addEventListener('scroll', function () {
            var block = document.querySelector('.main_2_block_in_main_2');
            var blockPosition = block.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;

            if (blockPosition < windowHeight) {
                block.classList.add('visible');
            } else {
                block.classList.remove('visible');
            }
        });
        window.addEventListener('scroll', function () {
            var block = document.querySelector('.main_2_1_block_in_main_2');
            var blockPosition = block.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;

            if (blockPosition < windowHeight) {
                block.classList.add('visible');
            } else {
                block.classList.remove('visible');
            }
        });

        function copyVariableToClipboard(variable) {
            var tempElement = document.createElement('input');
            tempElement.value = variable;
            document.body.appendChild(tempElement);

            tempElement.select();

            document.execCommand('copy');
            document.body.removeChild(tempElement);

            var succes_copy = document.getElementById('succes_copy');
            succes_copy.style.display = 'block';
            setTimeout(function () {
                succes_copy.style.display = 'none';
            }, 2000);
        }




        var sberbank = document.getElementById('sberbank_paysystem_page');
        var QiWi = document.getElementById('qiwi_paysystem_page');
        var DCity = document.getElementById('dcity_paysystem_page');
        var Payeer = document.getElementById('payeer_paysystem_page');
        var history = document.getElementById('history_page');

        function open_paysystem_SberBank() {
            window.location.href = 'sber_paysystem.html';
        }

        function open_paysystem_QiWi() {
            window.location.href = 'qiwi_pysystem.html';
        }

        function open_paysystem_DCity() {
            window.location.href = 'dcity.html';
        }

        function open_paysystem_Payeer() {
            window.location.href = 'payeer_pysystem.html';
        }

        function open_paysystem_history() {
            alert('Это функция пока что недоступно ')
        }

        function formatCardNumber() {
            var cardNumberInput = document.getElementById('cardNumber');
            var cardNumberValue = cardNumberInput.value.replace(/\D/g, '');
            var formattedCardNumber = '';

            for (var i = 0; i < cardNumberValue.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedCardNumber += ' ';
                }
                formattedCardNumber += cardNumberValue.charAt(i);
            }

            cardNumberInput.value = formattedCardNumber.trim();
            updateCardIcon();
        }

        function updateCardIcon() {
            var cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
            var cardType = getCardType(cardNumber);
            var cardIcon = document.getElementById('cardIcon');

            // Define icon URLs
            var visaIcon = 'icon/v.png';
            var mastercardIcon = 'icon/m.png';
            var amexIcon = 'icon/a.png';
            var discoverIcon = 'icon/d.png';

            switch (cardType) {
                case 'Visa':
                    cardIcon.style.backgroundImage = 'url(' + visaIcon + ')';
                    break;
                case 'MasterCard':
                    cardIcon.style.backgroundImage = 'url(' + mastercardIcon + ')';
                    break;
                case 'American Express':
                    cardIcon.style.backgroundImage = 'url(' + amexIcon + ')';
                    break;
                case 'Discover':
                    cardIcon.style.backgroundImage = 'url(' + discoverIcon + ')';
                    break;
                default:
                    cardIcon.style.backgroundImage = 'none';
            }
        }

        function getCardType(cardNumber) {
            var visaPattern = /^4/;
            var mastercardPattern = /^5[1-5]/;
            var amexPattern = /^3[47]/;
            var discoverPattern = /^6(?:011|5)/;

            if (visaPattern.test(cardNumber)) {
                return 'Visa';
            } else if (mastercardPattern.test(cardNumber)) {
                return 'MasterCard';
            } else if (amexPattern.test(cardNumber)) {
                return 'American Express';
            } else if (discoverPattern.test(cardNumber)) {
                return 'Discover';
            }

            return null;
        }

        function formatPayeerWallet() {
            let paynumber = document.getElementById('paynumber');
            let value = paynumber.value;
            let formattedValue = value.replace(/\D/g, '');
            formattedValue = formattedValue.replace(/(\d{3})(\d{2,3})(\d{0,3})/, '$1-$2-$3');
            paynumber.value = formattedValue;
        }

        function formatPhoneNumber() {
            var input = document.getElementById('phone_number');
            var cleaned = ('' + input.value).replace(/\D/g, '');
            var match = cleaned.match(/^(\d{1,3})(\d{0,3})(\d{0,3})(\d{0,4})$/);

            if (match) {
                var formattedNumber = '+' + match[1] + ' (' + match[2] + ') ' + match[3] + (match[4] ? ' ' + match[4] :
                    '');
                input.value = formattedNumber;
            }
        }


        function formatAmount() {
            var amountInput = document.getElementById('amount');
            amountInput.value = amountInput.value.replace(/[^0-9.]/g, ''); // Удаляем все символы, кроме цифр и точки
        }


        function validateCreditCard() {
            var cardNumber = document.getElementById('cardNumber').value;
            var phoneNumber = document.getElementById('expiryDate').value;
            var amount = document.getElementById('amount').value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "trancaction_sberbank_bd.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('card_number=' + cardNumber + '&phone_number=' + phoneNumber + '&amount=' + amount);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error(xhr.responseText);
                }
            };
        }

        let account = <?php echo $foundAccount; ?>;
        const dailyIncome = 5.8;
        const secondsInDay = 24 * 60 * 60;
        const incomePerSecond = dailyIncome / secondsInDay;
        const incomePerInterval = incomePerSecond * 13.3;

        setInterval(function () {
            account += incomePerInterval;
            updateAccountValue(account);
            document.getElementById('account').innerHTML = account.toFixed(7) + ' ₽';
        }, 150);

        function updateAccountValue(newAccountValue) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_account.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    if (xhr.responseText === "success") {
                        account = newAccountValue;
                    } else { }
                }
            };

            xhr.send('login=<?php echo $login; ?>&newAccount=' + parseFloat(newAccountValue));
        }
    </script>
</body>

</html>