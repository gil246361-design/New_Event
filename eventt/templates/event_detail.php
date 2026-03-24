<?php include 'header.php'; ?>

<?php if ($event === null): ?>

<div class="max-w-xl mx-auto mt-10 text-center">
<h2 class="text-2xl font-bold text-red-500">
Event not found
</h2>
</div>

<?php else: ?>

<div class="max-w-6xl mx-auto p-6">

<h2 class="text-3xl font-bold mb-6">
<?= htmlspecialchars($event['event_name']) ?>
</h2>

<?php if ($isOwner): ?>

<div class="mb-4">
<a href="/event_edit?id=<?= $event['event_id'] ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
Edit Event
</a>
</div>

<?php endif; ?>

<div class="bg-white shadow rounded p-6 mb-6">

<p class="mb-2">
<strong>Description:</strong>
<?= htmlspecialchars($event['description']) ?>
</p>

<p class="mb-2">
<strong>Location:</strong>
<?= htmlspecialchars($event['location']) ?>
</p>

<p class="mb-2">
<strong>Start:</strong>
<?= $event['start'] ?>
</p>

<p>
<strong>End:</strong>
<?= $event['end'] ?>
</p>

</div>

<h3 class="text-xl font-semibold mb-4">
Participants (<?= $memberCount ?>)
</h3>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

<div class="bg-green-50 border border-green-200 rounded p-4 text-center">
<div class="text-sm text-gray-600">Approved</div>
<div class="text-2xl font-bold text-green-600">
<?= $stats['approved'] ?>
</div>
</div>

<div class="bg-orange-50 border border-orange-200 rounded p-4 text-center">
<div class="text-sm text-gray-600">Pending</div>
<div class="text-2xl font-bold text-orange-500">
<?= $stats['pending'] ?>
</div>
</div>

<div class="bg-red-50 border border-red-200 rounded p-4 text-center">
<div class="text-sm text-gray-600">Rejected</div>
<div class="text-2xl font-bold text-red-500">
<?= $stats['rejected'] ?>
</div>
</div>

<div class="bg-blue-50 border border-blue-200 rounded p-4 text-center">
<div class="text-sm text-gray-600">Checked-in</div>
<div class="text-2xl font-bold text-blue-600">
<?= $stats['checkedin'] ?>
</div>
</div>

</div>

<?php if ($memberCount === 0): ?>

<p>No participants yet.</p>

<?php else: ?>

<div class="overflow-x-auto">

<table class="min-w-full bg-white border border-gray-200">

<thead class="bg-gray-100">

<tr>
<th class="border px-4 py-2 text-left">Name</th>
<th class="border px-4 py-2 text-left">Email</th>
<th class="border px-4 py-2 text-center">สถานะการสมัคร</th>
<th class="border px-4 py-2 text-center">การเข้าร่วม</th>

<?php if ($isOwner): ?>
<th class="border px-4 py-2 text-center">จัดการ</th>
<?php endif; ?>

</tr>

</thead>

<tbody>

<?php foreach ($members as $member): ?>

<tr class="hover:bg-gray-50">

<td class="border px-4 py-2">
<a
href="/member_detail?id=<?= htmlspecialchars((string)$member['user_id'], ENT_QUOTES, 'UTF-8') ?>"
class="text-blue-600 hover:underline font-medium"
>
<?= htmlspecialchars((string)$member['name'], ENT_QUOTES, 'UTF-8') ?>
</a>
</td>

<td class="border px-4 py-2">
<?= htmlspecialchars($member['mail']) ?>
</td>

<td class="border px-4 py-2 text-center">

<?php if ($member['status'] === 'pending'): ?>

<span class="text-orange-500">รอการอนุมัติ</span>

<?php elseif ($member['status'] === 'rejected'): ?>

<span class="text-red-500">ถูกปฏิเสธ</span>

<?php elseif ($member['status'] === 'approved' || !empty($member['checkin_time'])): ?>

<span class="text-green-600 font-semibold">อนุมัติแล้ว</span>

<?php endif; ?>

</td>

<td class="border px-4 py-2 text-center">

<?php if ($member['status'] === 'approved' || !empty($member['checkin_time'])): ?>

<?php if (!empty($member['checkin_time'])): ?>

<span class="text-blue-600 font-semibold">
<?= date('H:i', strtotime($member['checkin_time'])) ?>
</span>

<?php else: ?>

<span class="text-gray-500">ยังไม่เช็คอิน</span>

<?php endif; ?>

<?php endif; ?>

</td>

<?php if ($isOwner): ?>

<td class="border px-4 py-2 text-center">

<div class="flex justify-center gap-2">

<form method="POST" action="/event_member_action">
<input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
<input type="hidden" name="user_id" value="<?= $member['user_id'] ?>">
<input type="hidden" name="action" value="approve">
<button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
Approve
</button>
</form>

<form method="POST" action="/event_member_action">
<input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
<input type="hidden" name="user_id" value="<?= $member['user_id'] ?>">
<input type="hidden" name="action" value="reject">
<button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
Reject
</button>
</form>

</div>

</td>

<?php endif; ?>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<?php endif; ?>

<div class="mt-6">

<?php if ($alreadyCheckedIn): ?>

<button onclick="alert('คุณได้เช็คอินแล้ว ไม่สามารถเช็คอินซ้ำได้')" class="bg-gray-400 text-white px-4 py-2 rounded">
Check-in
</button>

<?php elseif ($canCheckin): ?>

<form method="GET" action="/checkin_otp">

<input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">

<button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
Check-in
</button>

</form>

<?php else: ?>

<button onclick="alert('คุณยังไม่ได้รับอนุมัติให้เข้าร่วมกิจกรรม')" class="bg-gray-400 text-white px-4 py-2 rounded">
Check-in
</button>

<?php endif; ?>

</div>

<hr class="my-8">

<h3 class="text-xl font-semibold mb-3">
Event Photos
</h3>

<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $event['event_owner']): ?>

<a href="/event_upload_photo?id=<?= $event['event_id'] ?>" class="inline-block mb-4 bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">
Add Photo
</a>

<?php endif; ?>

<?php if (!empty($photos)): ?>

<div class="grid grid-cols-2 md:grid-cols-3 gap-4">

<?php foreach ($photos as $photo): ?>

<img src="/uploads/<?= htmlspecialchars($photo) ?>" class="rounded shadow">

<?php endforeach; ?>

</div>

<?php else: ?>

<p>No photos available.</p>

<?php endif; ?>

</div>

<?php endif; ?>

<?php include 'footer.php'; ?>