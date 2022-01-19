<?php
include_once __DIR__ . "/database.php";
include_once __DIR__ . "/functions/base_func.php";
include_once 'header.php';

echo "_GET ";
printArray($_GET);
$id = $_GET["ID"] ?? false;
echo $id . " = ID <br>";

echo "_POST ";
printArray($_POST);


echo "====================================";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"] ?? false;
    $email = $_GET["email"] ?? false;
    $username = $_GET["username"] ?? false;

    $sql = "SELECT * FROM accounts WHERE ID = `$id`";
    $result = mysqli_query($conn, $sql);

    $db_user = mysqli_fetch_assoc($result);
    $db_id = $db_user['ID'];

    echo "_DB_USER ";
    printArray($db_user);

    $sql = "UPDATE accounts SET vards = '$name', epasts = '$email', lietotajvards = '$username' WHERE ID = `$db_id`";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>


<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
    <table class="edit-box">
        <tr>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>USERNAME</th>
            <th>ENTER</th>
        </tr>
        <tr>
            <td><input type="text" name="name" value="<?=$db_user['vards'] ?? ""?>"></td>
            <td><input type="text" name="email" value="<?=$db_user['epasts'] ?? ""?>"></td>
            <td><input type="text" name="username" value="<?=$db_user['lietotajvards'] ?? ""?>"></td>
            <td><button type="submit" name="enter">ENTER</button></td>
        </tr>
    </table>
</form>
