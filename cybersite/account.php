<?php
    session_start();

    include_once __DIR__ . "/database.php";
    include_once __DIR__ . "/header.php";

    if (!isset($_SESSION["uid"])){
        header("Location: login.php");
    }

    $sql = "SELECT * FROM accounts";
    $result = mysqli_query($conn, $sql);

?>


<section class="accounts">
    <?php if($result->num_rows > 0): ?>
        <table class="user-accounts">
            <tr>
                <th>ID</th>
                <th>UID</th>
                <th>NAME</th>
                <th>EMAIL</th>
            </tr>
                <?php while($user = mysqli_fetch_assoc($result)):?>
            <tr>
                <td><?=$user["ID"];?></td>
                <td><?=$user["uid"];?></td>
                <td><?=$user["name"];?></td>
                <td><?=$user["email"];?></td>
                <td><a href="update.php?ID=<?=$user["ID"];?>">UPDATE</a></td>
            </tr>
                <?php endwhile;?>
        </table>
    <?php endif; ?>
</section>
<div class="logout">
    <h4>Hello, <?=$_SESSION["uid"]?></h4>
    <a href="logout.php">logout</a>
</div>