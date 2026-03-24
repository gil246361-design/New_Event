<html>

<head></head>

<body>
    <?php include 'header.php' ?>

        <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <h1>เพิ่มข้อมูลคอร์ส</h1>
        <?= $data['message'] ?? '' ?>
        <section>
            <form action="courses-new" method="post" onsubmit="return confirmSubmission()">
                <label for="code">Course Code</label><br>
                <input type="text" name="code" id="code" /><br>
                <label for="name">Course Name</label><br>
                <input type="text" name="name" id="name" /><br>
                <label for="instructor">Instructor</label><br>
                <input type="text" name="instructor" id="instructor" /><br>
                <button type="submit">Submit</button>
            </form>
        </section>
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->

    <?php include 'footer.php' ?>
    <script>
        function confirmSubmission() {
            return confirm("ต้องการเพิ่มข้อมูลจริงหรือไม่ ?");
        }
    </script>
</body>

</html>