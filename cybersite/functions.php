<?php

    /** 
     * Data filter
     * 
     * @param string $data neatfiltretie dati
     * @return string $data atfiltretie dati
     */
    function filter($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /** 
     * Smart print
     * 
     * @param string $array 
     * @return string $data atfiltretie dati
     */
    function show(array $array, string $comment = "debug") {
        echo "<pre>";
        print_r($array);
        echo ' <= ' .$comment;
        echo "</pre>";
    }