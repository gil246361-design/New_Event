<?php

declare(strict_types=1);

// 1. ตรวจสอบสิทธิ์ (Access Control)
// ถ้าไม่มี session user_id แสดงว่ายังไม่ได้ Login ให้ส่งกลับไปหน้า Login
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

// 2. เตรียมข้อมูลสำหรับแสดงผล
// ดึงข้อมูลชื่อผู้ใช้จาก Session มาเก็บไว้ใน Array เพื่อส่งให้ View
$data = [
    'title' => 'Dashboard - ระบบสมาชิก',
    'userName' => $_SESSION['user_name'] ?? 'สมาชิก'
];

// 3. เรียกใช้ View เพื่อแสดงผลหน้า Dashboard
renderView('dashboard', $data);