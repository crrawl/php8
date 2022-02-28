<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.google.com/specimen/Roboto+Mono?preview.text=Almost%20before%20we%20knew%20it,%20we%20had%20left%20the%20gr%C4%81&preview.text_type=custom"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="assets/style/style.css">
    <title>cybersite</title>
</head>
<body>
    <header>
        <nav>
            <div class="wrapper">
                <div class="hamburger-menu">
                    <div class="menu-btn">Izvēlne</div>
                    <div class="close-btn">Aizvērt</div>
                </div>
                <ul class="nav-list">
                    <li><a href="index.php">Sākums</a></li>
                    <li><a href="#">Par mums</a></li>
                    <li><a href="#">Blogs</a></li>
                    <?php
                        if (!isset($_SESSION)){
                            session_start();
                        }

                        if (isset($_SESSION["uid"])){
                            echo "<li><a href=\"account.php\">account</a></li>";
                        } else {
                            echo "<li><a href=\"login.php\">Ielogoties</a></li>";
                            echo "<li><a href=\"signup.php\">Reģistrēties</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
