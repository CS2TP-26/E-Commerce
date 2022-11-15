<?php

    require_once '../connection.php';


    function getVisitors() {
        $db = connect();
        $sql = "SELECT * FROM stats";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["NAME"] == "visitors") {
                    return $row["VALUE"];
                    
                }
            }
        } else {
            echo '0 results';

            return '0';
        }   

    }



    function incrementVisitors() {
        $db = connect();
        $sql = "SELECT * FROM stats";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if ($row["NAME"] == "visitors") {
                    $visitors = $row["VALUE"];
                    $visitors++;
                    $sql = "UPDATE stats SET VALUE = '$visitors' WHERE name = 'visitors'";
                    $db->query($sql);
                }
            }
        } else {
            $sql = "INSERT INTO stats (NAME, VALUE) VALUES ('visitors', '1')";
            $db->query($sql);
        }   

    }

    echo getVisitors();



?>