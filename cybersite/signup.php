<?php
    session_start();
    if (isset($_SESSION["uid"])){
        header("Location: index.php");
    }

    include_once __DIR__ . "/database.php";
    include_once __DIR__ . "/functions.php";

    $name       = filter($_POST["name"]   ?? false);
    $email      = filter($_POST["email"]  ?? false);
    $uid        = filter($_POST["uid"]    ?? false);
    $pwd        = filter($_POST["pwd"]    ?? false);
    $pwdrepeat  = filter($_POST["pwdrepeat"] ?? false);

    $errors = [] ?? "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // show($_POST, "POST");

        if ($name) {
            if (strlen($name) < 4) {
                $errors["name"] = "Vārdam ir jābūt vismaz 4 simboli garam";
            }
        } else {
            $errors["name"] = "Vārds ir obligāts";
        }

        if ($uid) {
            if (strlen($name) < 4) {
                $errors["username"] = "Lietotājvārdam ir jābūt vismaz 4 simboli garam";
            }

        } else {
            $errors["username"] = "Lietotājvārds ir obligāts";
        }

        if ($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Epasts ir nekorekts";
            }
        } else {
            $errors["email"] = "Epasts ir obligāts";
        }

        if ($pwd) {
            if ($pwd != $pwdrepeat) {
                $errors["pwdrepeat"] = "Paroles nesakrīt";
            }
        } else {
            $errors["pwd"] = "Parole ir obligāta";
        }
        
        $sql = "SELECT * FROM accounts WHERE uid = '$uid'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);


        if (mysqli_num_rows($res) > 0) {
            $errors["pwd"] = "Lietotājvārds ir aizņemts";
        }


        $pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $sql = "INSERT INTO accounts (uid, name, email, pwd) VALUES ('$uid', '$name', '$email', '$pwd')";
        
        $err_counter = count($errors);
        
        if (!$err_counter > 0) {
            if (mysqli_query($conn, $sql)) {
                header("Location: account.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    include_once __DIR__. '/header.php'; ?> 

    <section class="signup-form">
            <div>
                <h1>Reģistrēšanās</h1>
            </div>
            <form class="signup-form-box" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <?php
                    if (!empty($errors)){
                        foreach ($errors as $key => $value) {
                            echo "<p class = \"error\">" . $value . "</p>";
                        }
                    }
                ?> 
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Vārds" value="<?= $name ?? "" ?>">
                    </div>

                    <div class="input-group">
                        <input type="text" name="email" placeholder="Epasts" value="<?= $email ?? "" ?>">
                    </div>

                    <div class="input-group">
                        <input type="text" name="uid" placeholder="Lietotājvārds" value="<?= $uid ?? "" ?>">
                    </div>

                    <div class="input-group">
                        <input type="password" name="pwd" placeholder="Parole">
                    </div>

                    <div class="input-group">
                        <input type="password" name="pwdrepeat" placeholder="Parole atkārtoti">
                    </div>
                    
                <input type="submit" name="submit" value="Reģistrēties">
            </form>

    </section>

<?php include_once  __DIR__ . "/footer.php"; ?>

