<?php

declare(strict_types=1);

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

$event_id = (int)($_POST['event_id'] ?? 0);
$user_id  = (int)($_POST['user_id'] ?? 0);
$action   = $_POST['action'] ?? '';

$event = getEventById($event_id);

if (!$event) {
    header("Location: /events");
    exit;
}

/* อนุญาตเฉพาะเจ้าของกิจกรรม */

if ($_SESSION['user_id'] != $event['event_owner']) {
    header("Location: /event_detail?id=".$event_id);
    exit;
}

if ($action === 'approve') {

    updateMemberStatus($event_id, $user_id, 'approved');

}

if ($action === 'reject') {

    updateMemberStatus($event_id, $user_id, 'rejected');

}

header("Location: /event_detail?id=".$event_id);
exit;