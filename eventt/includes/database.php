<?php
declare(strict_types=1);
function getConnection(): mysqli
{
    $hostname = 'bk3tbnlweieopf2oqlth-mysql.services.clever-cloud.com';
    $dbName = 'bk3tbnlweieopf2oqlth';   // ใส่ชื่อฐานข้อมูลจริงของคุณ
    $username = 'u2oo8gcytw0r7adc';
    $password = 'NGtADcCvjKdLcq9AQMiK';
    $port     = 3306;

    $conn = new mysqli($hostname, $username, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// database functions ต่างๆ
require_once __DIR__ . '/../databases/students.php';
require_once __DIR__ . '/../databases/courses.php';
require_once __DIR__ . '/../databases/users.php';
require_once __DIR__ . '/../databases/events.php';
