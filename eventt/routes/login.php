<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getConnection();
    
    // 1. รับค่าและตัดช่องว่าง (trim)
    $mail = trim($_POST['mail'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. บล็อกทันทีถ้าไม่กรอกอีเมลหรือรหัสผ่าน (ป้องกัน Bug ไม่ใส่เมลก็เข้าได้)
    if (empty($mail) || empty($password)) {
        echo "กรุณากรอกอีเมลและรหัสผ่าน";
        return;
    }

    $sql = "SELECT * FROM users WHERE mail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // 3. ตรวจสอบรหัสผ่าน (ต้องมี User และรหัสผ่านต้องผ่านการ Verify)
    if ($user && password_verify($password, $user['password'])) {
        // เช็คให้แน่ใจว่า user_id มีค่าจริง (ป้องกันข้อมูลขยะใน DB)
        if (!empty($user['user_id'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: /events");
            exit;
        }
    }
    
    // ถ้าไม่เข้าเงื่อนไขข้างบน ให้แสดงข้อความนี้เสมอ
    //echo "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
    echo "<script>
alert('อีเมลหรือรหัสผ่านไม่ถูกต้อง');
history.back();
</script>";
    
} else {
    renderView('login');
}