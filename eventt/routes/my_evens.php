<?php
declare(strict_types=1);

// ตรวจสอบว่า Login หรือยัง
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

$user_id = (int)$_SESSION['user_id'];

// กิจกรรมที่เป็นเจ้าของ
$owner_events = getEventsByOwner($user_id);

// กิจกรรมที่เข้าร่วม (ของเดิม)
$my_events = getMyJoinedEvents($user_id);

renderView('my_events', [
    'title' => 'My Events',
    'events' => $my_events,
    'owner_events' => $owner_events
]);