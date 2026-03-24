<?php
declare(strict_types=1);
function getConnection(): mysqli
{
    $hostname = 'sql100.infinityfree.com';
    $dbName = 'if0_41252696_enrollment';   // ใส่ชื่อฐานข้อมูลจริงของคุณ
    $username = 'if0_41252696';
    $password = 'E4obGY3o3Aq7e';

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
