<?php
    session_start();

    include_once __DIR__ . "/database.php";
    include_once __DIR__ . "/functions.php";
    include_once __DIR__ . '/header.php';

    if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
        $id = $_GET['ID'];

        $sql = "SELECT * FROM accounts WHERE ID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result); // $user te var būt vai nu masīvs vai NULL

        if (isset($_POST['submit'])) {
            $uid    = filter($_POST['uid'] ?? false);
            $name   = filter($_POST['name'] ?? false);
            $email  = filter($_POST['email'] ?? false);

            $errors = [] ?? false;

            if (!$name) {
                $errors["name"] = "Ievadi vārdu!";
            } elseif (strlen($_POST['name']) < 4) {
                $errors['name'] = "Vārdam jābūt vismaz 4 simbolus garam!";
            }

            if (!$email) {
                $errors['email'] = "Ievadi e-pastu!";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "E-pasts formāts nav korekts!";
            }

            if (!$uid) {
                $errors['uid'] = "Ievadi savu lietotājvārdu!";
            } elseif (strlen($_POST['uid']) < 4) {
                $errors['uid'] = "Lietotājvārdam jābūt vismaz 4 simbolus garam!";
            }

            if (!$errors) {
                $query = "UPDATE accounts SET uid = '$uid', name = '$name', email = '$email' WHERE ID = '$id'";
                mysqli_query($conn, $query);
            }
        }
    } else {
        header("Location:" . __DIR__ . "account.php");
        die();
    }
?>
<section class="update-accounts">
    <div class="header">
        <h1>update account</h1>
    </div>
    <?php if(is_array($user)): ?>
        <form class="update-account" id="update-account-submit" action="" method="POST">
             <!-- headers -->
             <div class="update-account-item">UID</div>
             <div class="update-account-item">NAME</div>
             <div class="update-account-item">EMAIL</div>
             <div class="update-account-item">SEND</div>

            <div class="update-account-item"><input type="text" name="uid" value="<?= $uid ?? $user['uid'] ?>"></div>
            <div class="update-account-item"><input type="text" name="name" value="<?= $name ?? $user['name']?>"></div>
            <div class="update-account-item"><input type="text" name="email" value="<?= $email ?? $user['email']?>"></div>
            <div class="update-account-item"><button type="submit" name="submit">ENTER</button></div>

            <!-- <a href="#" onclick="document.getElementById('update-account-submit').submit()" class="update-account-item">SEND</a> -->

                <?php
                    if (!empty($errors)){
                        foreach ($errors as $key => $value) {
                            echo "<p class = \"error\">" . $value . "</p>";
                        }
                    }
                ?>
        </form>
    <?php else: ?>
        <h3 style = "color: white">Tāds lietotājs nav atrasts!</h3>
    <?php endif; ?>
</section>


<?php include_once __DIR__ . '/footer.php'; ?> 