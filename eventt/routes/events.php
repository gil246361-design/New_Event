<?php
declare(strict_types=1);

$keyword = $_GET['keyword'] ?? '';
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';

/* ===== Search Logic ===== */

$result = getEventsByKeyword($keyword, $start_date, $end_date);


/* ===== เพิ่ม profile photo ===== */

foreach ($result as &$event) {
    $event['profile_photo'] = getEventProfilePhoto($event);
}

/* ===== ซ่อน event ที่ตัวเองเป็น owner ===== */

if (isset($_SESSION['user_id'])) {

    $userId = $_SESSION['user_id'];

    $result = array_filter($result, function ($event) use ($userId) {
        return $event['event_owner'] != $userId;
    });

}

/* ===== render view ===== */

renderView('events', [
    'title'      => 'Event Management',
    'result'     => $result,
    'keyword'    => $keyword,
    'start_date' => $start_date,
    'end_date'   => $end_date
]);