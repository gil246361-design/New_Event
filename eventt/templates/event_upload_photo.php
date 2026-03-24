<?php declare(strict_types=1); ?>

<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-8 border">

<h2 class="text-2xl font-bold mb-6 text-center">
Upload Photo
</h2>

<form
method="POST"
enctype="multipart/form-data"
action="/event_upload_photo_handler"
class="space-y-4"
>

<input
type="hidden"
name="event_id"
value="<?= htmlspecialchars((string)$event['event_id'], ENT_QUOTES, 'UTF-8') ?>"
>

<div>
<label class="block mb-2 font-semibold">
เลือกไฟล์รูปภาพ
</label>

<input
type="file"
name="photo"
required
class="w-full border rounded px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<div class="flex justify-between pt-4">

<a
href="/event_detail?id=<?= htmlspecialchars((string)$event['event_id'], ENT_QUOTES, 'UTF-8') ?>"
class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded"
>
ยกเลิก
</a>

<button
type="submit"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-semibold"
>
Upload Photo
</button>

</div>

</form>

</div>

</div>

<?php include 'footer.php'; ?>