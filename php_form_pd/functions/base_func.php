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

/** 
 * Parbaudam vai poga ir nospiesta un ja ir lai paliek nospiesta
 * 
 * @param string $post kadu pogu parbaudam
 * @param string $gender ar ko parbaudam 
 * @return void 
 */
function isRadioChecked(string $post, string $gender) {
    if (isset($_POST[$post]) && $_POST[$post] == $gender){
        return "checked ";
    }
}

/** 
 * Parbaudam vai poga ir nospiesta un ja ir lai paliek nospiesta
 * 
 * @param string $post kadu pogu parbaudam
 * @param string $gender ar ko parbaudam
 * @return void
 */
function isCheckboxChecked(string $post, string $language) {
    if (isset($_POST[$post]) && in_array($language, $_POST[$post])) {
        return "checked ";
    }
}
// smart print
function printArray(array $data):void {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}