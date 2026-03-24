<?php

declare(strict_types=1);

$result = [];
$keyword = $_GET['keyword'] ?? '';

if ($keyword === '') {
    // ดึงข้อมูลทั้งหมด
    $result = getStudents();
} else {
    // ค้นหาด้วย keyword
    $result = getStudentsByKeyword($keyword);
}

renderView('students', [
    'title'   => 'Student Information',
    'result'  => $result,
    'keyword' => $keyword
]);