<?php
session_start();
require_once 'php/db.php';

$sql = "(SELECT login, amount, 'DCity' as source FROM transactions_DCity LIMIT 30)
        UNION
        (SELECT login, amount, 'payeer' as source FROM transactions_payeer LIMIT 30)
        UNION
        (SELECT login, amount, 'qiwi' as source FROM transactions_qiwi LIMIT 30)
        UNION
        (SELECT login, amount, 'sberbank' as source FROM transactions_sberbank LIMIT 30)
        ORDER BY login";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='container'>";
    echo "<thead><tr><th><h1>Login</h1></th><th><h1>Amount</h1></th><th><h1>Source</h1></th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["login"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["source"] . "</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Нет данных для отображения";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бонусы</title>
    <style>
    .container {
        text-align: left;
        overflow: hidden;
        width: 80%;
        margin: 0 auto;
        display: table;
        padding: 0 0 8em 0;
    }

    .container th h1 {
        font-weight: bold;
        font-size: 1em;
        text-align: left;
        color: rgb(233, 233, 233);
    }

    .container td {
        font-weight: normal;
        color: rgb(233, 233, 233);
        font-size: 1em;
        -webkit-box-shadow: 0 2px 2px -2px #0E1119;
        -moz-box-shadow: 0 2px 2px -2px #0E1119;
        box-shadow: 0 2px 2px -2px #0E1119;
    }

    .container td,
    .container th {
        padding-bottom: 2%;
        padding-top: 2%;
        padding-left: 2%;
    }

    /* Background-color of the odd rows */
    .container tr:nth-child(odd) {
        background-color: #323C50;
    }

    /* Background-color of the even rows */
    .container tr:nth-child(even) {
        background-color: #2C3446;
    }

    .container th {
        background-color: #1F2739;
    }

    .container td:first-child {
        color: #FB667A;
    }

    .container tr:hover {
        background-color: #464A52;
        -webkit-box-shadow: 0 6px 6px -6px #0E1119;
        -moz-box-shadow: 0 6px 6px -6px #0E1119;
        box-shadow: 0 6px 6px -6px #0E1119;
    }

    .container td:hover {
        background-color: #FFF842;
        color: #403E10;
        font-weight: bold;
        box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
        transform: translate3d(6px, -6px, 0);
        transition-delay: 0s;
        transition-duration: 0.4s;
        transition-property: all;
        transition-timing-function: line;
    }

    @media (max-width: 800px) {

        .container td:nth-child(4),
        .container th:nth-child(4) {
            display: none;
        }
    }
    </style>
</head>

<body>
    <script>
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({
            'padding-right': scrollWidth
        });
    }).resize();
    </script>
</body>

</html>