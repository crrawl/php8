<?php
    include_once __DIR__ . "/database.php";
    if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {

        session_start();
        $id = $_GET["ID"];
    
        $sql = "SELECT * FROM accounts WHERE ID = '$id'LIMIT 1";
        $result = mysqli_query($conn, $sql);
    
        $row = mysqli_fetch_assoc($result);
        echo $row["uid"];
        $_SESSION["uid"] = $row["uid"];
        
        echo "<pre>";
        print_r($_SESSION);
        header("Location: account.php");
    } else {
        header("Location: account.php");
    }