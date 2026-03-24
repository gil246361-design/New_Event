<html>

<head></head>

<body>
    <?php include 'header.php' ?>

    <main>
        <h1><?= $data['title'] ?></h1>

        <form action="courses" method="get">
            <input type="text" 
                   name="keyword" 
                   value="<?= htmlspecialchars($data['keyword'] ?? '') ?>" />
            <button type="submit">Search</button>
        </form>

        <?php
        if ($data['result'] && $data['result']->num_rows > 0) {
            while ($row = $data['result']->fetch_object()) {
        ?>
                <?= $row->course_id ?>
                <?= $row->course_code ?>
                <?= $row->course_name ?>
                <?= $row->instructor ?>

                <a href="/courses-delete?id=<?= $row->course_id ?>" 
                   onclick="return confirmSubmission()">ลบข้อมูล</a>

                <br>
        <?php
            }
        } else {
            echo "ไม่พบข้อมูล";
        }
        ?>
    </main>

    <script>
        function confirmSubmission() {
            return confirm("ยืนยันการลบข้อมูล ?");
        }
    </script>

    <?php include 'footer.php' ?>
</body>

</html>