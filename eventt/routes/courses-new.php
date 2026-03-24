<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = [
        'name' => $_POST['name'] ?? '',
        'code' => $_POST['code'] ?? '',
        'instructor' => $_POST['instructor'] ?? '',
    ];
    if (insertCourse($course)) {
        renderView('courses-new', ['message' => 'เพิ่มข้อมูลคอร์สเรียบร้อยแล้ว']);
    } else {
        echo "Error inserting course.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    renderView('courses-new');
}