<?php
declare(strict_types=1);

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized");
}

$id = $_GET['id'] ?? null;

if ($id === null || !ctype_digit($id)) {
    die("Invalid event id");
}

$event = getEventById((int)$id);

if (!$event || $_SESSION['user_id'] != $event['event_owner']) {
    die("Unauthorized");
}

renderView('event_upload_photo', [
    'title' => 'Upload Photo',
    'event' => $event
]);