<?php

declare(strict_types=1);

$result = [];
$keyword = $_GET['keyword'] ?? '';

if ($keyword === '') {
    // ดึงข้อมูลรายวิชาทั้งหมด
    $result = getCourses();
} else {
    // ค้นหารายวิชาด้วย keyword
    $result = getCoursesByKeyword($keyword);
}

renderView('courses', [
    'title'   => 'Course Information',
    'result'  => $result,
    'keyword' => $keyword
]);