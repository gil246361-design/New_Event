<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // เช็ครหัสผ่านตรงกันหรือไม่
    if ($password !== $confirm_password) {
        renderView('register', [
            'title' => 'สมัครสมาชิก',
            'message' => '<span style="color: red;">รหัสผ่านไม่ตรงกัน!</span>'
        ]);
        exit;
    }

    // เตรียมข้อมูล
    $user = [
        'name' => $_POST['name'] ?? '',
        'mail' => $_POST['mail'] ?? '',
        'telno' => $_POST['telno'] ?? '',
        'hashed_password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    // บันทึกข้อมูล
    if (insertUser($user)) {
        // เมื่อสมัครสำเร็จ ให้เปลี่ยนหน้าไปยัง /login ทันที
        header("Location: /login");
        exit; // ต้องใส่ exit เสมอหลังใช้คำสั่ง header เพื่อหยุดการทำงานของสคริปต์
    } else {
        // เมื่อไม่สำเร็จ (เช่น มีอีเมลนี้ในระบบแล้ว)
        renderView('register', [
            'title' => 'สมัครสมาชิก',
            'message' => '<span style="color: red;">เกิดข้อผิดพลาดในการสมัครสมาชิก (หรืออีเมลนี้มีในระบบแล้ว)</span>'
        ]);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    renderView('register', ['title' => 'สมัครสมาชิก']);
}