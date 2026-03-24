<?php

declare(strict_types=1);

/**
 * ดึงข้อมูลนักเรียนทั้งหมด
 */
function getStudents(): mysqli_result|bool
{
    $conn = getConnection();

    $sql = "SELECT 
                student_id,
                first_name,
                last_name,
                phone_number,
                email
            FROM students";

    return $conn->query($sql);
}


/**
 * ค้นหานักเรียนด้วย keyword (ค้นจาก first_name หรือ last_name)
 */
function getStudentsByKeyword(string $keyword): mysqli_result|bool
{
    $conn = getConnection();

    $sql = "SELECT 
                student_id,
                first_name,
                last_name,
                phone_number,
                email
            FROM students
            WHERE first_name LIKE ? 
               OR last_name LIKE ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $search = '%' . $keyword . '%';
    $stmt->bind_param('ss', $search, $search);
    $stmt->execute();

    return $stmt->get_result();
}


function deleteStudentsById(int $id): bool
{
    $conn = getConnection();
    $sql = 'delete from students where student_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    try {
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

function getStudentById(int $id): mysqli_result|bool
{
    $conn = getConnection();  // ✅ ใช้แบบนี้

    $sql = 'select * from students where student_id = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();

    return $stmt->get_result();
}

function updateStudentPassword(int $id, string $hashed_password): bool
{
    $conn = getConnection();  // ✅ ใช้แบบนี้

    $sql = 'update students set password = ? where student_id = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('si', $hashed_password, $id);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

function checkLogin(string $email, string $password): bool
{
    $conn = getConnection();   // ✅ ถูกต้อง

    $sql = 'select password from students where email = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return password_verify($password, $row['password']);
    }

    return false;
}