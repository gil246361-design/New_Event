<?php include 'header.php'; ?>

<div class="max-w-6xl mx-auto px-6 py-10">

<h1 class="text-3xl font-bold mb-10">
<?= htmlspecialchars((string)$title, ENT_QUOTES, 'UTF-8') ?>
</h1>


<!-- ====================== -->
<!-- กิจกรรมที่ฉันสร้าง -->
<!-- ====================== -->

<div class="bg-white shadow-md rounded-lg p-6 mb-10">

<h2 class="text-xl font-semibold mb-6 border-b pb-2">
กิจกรรมที่ฉันสร้าง
</h2>

<?php if (!empty($owner_events)): ?>

<div class="overflow-x-auto">

<table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">

<thead class="bg-gray-100">

<tr>

<th class="px-4 py-3 text-left">ชื่อกิจกรรม</th>
<th class="px-4 py-3 text-left">วันที่เริ่ม</th>
<th class="px-4 py-3 text-left">สถานที่</th>

</tr>

</thead>

<tbody class="divide-y">

<?php foreach ($owner_events as $event): ?>

<tr class="hover:bg-gray-50 transition">

<td class="px-4 py-3">

<a
href="/event_detail?id=<?= $event['event_id'] ?>"
class="text-blue-600 hover:underline font-medium">

<?= htmlspecialchars($event['event_name']) ?>

</a>

</td>

<td class="px-4 py-3">
<?= htmlspecialchars($event['start']) ?>
</td>

<td class="px-4 py-3">
<?= htmlspecialchars($event['location']) ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<?php else: ?>

<p class="text-gray-500">
คุณยังไม่ได้สร้างกิจกรรม
</p>

<?php endif; ?>

</div>



<!-- ====================== -->
<!-- กิจกรรมที่ฉันเข้าร่วม -->
<!-- ====================== -->

<div class="bg-white shadow-md rounded-lg p-6">

<h2 class="text-xl font-semibold mb-6 border-b pb-2">
กิจกรรมที่ฉันเข้าร่วม
</h2>

<?php if (!empty($events)): ?>

<div class="overflow-x-auto">

<table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">

<thead class="bg-gray-100">

<tr>

<th class="px-4 py-3 text-left">ชื่อกิจกรรม</th>
<th class="px-4 py-3 text-left">วันที่เริ่ม</th>
<th class="px-4 py-3 text-left">สถานที่</th>
<th class="px-4 py-3 text-left">เวลาเช็คอิน</th>
<th class="px-4 py-3 text-center">สถานะ</th>
<th class="px-4 py-3 text-center">จัดการ</th>

</tr>

</thead>

<tbody class="divide-y">

<?php foreach ($events as $event): ?>

<tr class="hover:bg-gray-50 transition">

<td class="px-4 py-3">

<a
href="/event_detail?id=<?= $event['event_id'] ?>"
class="text-blue-600 hover:underline font-medium">

<?= htmlspecialchars($event['event_name']) ?>

</a>

</td>

<td class="px-4 py-3">
<?= htmlspecialchars($event['start']) ?>
</td>

<td class="px-4 py-3">
<?= htmlspecialchars($event['location']) ?>
</td>

<td class="px-4 py-3">

<?= $event['checkin_time']
? htmlspecialchars($event['checkin_time'])
: '-' ?>

</td>

<td class="px-4 py-3 text-center">

<?php if ($event['status'] === 'approved'): ?>

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
อนุมัติแล้ว
</span>

<?php elseif ($event['status'] === 'rejected'): ?>

<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
ถูกปฏิเสธ
</span>

<?php else: ?>

<span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium">
รอการตรวจสอบ
</span>

<?php endif; ?>

</td>

<td class="px-4 py-3 text-center">

<form
method="POST"
action="/event_leave"
onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการยกเลิกการเข้าร่วมกิจกรรมนี้?')">

<input
type="hidden"
name="event_id"
value="<?= $event['event_id'] ?>">

<button
type="submit"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">

ยกเลิก

</button>

</form>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<?php else: ?>

<p class="text-gray-500">
คุณยังไม่ได้เข้าร่วมกิจกรรม
</p>

<?php endif; ?>

</div>

</div>

<?php include 'footer.php'; ?>