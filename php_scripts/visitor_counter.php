<?php

    require_once '../connection.php';


    function getVisitors() {
        $db = connect();
        $sql = "SELECT * FROM stats";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if ($row["name"] == "visitors") {
                    return $row["value"];
                }
            }
        } else {
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
                if ($row["name"] == "visitors") {
                    $visitors = $row["value"];
                    $visitors++;
                    $sql = "UPDATE stats SET value = '$visitors' WHERE name = 'visitors'";
                    $db->query($sql);
                }
            }
        } else {
            $sql = "INSERT INTO stats (name, value) VALUES ('visitors', '1')";
            $db->query($sql);
        }   

    }





?>