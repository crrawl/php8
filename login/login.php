<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <link rel="stylesheet" href="assets/fonts/fonts.css">

    <title>C.I.A TERMINAL</title>
</head>
<body>
    <img class="cia-logo" src="assets/images/cia_logo.png" alt="cia logo">
    <h1 class="header">C.I.A TERMINAL</h1>
    <form class="content" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <div class="input-field">
            <label for="name">AGENT</label>
            <input type="text">
        </div>
        <div class="input-field">
        <label for="password">PASSWORD</label>
            <input type="text">
        </div>
        <div class="input-field">
            <label for="scode">SECURITY CODE</label>
            <input type="text">
        </div>

        <button class="submit">
            <span class="submit-txt">Press on the box below to authorize</span>
            <img src="assets/images/nospiedums.png" alt="nospiedums">
        </button>

    </form>
    <p class="copyright">
        You are entering a secured United States Government system which may be used only for authorised purposes. Modification of any information in this system is subject to criminal prosecution. The C.I.A. monitors all usage of this system. All persons are hereby notified that the use of this system constitutes consent to such monitoring and auditing.
    </p>
</body>
</html>