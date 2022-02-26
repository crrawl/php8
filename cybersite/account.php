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
    <div class="header">
        <h1>Accounts</h1>
    </div>
    <?php if($result->num_rows > 0): ?>
        
        <div class="user-accounts">
            <!-- headers -->
            <div class="account">ID</div>
            <div class="account">UID</div>
            <div class="account">NAME</div>
            <div class="account">EMAIL</div>
            <div class="account">UPDATE</div>
            <div class="account">DELETE</div>

            <!-- account list -->
            <?php while($user = mysqli_fetch_assoc($result)):?>

                <div class="account"><?=$user["ID"];?></div>
                <div class="account"><?=$user["uid"];?></div>
                <div class="account"><?=$user["name"];?></div>
                <div class="account"><?=$user["email"];?></div>
                <a href="update.php?ID=<?=$user["ID"];?>" class="account">UPDATE</a>
                <a href="delete.php?ID=<?=$user["ID"];?>" class="account" style="background-color:#393939" >DELETE</a>
                <?php endwhile;?>
        </div>
    <?php else: ?>
        <h1>Nav atrastu kontu!!</h1>
    <?php endif; ?> 

</section>
<div class="logout">
    <h4 style="font-family: 'Ubuntu', sans-serif;">Hello, <?=$_SESSION["uid"]?></h4>
    <a href="logout.php">logout</a>
</div>