<html>

<head></head>

<body>
    <?php include 'header.php' ?>

    <main>
        <h2>สร้างกิจกรรม</h2>

<form action="/store-event" method="POST">
    <input type="text" name="event_name" placeholder="ชื่อกิจกรรม" required>

    <textarea name="description" placeholder="รายละเอียด"></textarea>

    <input type="number" name="amount_user" placeholder="จำนวนผู้เข้าร่วม" required>

    <input type="text" name="location" placeholder="สถานที่">

    <input type="datetime-local" name="start" required>
    <input type="datetime-local" name="end" required>

    <button type="submit">สร้างกิจกรรม</button>
</form>

        
    </main>

    

    <?php include 'footer.php' ?>
</body>

</html>