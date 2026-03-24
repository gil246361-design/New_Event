<?php
declare(strict_types=1);

function getUsers(): array
{
    $conn = getConnection();

    $sql = "SELECT * FROM users ORDER BY user_id ASC";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query Error: " . $conn->error);
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $conn->close();
    return $data;
}

function getUsersByKeyword(string $keyword): array
{
    $conn = getConnection();

    $sql = "SELECT * FROM users
            WHERE name LIKE ?
               OR mail LIKE ?
               OR telno LIKE ?
               OR role LIKE ?
               OR CAST(user_id AS CHAR) LIKE ?
            ORDER BY user_id ASC";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare Error: " . $conn->error);
    }

    $search = "%{$keyword}%";
    $stmt->bind_param("sssss", $search, $search, $search, $search, $search);
    $stmt->execute();

    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $data;
}

function getUserById(int $user_id): ?array
{
    $conn = getConnection();

    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare Error: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $data ?: null;
}

function updateUserPassword(int $user_id, string $hashed_password): int
{
    $conn = getConnection();

    $sql = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare Error: " . $conn->error);
    }

    $stmt->bind_param("si", $hashed_password, $user_id);
    $stmt->execute();

    $affected = $stmt->affected_rows;

    $stmt->close();
    $conn->close();

    return $affected;
}


function getUserById2(int $userId): ?array
{

    $conn = getConnection();

    $sql = "
        SELECT user_id, name, mail, telno, role
        FROM users
        WHERE user_id = ?
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $userId);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $user ?: null;

}
function insertUser(array $user): bool
{
    $conn = getConnection();
    
    $sql = "INSERT INTO users (name, mail, telno, password, role) VALUES (?, ?, ?, ?, 'member')";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssss", 
        $user['name'], 
        $user['mail'], 
        $user['telno'], 
        $user['hashed_password']
    );

    $result = $stmt->execute();
    
    $stmt->close();
    $conn->close();

    return $result;
}