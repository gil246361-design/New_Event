<?php

declare(strict_types=1);

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = (int)$_POST['event_id'];
    $user_id  = (int)$_SESSION['user_id'];

    $success = joinEvent($event_id, $user_id);

   if ($success) {
            // สำเร็จ
            header("Location: /events?msg=join_success");
        } else {
            // ผิดพลาด
            header("Location: /events?msg=error");
        }
        exit;
	
}

$event_id = (int)($_POST['event_id'] ?? 0);
$user_id  = (int)$_SESSION['user_id'];

if ($event_id > 0 && !isUserJoined($event_id, $user_id)) {
    joinEvent($event_id, $user_id);
}

header("Location: /events");
exit;