<?php

$conn = mysqli_connect("localhost", "root", "", "PCDC");

if (!$conn) {
    echo "Connection Failed";
}