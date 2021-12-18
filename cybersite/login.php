<?php include_once 'header.php'; ?>

    <section class="signup-form">

        <div class="signup-form-box">
            <h2>Ielogošanās</h2>
            <form action="include/login.inc.php">
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