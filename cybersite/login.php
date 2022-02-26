<?php 
    session_start();

    if (isset($_SESSION["uid"])){
        header("Location: index.php");
    }

    include_once __DIR__ . "/header.php"; 
    include_once __DIR__ . "/database.php";
    include_once __DIR__ . "/functions.php";

    $uid    = filter($_POST["uid"] ?? false);
    $pwd    = filter($_POST["pwd"] ?? false);
    $submit = filter($_POST["submit"] ?? false);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        
        $errors = [] ?? false;
        
        if($uid && $pwd) {
            if (strlen($uid) < 4) {
                $errors["username&pwd"] = "Lietotājvārdam ir jābūt vismaz 4 simboli garam";
            }
        } else {
            $errors["username&pwd"] = "Lietotājvārds vai parole ir nekorekta";
        }
        
        if ($submit) {
            
            $sql = "SELECT * FROM accounts WHERE uid = '$uid' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $account = mysqli_fetch_assoc($result);

            if ($account) {
                
                $hash_verify = password_verify($pwd, $account["pwd"]);

                if ($hash_verify){
                    $_SESSION["uid"] = $account["uid"];
                    
                    header("Location: index.php");
                } else {
                    $errors["user_not_found"] = "Lietotājs nav atrasts!";
                }
            } else {
                $errors["user_not_found"] = "Lietotājs nav atrasts!";
            }
        }
    }
?>
<section class="signup-form">

    <div class="signup-form-box">
        <h2>Ielogošanās</h2>
        <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <div class="input-group">
            <span>
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $key => $value) {
                        echo $value;
                    }
                }
                ?>
            </span>
                <input type="text" name="uid" placeholder="Lietotājvārds / Epasts">
            </div>

            <div class="input-group">
                <input type="password" name="pwd" placeholder="Parole">
            </div>
            <input type="submit" name="submit" >

        </form>
    </div>
</section>
<?php include_once  __DIR__ . "/footer.php"; ?>

    