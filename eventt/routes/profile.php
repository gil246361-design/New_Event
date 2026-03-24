<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

/* ===== รับ user id จาก session ===== */

$userId = (int)$_SESSION['user_id'];


/* ===== ดึงข้อมูลผู้ใช้ ===== */

$user = getUserById($userId);

if (!$user) {
    header("Location: /");
    exit;
}


/* ===== ส่งข้อมูลไป View ===== */

renderView('profile', [

    'title' => 'โปรไฟล์ผู้ใช้',

    'user' => $user

]);