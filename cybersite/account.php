<?php
include_once __DIR__ . "/database.php";
include_once 'header.php';

$sql = "SELECT * FROM accounts";
$result = mysqli_query($conn, $sql);


$_GET["name"] = "raivis";
?>


<section class="accounts">
    <?php if($result->num_rows > 0): ?>
        <table class="user-accounts">
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>EDIT</th>
            </tr>
                <?php while($user = mysqli_fetch_assoc($result)):?>
            <tr>
                <td><?=$user["ID"];?></td>
                <td><?=$user["vards"];?></td>
                <td><?=$user["epasts"];?></td>
                <td><?=$user["lietotajvards"];?></td>
                <td><a href="update.php?ID=<?=$user["ID"];?>">UPDATE</a></td>
            </tr>
                <?php endwhile;?>
        </table>
    <?php endif; ?>
</section>