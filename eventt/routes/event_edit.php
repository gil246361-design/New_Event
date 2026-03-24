<?php

if (!isset($_GET['id'])) {
    die("Event ID is required");
}

$event_id = (int) $_GET['id'];

/* =========================
   ถ้า submit form
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'event_name'  => $_POST['event_name'] ?? '',
        'description' => $_POST['description'] ?? '',
        'amount_user' => (int) ($_POST['amount_user'] ?? 0),
        'location'    => $_POST['location'] ?? '',
        'start'       => $_POST['start'] ?? '',
        'end'         => $_POST['end'] ?? ''
    ];

    if (updateEvent($event_id, $data)) {
        header("Location: /events");
        exit;
    } else {
        $error = "Update failed";
    }
}

/* =========================
   โหลดข้อมูลเดิม
========================= */
$event = getEventById($event_id);

if (!$event) {
    die("Event not found");
}

renderView('event_edit', [
    'event' => $event,
    'error' => $error ?? null
]);