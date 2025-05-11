<?php
    $server="localhost";
    $user="root";
    $password="";
    $db_name="mangasite";

    $conn = new mysqli("localhost", "root", "", "mangasite");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
