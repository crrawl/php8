<?php
    session_start();

    include_once __DIR__ . "/database.php";
    include_once __DIR__ . "/functions/base_func.php";
    include_once __DIR__ . '/header.php';

    if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
        $id = $_GET['ID'];

        $sql = "SELECT * FROM accounts WHERE ID = '$id' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result); // $user te var būt vai nu masīvs vai NULL

        if (isset($_POST['submit'])) {
            $name = security($_POST['name'] ?? false);
            $email = security($_POST['email'] ?? false);
            $uid = security($_POST['uid'] ?? false);

            $errors = [] ?? false;

            if (!$name) {
                $errors["name"] = "Ievadi vārdu!";
            } elseif (strlen($_POST['name']) < 4) {
                $errors['name'] = "Vārdam jābūt vismaz 4 simbolus garam!";
            }

            if (!$_POST['email']) {
                $errors['email'] = "Ievadi e-pastu!";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "E-pasts formāts nav korekts!";
            }

            if (!$_POST['uid']) {
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
<section class="signup-form">
    <?php if(is_array($user)): ?>
        <form action="" method="POST">
            <table class="edit-box">
                <tr>
                    <th>UID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ENTER</th>
                </tr>
                <tr>
                    <td><input type="text" name="uid" value="<?= $uid ?? $user['uid'] ?>"></td>
                    <td><input type="text" name="name" value="<?= $user['name']?>"></td>
                    <td><input type="text" name="email" value="<?= $user['email']?>"></td>
                    <td><button type="submit" name="submit">ENTER</button></td>
                </tr>
            </table>
            <br><br>
                <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                <p class = "error">
                <?= $error ?>
                </p>
                <?php endforeach; ?>
                <?php endif; ?> 
        </form>
        <?php else: ?>
            <h3 style = "color: white">Tāds lietotājs nav atrasts!</h3>
        <?php endif; ?>
</section>


<?php include_once __DIR__ . '/footer.php'; ?> 