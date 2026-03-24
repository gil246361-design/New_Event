<html>

<head>
    <meta charset="UTF-8">
    <title>เปลี่ยนรหัสผ่านผู้ใช้</title>
</head>

<body>
    <?php include 'header.php' ?>

    <main>
        <h1>เปลี่ยนรหัสผ่าน</h1>

        <?php
        if (isset($data['result']) && $data['result']) {
            $row = $data['result']; // ตอนนี้เป็น associative array
        ?>

            <p>
                <strong>ชื่อ:</strong> <?= htmlspecialchars($row['name']) ?><br>
                <strong>Email:</strong> <?= htmlspecialchars($row['mail']) ?><br>
                <strong>Role:</strong> <?= htmlspecialchars($row['role']) ?>
            </p>

            <form action="users-chgpwd?user_id=<?= $row['user_id'] ?>" method="post">
                
                <label for="password">Password</label><br>
                <input type="password" name="password" required><br><br>

                <label for="confirm_password">Confirm Password</label><br>
                <input type="password" name="confirm_password" required><br><br>

                <button type="submit">Update</button>
            </form>

        <?php
        } else {
            echo "<p>ไม่พบข้อมูลผู้ใช้</p>";
        }
        ?>
    </main>

    <?php include 'footer.php' ?>
</body>

</html>