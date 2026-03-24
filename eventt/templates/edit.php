<h2>แก้ไขกิจกรรม</h2>

<form action="/update-event" method="POST">
    <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">

    <input type="text" name="event_name"
           value="<?= htmlspecialchars($event['event_name']) ?>" required>

    <textarea name="description"><?= htmlspecialchars($event['description']) ?></textarea>

    <input type="number" name="amount_user"
           value="<?= $event['amount_user'] ?>">

    <input type="text" name="location"
           value="<?= htmlspecialchars($event['location']) ?>">

    <input type="datetime-local" name="start"
           value="<?= $event['start'] ?>">

    <input type="datetime-local" name="end"
           value="<?= $event['end'] ?>">

    <button type="submit">บันทึก</button>
</form>