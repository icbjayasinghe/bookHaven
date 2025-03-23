<?php
    // print_r("hello 3");
    $conn = new mysqli("localhost:3306", "root", "root", "bookhaven_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>