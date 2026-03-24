<?php

declare(strict_types=1);

/* =====================================================
   ดึงรายการ Events ทั้งหมด (หน้า /events ใช้ตัวนี้)
===================================================== */
function getEvents(): array
{
    $conn = getConnection();

    $sql = "
        SELECT e.*, p.photo_id, p.url
        FROM events e
        LEFT JOIN event_photos p 
            ON e.event_id = p.event_id
        ORDER BY e.start ASC
    	";

    $result = $conn->query($sql);

    if (!$result) {
        die("Query Error: " . $conn->error);
    }

    $events = [];

    while ($row = $result->fetch_assoc()) {
        $id = $row['event_id'];

        if (!isset($events[$id])) {
            $events[$id] = [
                'event_id'    => $row['event_id'],
                'event_name'  => $row['event_name'],
                'description' => $row['description'],
                'amount_user' => $row['amount_user'],
                'location'    => $row['location'],
                'start'       => $row['start'],
                'end'         => $row['end'],
                'event_owner' => $row['event_owner'],
                'photos'      => []
            ];
        }

        if (!empty($row['url'])) {
            $events[$id]['photos'][] = $row['url'];
        }
    }

    $conn->close();

    return array_values($events);
}


/* =====================================================
   ดึงข้อมูล Event ตาม ID (หน้า event_detail ใช้)
===================================================== */
function getEventById(int $event_id): ?array
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT * 
        FROM events 
        WHERE event_id = ?
    ");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    $conn->close();

    return $event ?: null;
}


/* =====================================================
   นับจำนวนผู้เข้าร่วม
===================================================== */
function getEventMemberCount(int $event_id): int
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT COUNT(*) as total
        FROM event_members
        WHERE event_id = ?
    ");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    $conn->close();

    return (int) $result['total'];
}


/* =====================================================
   ดึงรายชื่อผู้เข้าร่วม (พร้อมสถานะเช็คอิน)
===================================================== */
function getEventMembers(int $event_id): array
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT 
            u.user_id, 
            u.name, 
            u.mail,
            em.checkin_time
        FROM event_members em
        JOIN users u ON em.user_id = u.user_id
        WHERE em.event_id = ?
        ORDER BY u.name ASC
    ");

    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $members = [];
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }

    $conn->close();
    return $members;
}

