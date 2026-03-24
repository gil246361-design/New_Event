<?php
declare(strict_types=1);

// ตรวจสอบว่าเข้าสู่ระบบหรือยัง
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = (int)$_POST['event_id'];
    $user_id  = (int)$_SESSION['user_id'];

    // เรียกฟังก์ชันลบข้อมูล
    leaveEvent($event_id, $user_id);

    // เมื่อลบเสร็จให้กลับไปที่หน้ากิจกรรมของฉัน
    header("Location: /my_evens");
    exit;
}
if (!isset($_SESSION['user_id'])) {
    header("Location: /my_evens?msg=leave_success");
    exit;
}
