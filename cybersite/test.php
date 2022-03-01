<?php


    date_default_timezone_set('Europe/Riga');

    $dateTime = new DateTime();
    echo $dateTime->format('Y-m-d H:i:s')  . " current time<br/>";


    // $dateTime = new DateTime('2009-10-11 12:12:00');

    $time = '2022-03-01 7:52:58';
    $fromDB = new DateTime($time);

    $interval = $dateTime->diff($fromDB);

    echo $interval->s . " s<br/>";
    echo $interval->h. " h<br/>";
    echo $interval->d . " d<br/>";

    if ($interval->h > 6) {
        echo "This post is longer than 6 hours";
        echo $fromDB->format('Y-m-d H:i');
        
    }

?>