/* =====================================================
   ค้นหา Events ตาม keyword
===================================================== */
function getEventsByKeyword(string $keyword): array
{
    $conn = getConnection();

    $keyword = "%" . $keyword . "%";

    $stmt = $conn->prepare("
        SELECT e.*, p.photo_id, p.url
        FROM events e
        LEFT JOIN event_photos p 
            ON e.event_id = p.event_id
        WHERE e.event_name LIKE ?
           OR e.description LIKE ?
           OR e.location LIKE ?
        ORDER BY e.start ASC
    ");

    $stmt->bind_param("sss", $keyword, $keyword, $keyword);
    $stmt->execute();

    $result = $stmt->get_result();

    $events = [];

    while ($row = $result->fetch_assoc()) {
        $id = $row['event_id'];

        if (!isset($events[$id])) {
            $events[$id] = [
                'event_id'    => $row['event_id'],
                'event_name'  => $row['event_name'],
                'description' => $row['description'],
                'amount_user' => $row['amount_user'],
                'location'    => $row['location'],
                'start'       => $row['start'],
                'end'         => $row['end'],
                'event_owner' => $row['event_owner'],
                'photos'      => []
            ];
        }

        if (!empty($row['url'])) {
            $events[$id]['photos'][] = $row['url'];
        }
    }

    $conn->close();

    return array_values($events);
}

/*=======================================
				ค้นหากิจกรรม
========================================*/
function getEventsBySearch(string $keyword, string $start_date, string $end_date): array
{
    $conn = getConnection();
    
    //เริ่มต้นคำสั่ง SQL
    $sql = "SELECT e.*, p.photo_id, p.url 
            FROM events e 
            LEFT JOIN event_photos p ON e.event_id = p.event_id 
            WHERE 1=1";
    
    $params = [];
    $types = "";

    //ตรวจสอบเงื่อนไขชื่อกิจกรรม
    if ($keyword !== '') {
        $sql .= " AND e.event_name LIKE ?";
        $params[] = "%$keyword%";
        $types .= "s";
    }

    //ตรวจสอบเงื่อนไขวันที่เริ่มต้น 
   if ($start_date !== '') {
    $sql .= " AND DATE(e.start) >= DATE(?)"; 
    $params[] = $start_date;
    $types .= "s";
	}

    //ตรวจสอบเงื่อนไขวันที่สิ้นสุด 
    if ($end_date !== '') {
        $sql .= " AND DATE(e.end) <= DATE(?)";
        $params[] = $end_date;
        $types .= "s";
    }

    $sql .= " ORDER BY e.start ASC";
    
    $stmt = $conn->prepare($sql);
    
    // ผูกค่าตามจำนวนเงื่อนไข
    if ($types !== "") {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $id = $row['event_id'];
        if (!isset($events[$id])) {
            $events[$id] = [
                'event_id' => $row['event_id'], 
                'event_name' => $row['event_name'], 
                'description' => $row['description'], 
                'amount_user' => $row['amount_user'], 
                'location' => $row['location'], 
                'start' => $row['start'], 
                'end' => $row['end'], 
                'event_owner' => $row['event_owner'], 
                'photos' => []
            ];
        }
        if (!empty($row['url'])) {
            $events[$id]['photos'][] = $row['url'];
        }
    }
    $conn->close();
    return array_values($events);
}

/* =====================================================
   ตรวจสอบว่า user เข้าร่วมแล้วหรือยัง
===================================================== */
function isUserJoined(int $event_id, int $user_id): bool
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT 1 FROM event_members 
        WHERE event_id = ? AND user_id = ?
    ");
    $stmt->bind_param("ii", $event_id, $user_id);
    $stmt->execute();

    $stmt->store_result();
    $exists = $stmt->num_rows > 0;

    $conn->close();
    return $exists;
}


function joinEvent(int $event_id, int $user_id): bool
{
    $conn = getConnection();
    $conn->begin_transaction();

    try {
        // 1. เช็คว่าสมัครไปแล้วหรือยัง
        $stmt = $conn->prepare("
            SELECT 1 FROM event_members 
            WHERE event_id = ? AND user_id = ?
        ");
        $stmt->bind_param("ii", $event_id, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $conn->rollback();
            $conn->close();
            return false;
        }

        // 2. เช็คจำนวนคนเต็มหรือยัง
        $stmt = $conn->prepare("
            SELECT amount_user,
                   (SELECT COUNT(*) FROM event_members WHERE event_id = ?) as current_count
            FROM events
            WHERE event_id = ?
            FOR UPDATE
        ");
        $stmt->bind_param("ii", $event_id, $event_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result || $result['current_count'] >= $result['amount_user']) {
            $conn->rollback();
            $conn->close();
            return false;
        }

        // ✅ 3. สมัครโดยไม่ใส่เวลาเช็คอิน
        $stmt = $conn->prepare("
            INSERT INTO event_members (event_id, user_id, status, checkin_time)
            VALUES (?, ?, 'pending', NULL)
        ");
        $stmt->bind_param("ii", $event_id, $user_id);
        $stmt->execute();

        $conn->commit();
        $conn->close();
        return true;

    } catch (Exception $e) {
        $conn->rollback();
        $conn->close();
        return false;
    }
}
	


/* =====================================================
   ออกจากกิจกรรม
===================================================== */
function leaveEvent(int $event_id, int $user_id): void
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        DELETE FROM event_members
        WHERE event_id = ? AND user_id = ?
    ");
    $stmt->bind_param("ii", $event_id, $user_id);
    $stmt->execute();

    $conn->close();
}
/* =====================================================
   สร้างกิจ
===================================================== */
function createEvent(mysqli $conn, array $data, int $owner_id): bool
{
    $sql = "INSERT INTO events 
            (event_name, description, amount_user, location, start, end, event_owner)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssisssi",
        $data['event_name'],
        $data['description'],
        $data['amount_user'],
        $data['location'],
        $data['start'],
        $data['end'],
        $owner_id
    );

    return $stmt->execute();
}
/* =====================================================
   แก้ไขกิจกรรม
===================================================== */
function updateEvent(int $event_id, array $data): bool
{
    $conn = getConnection();

    $sql = "UPDATE events SET
                event_name = ?,
                description = ?,
                amount_user = ?,
                location = ?,
                start = ?,
                end = ?
            WHERE event_id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssisssi",
        $data['event_name'],
        $data['description'],
        $data['amount_user'],
        $data['location'],
        $data['start'],
        $data['end'],
        $event_id
    );

    $result = $stmt->execute();
    $conn->close();

    return $result;
}

