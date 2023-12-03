<?php

    include("Params.php");

    function findConnection(){

        if(isset($mysqli) == false){
            $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
        }
        
        return $mysqli;
    }
?>