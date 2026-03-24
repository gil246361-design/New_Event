<?php

declare(strict_types=1);

$event = null;
$memberCount = 0;
$members = [];
$photos = [];

$id = $_GET['id'] ?? null;

if ($id !== null && ctype_digit($id)) {

    $eventId = (int)$id;

    $event = getEventById($eventId);

    if ($event !== null) {
        $memberCount = getEventMemberCount($eventId);
        $members = getEventMembersForDetail($eventId);
        $photos = getEventPhotos($eventId);
    }
}

/* ===== ตรวจสิทธิ์ Checkin ===== */

$canCheckin = false;

if (isset($_SESSION['user_id']) && $event !== null) {

    $userId = (int)$_SESSION['user_id'];

    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT status, checkin_time
        FROM event_members
        WHERE event_id = ? AND user_id = ?
    ");

    $stmt->bind_param("ii", $eventId, $userId);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    if ($result && $result['status'] === 'approved') {
        $canCheckin = true;
    }

    $conn->close();
}

/* ===== ตรวจว่าเช็คอินแล้วหรือยัง ===== */

$alreadyCheckedIn = false;

if (isset($_SESSION['user_id']) && $event !== null) {

    $userId = (int)$_SESSION['user_id'];

    foreach ($members as $m) {

        if ($m['user_id'] == $userId && !empty($m['checkin_time'])) {
            $alreadyCheckedIn = true;
            break;
        }

    }
}

/* ===== ตรวจว่าเป็นเจ้าของ event ===== */

$isOwner = false;

if (isset($_SESSION['user_id']) && $event !== null) {

    if ($_SESSION['user_id'] == $event['event_owner']) {
        $isOwner = true;
    }
}

/* ===== คำนวณสถิติ ===== */

$stats = [
    'approved' => 0,
    'pending' => 0,
    'rejected' => 0,
    'checkedin' => 0
];

foreach ($members as $m) {

    if ($m['status'] === 'approved') {
        $stats['approved']++;
    }

    if ($m['status'] === 'pending') {
        $stats['pending']++;
    }

    if ($m['status'] === 'rejected') {
        $stats['rejected']++;
    }

    if (!empty($m['checkin_time'])) {
        $stats['checkedin']++;
    }

}

renderView('event_detail', [
    'title'            => 'Event Detail',
    'event'            => $event,
    'memberCount'      => $memberCount,
    'members'          => $members,
    'photos'           => $photos,
    'canCheckin'       => $canCheckin,
    'alreadyCheckedIn' => $alreadyCheckedIn,
    'isOwner'          => $isOwner,
    'stats'            => $stats
]);