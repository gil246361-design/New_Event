<?php

declare(strict_types=1);

/**
 * ดึงข้อมูลรายวิชาทั้งหมด
 */
function getCourses(): mysqli_result|bool
{
    $conn = getConnection();

    $sql = "SELECT 
                course_id,
                course_code,
                course_name,
                instructor
            FROM courses";

    return $conn->query($sql);
}


/**
 * ค้นหารายวิชาด้วย keyword
 */
function getCoursesByKeyword(string $keyword): mysqli_result|bool
{
    $conn = getConnection();

    $sql = "SELECT 
                course_id,
                course_code,
                course_name,
                instructor
            FROM courses
            WHERE course_code LIKE ?
               OR course_name LIKE ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $search = '%' . $keyword . '%';
    $stmt->bind_param('ss', $search, $search);
    $stmt->execute();

    return $stmt->get_result();
}


/**
 * ลบรายวิชาตาม id
 */
function deleteCourseById(int $id): bool
{
    $conn = getConnection();

    $sql = 'DELETE FROM courses WHERE course_id = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}


/**
 * ดึงรายวิชาตาม id
 */
function getCourseById(int $id): mysqli_result|bool
{
    $conn = getConnection();

    $sql = 'SELECT * FROM courses WHERE course_id = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();

    return $stmt->get_result();
}


/**
 * เพิ่มรายวิชาใหม่
 */
function insertCourse(array $course): bool
{
    $conn = getConnection();

    $sql = 'INSERT INTO courses (course_name, course_code, instructor)
            VALUES (?, ?, ?)';

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        'sss',
        $course['name'],
        $course['code'],
        $course['instructor']
    );

    $stmt->execute();

    return $stmt->affected_rows > 0;
}