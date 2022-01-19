<?php

    require_once(__DIR__.'/database.php');

    $sql = "INSERT INTO players (`id`, `name`, `overal`) VALUES (NULL, 'Kuramu', '65')";

    // $sqlDEL = "DELETE FROM `accounts` WHERE ID = 5";

    mysqli_query($conn, $sql);

    // mysqli_query($conn, $sqlDEL);
    
