<?php
    /** 
     * Data filter
     * 
     * @param string $data unfiltred data
     * @return string $data filtered data
     */
    function secure(string $data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /** 
     * comfort print_r
     * 
     * @param string $array | array with uncomfort data
     */
    function show($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }