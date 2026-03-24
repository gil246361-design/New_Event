<?php declare(strict_types=1); ?>
<?php include 'header.php'; ?>

<script>

function validateForm() {

    const eventName = document.forms["eventForm"]["event_name"].value.trim();
    const description = document.forms["eventForm"]["description"].value.trim();
    const amountUser = document.forms["eventForm"]["amount_user"].value.trim();
    const location = document.forms["eventForm"]["location"].value.trim();
    const start = document.forms["eventForm"]["start"].value.trim();
    const end = document.forms["eventForm"]["end"].value.trim();

    if (!eventName || !description || !amountUser || !location || !start || !end) {
        alert("กรุณากรอกข้อมูลให้ครบทุกช่อง");
        return false;
    }

    return true;
}

</script>

<div class="max-w-3xl mx-auto p-6">

<h2 class="text-3xl font-bold mb-6">Edit Event</h2>

<?php if (!empty($error)) : ?>
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
<?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
</div>
<?php endif; ?>

<form method="POST" name="eventForm" onsubmit="return validateForm()" class="bg-white shadow-md rounded-lg p-6 border">

<!-- Event Name -->
<div class="mb-4">
<label class="block font-semibold mb-1">Event Name</label>
<input
type="text"
name="event_name"
value="<?= htmlspecialchars((string)$event['event_name'], ENT_QUOTES, 'UTF-8') ?>"
class="w-full border rounded px-3 py-2"
>
</div>

<!-- Description -->
<div class="mb-4">
<label class="block font-semibold mb-1">Description</label>
<textarea
name="description"
rows="4"
class="w-full border rounded px-3 py-2"
><?= htmlspecialchars((string)$event['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
</div>

<!-- Max Participants -->
<div class="mb-4">
<label class="block font-semibold mb-1">Max Participants</label>
<input
type="number"
name="amount_user"
value="<?= htmlspecialchars((string)$event['amount_user'], ENT_QUOTES, 'UTF-8') ?>"
class="w-full border rounded px-3 py-2"
>
</div>

<!-- Location -->
<div class="mb-4">
<label class="block font-semibold mb-1">Location</label>
<input
type="text"
name="location"
value="<?= htmlspecialchars((string)$event['location'], ENT_QUOTES, 'UTF-8') ?>"
class="w-full border rounded px-3 py-2"
>
</div>

<!-- Start -->
<div class="mb-4">
<label class="block font-semibold mb-1">Start</label>
<input
type="datetime-local"
name="start"
value="<?= date('Y-m-d\TH:i', strtotime((string)$event['start'])) ?>"
class="w-full border rounded px-3 py-2"
>
</div>

<!-- End -->
<div class="mb-6">
<label class="block font-semibold mb-1">End</label>
<input
type="datetime-local"
name="end"
value="<?= date('Y-m-d\TH:i', strtotime((string)$event['end'])) ?>"
class="w-full border rounded px-3 py-2"
>
</div>

<!-- Buttons -->
<div class="flex gap-3">

<a href="/events"
class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
Cancel
</a>

<button
type="submit"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
Update Event
</button>

</div>

</form>

</div>

<?php include 'footer.php'; ?>