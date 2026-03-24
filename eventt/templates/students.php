<html>

<head></head>

<body>
    <?php include 'header.php' ?>

    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1><?= $data['title'] ?></h1>
        <form action="students" method="get">
            <input type="text" name="keyword" />
            <button type="submit">Search</button>
        </form>
        <?php
        if ($data['result'] != []) {
            while ($row = $data['result']->fetch_object()) {
        ?>
                <?= $row->student_id ?>
                <?= $row->first_name ?>
                <?= $row->last_name ?>
                <?= $row->phone_number ?>
                <?= $row->email ?>
                <a href="/students-delete?id=<?= $row->student_id ?>" onclick="return confirmSubmission()">ลบข้อมูล</a>
                <a href="/students-chgpwd?id=<?= $row->student_id ?>">เปลี่ยนรหัสผ่าน</a>

                <br>
        <?php
            }
        }
        ?>
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->
    <script>
        function confirmSubmission() {
            return confirm("ยืนยันการลบข้อมูล ?");
        }
    </script>

    <?php include 'footer.php' ?>
</body>

</html>