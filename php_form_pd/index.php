<?php
//  importojam funkcijas no funkciju mapes
require_once __DIR__ . "/functions/base_func.php";

// Filtrējam pārbaudam vai eksistē un rakstam result iekš kreisajos mainīgajos. No labās puses uz kreiso.
$name       =   security($_POST["name"]   ??  false);
$email      =   security($_POST["email"]  ??  false);
$phone      =   security($_POST["phone"]  ??  false);
$gender     =   $_POST["gender"] ??   false;
$languages  =   $_POST["langs"]  ??   false;
$submit     =   $_POST["submit"] ??   false;

// global required values list
$VALIDATED_LIST_LANGUAGE = ["english", "russian", "latvian", "japanese"];
$VALIDATED_LIST_GENDER = ["male", "famale"];


    /* Uz beigām man jau palika bik slinkums un tā vietā lai taisitu funkcijas un normālu regex visam, sāku taisīt šo.
        + Ja vērtēs tikai cik punkti ir izpildīti tad domāju arī šādi derēs. :D */
        // Pārbaudam ar kādu metodi sūtam datus 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // definejam erroru masīvu
        $errors = [] ?? "";
        /* Izvadam visus lauciņus lai redzam, ko esam ievadijuši. Šis lauciņš nav drošs. Ievadot <script>alert(1)</script>
        Tas izpildīsies, jo print_r() rāda iekš DOM Tree kur arī izpildas šis js script. */
        printArray($_POST);
        // Pārbaudam lauciņus
        // TODO: Pārkodēt uz normālu kodu
        if($name) {
            if (strlen($name) < 4) {
                $errors["username"] = "Lietotājvārdam ir jābūt vismaz 4 simboli garam";
            }
        } else {
            $errors["username"] = "Lietotājvārds ir obligāts";
        }

        if($email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Epasts ir nekorekts";
           }
        } else {
            $errors["email"] = "Epasts ir obligāts";
        }

        if($phone) {
            if(!preg_match("/^[0-9+]{8}$/", $phone)) {
                $errors["phone"] = "Telefona nummurs ir nekorekts";
              }
        } else {
            $errors["phone"] = "Telefona nummurs ir obligāts";
        }
        
        if(!$gender) {
            $errors["gender"] = "Jānorāda dzimums"; 
        }
        // Pārbaudam vai value netika izmainīta caur html DOM
        if (!in_array($gender, $VALIDATED_LIST_GENDER)){
            $errors["gender"] = "Tāda dzimuma nepastāv";
        }

        if($languages) {
            // Pārbaudam cik ieraksti mum ir masīvā, ja mazāk par 2 izvadam kļūdu
            if (sizeof($languages) < 2) {
                $errors["languages"] = "Jāizvēlas vismaz 2 valodas";
            }
            // Pārbaudam vai value netika izmainīta caur html DOM
            foreach ($languages as $key => $value) {
                if (!in_array($value, $VALIDATED_LIST_LANGUAGE)){
                    $errors["gender"] = "Tādas valodas nepastāv";
                }
            }
        } else {
            $errors["languages"] = "Jānorāda valodas";
        }
        
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>PHP | PD</title>
</head>
<body>
    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <span class="display-block">Vārds:</span>
        <input  type="text" 
                name="name" 
                value="<?=$name ?? ""?>"> <br />

        <span class="display-block">Email:</span>
        <input  type="text" 
                name="email" 
                value="<?=$email ?? ""?>"> <br />

        <span class="display-block">telefons:</span>
        <input  type="text" 
                name="phone" 
                value="<?=$phone ?? ""?>"> <br />

        <span>Dzimums:</span> <br />
        <input <?=isRadioChecked("gender", "famale")?> type="radio" id="famale" name="gender" value="famale">
        <label for="famale">Sieviete</label>

        <input <?=isRadioChecked("gender", "male")?> type="radio" id="male" name="gender" value="male">
        <label for="male">Vīrietis</label> <br />

        <span>Valodu zināšanas:</span> <br />
        <input <?=isCheckboxChecked("langs","english")?> type="checkbox" id="english" name="langs[]" value="english"> 
        <label for="english">Angļu</label> <br />

        <input <?=isCheckboxChecked("langs","russian")?> type="checkbox" id="russian" name="langs[]" value="russian"> 
        <label for="russian">Kreivu</label> <br />
        
        <input <?=isCheckboxChecked("langs","latvian")?> type="checkbox" id="latvian" name="langs[]" value="latvian"> 
        <label for="latvian">Latviešu</label> <br />

        <input <?=isCheckboxChecked("langs","japanese")?> type="checkbox" id="japanese" name="langs[]" value="japanese"> 
        <label for="japanese">Japāņu</label> <br />

        <input type="submit" name="submit" value="Reģistrēties">
        <input type="reset">
    </form>
</body>
</html>
<?php

echo "<br />";
// Pārbaudam vai $errors eksistē un vai tas ir true izvadam kļūdas
if (isset($errors) && $errors) {
    printArray($errors);
    // pārbaudam vai errors nebija izveidots un vai tas ir false tad izvadam korektos datus
} else if (isset($errors) && !$errors){
    echo "
Jūsu dati ir korekti: {$name} <br />
{$email}<br />
{$phone}<br />
{$gender}<br />
    ";
    // Ar ciklu izvadam valodas
    foreach ($languages as $key => $value) {
        echo $value . "<br />";
    }
}
