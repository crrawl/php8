<?php
    include_once __DIR__ . "/database.php";
    $id = $_GET["ID"];

    $sql = "DELETE FROM accounts WHERE id = '$id'";
    mysqli_query($conn, $sql);
    header("Location: account.php");
?>