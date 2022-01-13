<?php 
include_once 'header.php'; 
include_once __DIR__ . "/database.php";
include_once __DIR__ . "/functions/base_func.php";
?>
<?php

$name = security($_POST["name"] ?? false);
$pwd = security($_POST["pwd"] ?? false);

$sql = "SELECT * FROM accounts";
$result = mysqli_query($conn, $sql);

while($account = mysqli_fetch_assoc($result)){
    printArray($account);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    printArray($_POST);
    $errors = [] ?? "";


    if($name && $pwd) {
        if (strlen($name) < 4) {
            $errors["username&pwd"] = "Lietotājvārdam ir jābūt vismaz 4 simboli garam";
        }
    } else {
        $errors["username&pwd"] = "Lietotājvārds vai parole ir nekorekta";
    }
}
?>
    <section class="signup-form">

        <div class="signup-form-box">
            <h2>Ielogošanās</h2>
            <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Lietotājvārds / Epasts">
                </div>

                <div class="input-group">
                    <input type="password" name="pwd" placeholder="Parole">
                </div>

                <button type="submit" name="submit">Ielogoties</button>

            </form>
        </div>
    </section>
    <?php include_once 'footer.php'; ?>
    <?php
    echo "<br />";
    if ($errors) {
        printArray($errors);
    }
    