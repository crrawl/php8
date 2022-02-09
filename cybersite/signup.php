<?php
    include_once __DIR__ . "/database.php";
    include_once __DIR__ . "/functions/base_func.php";

    $name       = security($_POST["name"]   ?? false);
    $email      = security($_POST["email"]  ?? false);
    $username   = security($_POST["uid"]    ?? false);
    $pwd        = security($_POST["pwd"]    ?? false);
    $pwdrepeat  = security($_POST["pwdrepeat"] ?? false);

    $errors = [] ?? "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // printArray($_POST);

        if ($name) {
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

        $pwd = password_hash($pwd, PASSWORD_BCRYPT);
        $sql = "INSERT INTO accounts (uid, name, email, pwd) VALUES ('$username', '$name', '$email', '$pwd')";
        
        $err_counter = count($errors);
        
        if ($err_counter > 0) {
            echo "Cannot create query";
        } else {
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                header("Location: /php8/cybersite/account.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    include_once 'header.php'; 
?>

    <section class="signup-form">

        <div class="signup-form-box">
            <h2>Reģistrēšanās</h2>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

                <div class="input-group">
                    <input type="text" name="name" placeholder="Vārds" value="<?= $name ?? "" ?>">
                </div>

                <div class="input-group">
                    <input type="text" name="email" placeholder="Epasts" value="<?= $email ?? "" ?>">
                </div>

                <div class="input-group">
                    <input type="text" name="uid" placeholder="Lietotājvārds" value="<?= $username ?? "" ?>">
                </div>

                <div class="input-group">
                    <input type="password" name="pwd" placeholder="Parole">
                </div>

                <div class="input-group">
                    <input type="password" name="pwdrepeat" placeholder="Parole atkārtoti">
                </div>

                <button type="submit" name="submit">Reģistrēties</button>
            </form>
        </div>

    </section>

<?php

    include_once  __DIR__ . "/footer.php";
    echo "<br />";

    if ($errors) {
        printArray($errors);
    }

