<html>

<head></head>

<body>
    <?php include 'header.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1>เปลี่ยนรหัสผ่าน</h1>
        <?php
        if (isset($data['result'])) {
            $row = $data['result']->fetch_object();
        ?>
            <label for="first_name"><?= $row->first_name ?></label> <label for="last_name"><?= $row->last_name ?></label><br>
            <form action="students-chgpwd?id=<?= $row->student_id ?>" method="post">
                <label for="password">Password</label><br>
                <input type="password" name="password"><br>
                <label for="confirmpassword">Confirm Password</label><br>
                <input type="password" name="confirm_password"><br>
                <button type="submit">Update</button>
            </form>
        <?php
        }
        ?>
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->

    <?php include 'footer.php' ?>
</body>

</html>