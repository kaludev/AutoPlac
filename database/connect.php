<?php
    $servername = "localhost";
    $usern = "root";
    $password = "";
    $dbname = "autoplac";

    $conn = new mysqli($servername, $usern, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>