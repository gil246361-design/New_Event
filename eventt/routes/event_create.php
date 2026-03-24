<?php declare(strict_types=1);

$title = 'Create Event';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }

    $conn = getConnection();   // 🔥 สำคัญ

    $data = [
        'event_name'  => trim($_POST['event_name'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'amount_user' => (int)($_POST['amount_user'] ?? 0),
        'location'    => trim($_POST['location'] ?? ''),
        'start'       => date('Y-m-d H:i:s', strtotime($_POST['start'] ?? '')),
        'end'         => date('Y-m-d H:i:s', strtotime($_POST['end'] ?? '')),
    ];

    $owner_id = (int)$_SESSION['user_id'];

    $success = createEvent($conn, $data, $owner_id);

    if (!$success) {
        $_SESSION['error'] = 'Create event failed';
        header('Location: /event_create');
        exit;
    }

    header('Location: /events');
    exit;
}

include TEMPLATES_DIR . '/event_create.php';