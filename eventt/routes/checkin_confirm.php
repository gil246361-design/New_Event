<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

/* อนุญาตเฉพาะ POST */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /");
    exit;
}

/* ===== รับข้อมูลจาก form ===== */

$eventId = $_POST['event_id'] ?? null;
$userInput = trim($_POST['otp_input'] ?? '');


/* ===== ตรวจ event id ===== */

if (!$eventId || !ctype_digit($eventId)) {
    header("Location: /");
    exit;
}

$eventId = (int)$eventId;


/* ===== ตรวจ OTP มีอยู่หรือไม่ ===== */

if (!isset($_SESSION['otp_code']) || !isset($_SESSION['otp_expire'])) {

    header("Location: /checkin_otp?event_id=" . $eventId . "&msg=otp_missing");
    exit;

}

$now = time();


/* ===== ตรวจ OTP หมดอายุ ===== */

if ($now > $_SESSION['otp_expire']) {

    unset($_SESSION['otp_code'], $_SESSION['otp_expire']);

    header("Location: /checkin_otp?event_id=" . $eventId . "&msg=otp_expired");
    exit;

}


/* ===== ตรวจ OTP ถูกต้องหรือไม่ ===== */

if ($userInput !== (string)$_SESSION['otp_code']) {

    header("Location: /checkin_otp?event_id=" . $eventId . "&msg=otp_invalid");
    exit;

}


/* ===== บันทึก check-in ===== */

$userId = (int)$_SESSION['user_id'];

if (!checkinEvent($eventId, $userId)) {

    header("Location: /event_detail?id=" . $eventId . "&msg=not_member");
    exit;

}


/* ===== ล้าง OTP หลังใช้ ===== */

unset($_SESSION['otp_code'], $_SESSION['otp_expire']);


/* ===== redirect เมื่อสำเร็จ ===== */

header("Location: /event_detail?id=" . $eventId . "&msg=checkin_success");
exit;