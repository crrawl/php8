<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.I.A homepage</title>
</head>
<body>
    <style>
        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
    <div class="content">
        <h1>Hello to C.I.A homepage!</h1>
        <h3>This website is fake - created by yuukuramu</h3>
    </div>
</body>
</html>

<?php
    session_start();
    include_once __DIR__ . "/functions.php";
    show($_SESSION);

    if ($_SESSION) {
        echo "<a href=\"logout.php\">logout</a>";
    } else {
        echo "<a href=\"login.php\">login</a>";
    }