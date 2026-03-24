<?php
declare(strict_types=1);

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$event_id = $_POST['event_id'] ?? null;

if ($event_id === null || !ctype_digit($event_id)) {
    die("Invalid event id");
}

$event = getEventById((int)$event_id);

if (!$event || $_SESSION['user_id'] != $event['event_owner']) {
    die("Unauthorized");
}

if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== 0) {
    die("Upload failed");
}

$filename = time() . "_" . basename($_FILES['photo']['name']);
$targetPath = __DIR__ . "/../uploads/" . $filename;

move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath);

$conn = getConnection();
$stmt = $conn->prepare("INSERT INTO event_photos (event_id, url) VALUES (?, ?)");
$stmt->bind_param("is", $event_id, $filename);
$stmt->execute();
$conn->close();

header("Location: /event_detail?id=" . $event_id);
exit;