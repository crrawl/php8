<?php
    date_default_timezone_set('Europe/Riga');
    session_start();

    if (!isset($_SESSION["uid"])){
        header("Location: index.php");
    }

    include_once __DIR__ . "/database.php";
    include_once __DIR__ . "/functions.php";
    // Current date time 
    $DateTime = new DateTime();
    $datetime = $DateTime->format('Y-m-d h:i:s');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uid = $_SESSION["uid"];
        $header = filter($_POST["header"] ?? false);
        $message = filter($_POST["message"] ?? false);
        

        $HEADER_ERROR = "";
        $MESSAGE_ERROR = "";

        if (!$header) {
            $FORM_ERROR = "Nav nodrādīta tēma!";
        } else if (!$message) {
            $FORM_ERROR = "Nav nodrādīta ziņa!";
        }

        if ($header and $message) {
            $sql = "INSERT INTO posts (uid, header, message, datetime) VALUES ('$uid', '$header', '$message', '$datetime') LIMIT 1";
            mysqli_query($conn, $sql);
            
            if (count($_POST) > 0) {
                foreach ($_POST as $k=>$v) {
                    unset($_POST[$k]);
                }
            }
        }
        
    }
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);

    include_once __DIR__. '/header.php'; ?> 

<section class="post-form">
    <div>
        <h1>Posti</h1>
    </div>
    <form class="post-form-box" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

        <div class="input-group">
            <input type="text" name="header" placeholder="<?= "Tēma" ?? $HEADER_ERROR?>">
        </div>

        <div class="input-group">
            <textarea name="message" placeholder="<?= "Ziņa" ?? $MESSAGE_ERROR?>"></textarea>
        </div>
            
        <input type="submit" name="submit" value="Postot">
    </form>

</section>

<section id="posts">

    <!-- post -->
    <?php while($user = mysqli_fetch_assoc($result)):?>

        <div class="post-box">
            <div class="post-header">
                <h2><?=$user["header"];?></h2>
            </div>
            <div class="post-content">
                <p><?=$user["message"];?></p>
            </div>
            <div class="author-time">
                <span class="author">Autors: <?=$user["uid"];?></span>

                <span class="post-time"> Postots: 
                    <?php 
                    // paste this in function 
                        $get_date_db = $user["datetime"];

                        $posted_time = new DateTime($get_date_db);
                        
                        $diff = $DateTime->diff($posted_time);

                        if ($diff->h > 24) {
                            echo $posted_time->format('Y-m-d');
                        } else {
                            echo $posted_time->format('h:i:s');
                        }

                    ?>
            </span>
            </div>   
        </div> 

    <?php endwhile;?>
</section>

<?php include_once  __DIR__ . "/footer.php"; ?>

