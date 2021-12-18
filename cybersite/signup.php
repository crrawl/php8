
<?php include_once 'header.php'; ?>

    <section class="signup-form">

        <div class="signup-form-box">
            <h2>Reģistrēšanās</h2>
            <form action="include/signup.inc.php">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Vārds">
                </div>

                <div class="input-group">
                    <input type="text" name="email" placeholder="Epasts">
                </div>

                <div class="input-group">
                    <input type="text" name="uid" placeholder="Lietotājvārds">
                </div>

                <div class="input-group">
                    <input type="password" name="pwd" placeholder="Parole">
                </div>

                <div class="input-group">
                    <input type="password" name="pwdrepeat" placeholder="Parole atkārtoti">
                </div>

                <button type="submit" name="submit">Reģistrēties</button>
            </form>
        </div>
    </section>
    <?php include_once 'footer.php'; ?>