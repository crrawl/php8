<?php

    require_once(__DIR__.'/database.php');

    $sql = "SELECT * FROM players";
    $data = mysqli_query($conn, $sql);
?>
<style>
table, th, td {
    border: 1px solid black;
}

</style>
    <?php if($data->num_rows > 0): ?>
        <table class="user-accounts">
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>OVERAL</th>
            </tr>
                <?php while($user = mysqli_fetch_assoc($data)):?>
            <tr>
                <td><?=$user["ID"];?></td>
                <td><?=$user["name"];?></td>
                <td><?=$user["overal"];?></td>
            </tr>
                <?php endwhile;?>
        </table>
    <?php endif; ?>