/* =====================================================
   ดึงรายการกิจกรรมที่ User ลงทะเบียนไว้
===================================================== */
function getMyJoinedEvents(int $user_id): array
{
    $conn = getConnection();

    // ดึงข้อมูลกิจกรรมโดย Join กับตาราง event_members เพื่อดูสถานะ
    $sql = "
        SELECT e.*, em.checkin_time, em.status
        FROM event_members em
        JOIN events e ON em.event_id = e.event_id
        WHERE em.user_id = ?
        ORDER BY em.checkin_time DESC
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    $conn->close();
    return $events;
}

function updateMemberStatus(int $event_id, int $user_id, string $status): bool
{
    $conn = getConnection(); 

    $stmt = $conn->prepare("
        UPDATE event_members 
        SET status = ? 
        WHERE event_id = ? AND user_id = ?
    ");
    

    $stmt->bind_param("sii", $status, $event_id, $user_id);
    return $stmt->execute();
}
// photo
function getEventPhotos(int $event_id): array
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT url 
        FROM event_photos
        WHERE event_id = ?
        ORDER BY photo_id ASC
    ");

    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $photos = [];
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row['url'];
    }

    $conn->close();
    return $photos;
}

/* =====================================================
   เช็คอินกิจกรรม (เช็คอินซ้ำได้ ทับเวลาใหม่)
===================================================== */
function checkinEvent(int $event_id, int $user_id): bool
{
    $conn = getConnection();

    // ตรวจว่าลงทะเบียนแล้วหรือยัง
    $stmt = $conn->prepare("
        SELECT 1
        FROM event_members
        WHERE event_id = ? AND user_id = ?
    ");
    $stmt->bind_param("ii", $event_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $conn->close();
        return false; // ยังไม่ได้ join
    }

    // อัปเดตเวลาเช็คอินใหม่ทุกครั้ง
    $stmt = $conn->prepare("
        UPDATE event_members
        SET status = 'checked_in',
            checkin_time = NOW()
        WHERE event_id = ? AND user_id = ?
    ");
    $stmt->bind_param("ii", $event_id, $user_id);
    $success = $stmt->execute();

    $conn->close();
    return $success;
}

/* =====================================================
   ดึงรูปโปรไฟล์ Event (ใช้รูปแรก)
===================================================== */
function getEventProfilePhoto(array $event): string
{
    if (!empty($event['photos']) && isset($event['photos'][0])) {
        return '/uploads/' . $event['photos'][0];
    }

    return '/uploads/no_photo.png';
}

function getEventsByOwner(int $user_id): array
{
    $conn = getConnection();

    $sql = "SELECT event_id, event_name, location, start
            FROM events
            WHERE event_owner = ?
            ORDER BY start DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $events = [];

    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $events;
}

/* =====================================================
   ดึงรายชื่อผู้เข้าร่วม (version ใหม่สำหรับ event_detail)
===================================================== */
function getEventMembersForDetail(int $event_id): array
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT 
            u.user_id,
            u.name,
            u.mail,
            COALESCE(em.status,'pending') AS status,
            em.checkin_time
        FROM event_members em
        JOIN users u 
            ON em.user_id = u.user_id
        WHERE em.event_id = ?
        ORDER BY 
            CASE 
                WHEN em.status = 'pending' THEN 1
                WHEN em.status = 'approved' THEN 2
                WHEN em.status = 'rejected' THEN 3
                ELSE 4
            END,
            u.name
    ");

    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    $result = $stmt->get_result();

    $members = [];

    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }

    $conn->close();

    return $members;
}