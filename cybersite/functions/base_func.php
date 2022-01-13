<?php

/** 
 * Data filter
 * 
 * @param string $data neatfiltretie dati
 * @return string $data atfiltretie dati
 */
function security(string $data):string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// smart print
function printArray(array $data):void {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}