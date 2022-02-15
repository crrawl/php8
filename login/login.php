<?php
    
    session_start();
    if ($_SESSION) {
        header("Location: index.php");
    }
    
    include_once __DIR__ . "/functions.php";
    include_once __DIR__ . "/database.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = secure($_POST["name"] ?? false);
        $pwd = secure($_POST["passwd"] ?? false);
        $scode = secure($_POST["scode"] ?? false);

        $errors = [] ?? false;

        if (!$name){ // if $name != true.
            $errors["name"] = "This field is empty";
        }
        if (!$pwd){ // if $pwd != true.
            $errors["password"] = "This field is empty";
        }
        if (!$scode){ // if $scode != true.
            $errors["security_code"] = "This field is empty";
        }
        
        if (!$errors) { // if $errors != true. 
            $sql = "SELECT * FROM agents WHERE security_code = '$scode'";
            $result = mysqli_query($conn, $sql);
            $agent = mysqli_fetch_assoc($result);
            
            // Is agent security code finded in db
            if (mysqli_num_rows($result) != 0) {
                if ($name != $agent["agent"]) { 
                    $errors["name"] = "Incorect agent name";
                } else {
                    $hash_verify = password_verify($pwd, $agent["password"]);
                    
                    if ($hash_verify) {
                        $_SESSION["SESSID"] = session_create_id();
                        $_SESSION["security_code"] = $scode;
                        header("location: index.php");
                    } else {
                        $errors["password"] = "Incorect password";
                    }
                }
            } else {
                $errors["security_code"] = "Incorect security code";
            }
        }

    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <link rel="stylesheet" href="assets/fonts/fonts.css">

    <title>C.I.A TERMINAL</title>
</head>
<body>
    <img class="cia-logo" src="assets/images/cia_logo.png" alt="cia logo">
    <h1 class="header">C.I.A TERMINAL</h1>
    <form class="content" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <div class="input-field">
            <label for="name">AGENT</label>
            <input type="text" name="name" placeholder="<?=$errors["name"] ?? ""?>">
        </div>
        <div class="input-field">
        <label for="passwd">PASSWORD</label>
            <input type="password" name="passwd" placeholder="<?=$errors["password"] ?? ""?>">
        </div>
        <div class="input-field">
            <label for="scode">SECURITY CODE</label>
            <input type="text" name="scode" placeholder="<?=$errors["security_code"] ?? ""?>">
        </div>

        <button class="submit">
            <span class="submit-txt">Press on the box below to authorize</span>
            <img src="assets/images/nospiedums.png" alt="nospiedums">
        </button>

    </form>
    <p class="copyright">
        You are entering a secured United States Government system which may be used only for authorised purposes. Modification of any information in this system is subject to criminal prosecution. The C.I.A. monitors all usage of this system. All persons are hereby notified that the use of this system constitutes consent to such monitoring and auditing.
    </p>
</body>
</html>