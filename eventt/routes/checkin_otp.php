<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

/* ===== รับ event_id ===== */

$eventId = $_GET['event_id'] ?? null;

if (!$eventId || !ctype_digit($eventId)) {
    header("Location: /?msg=invalid_event");
    exit;
}

$eventId = (int)$eventId;


/* ===== OTP อายุ 3 นาที ===== */

$now = time();

/*
เงื่อนไขสร้าง OTP ใหม่

1. ยังไม่มี OTP
2. ไม่มี expire
3. OTP หมดอายุแล้ว
*/

if (
    !isset($_SESSION['otp_code']) ||
    !isset($_SESSION['otp_expire']) ||
    $now > $_SESSION['otp_expire']
) {

    $_SESSION['otp_code'] = random_int(100000, 999999);

    $_SESSION['otp_expire'] = $now + (3 * 60);

}

/* ===== อ่านค่า OTP ===== */

$otpCode  = (string)$_SESSION['otp_code'];

$timeLeft = $_SESSION['otp_expire'] - $now;


/* ===== สร้าง QR Code URL ===== */

$qrUrl =
    "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data="
    . urlencode($otpCode);


/* ===== ส่งข้อมูลไป View ===== */

renderView('checkin_otp', [

    'title'    => 'Check-in OTP',
    'qrUrl'    => $qrUrl,
    'timeLeft' => $timeLeft,
    'eventId'  => $eventId

]);