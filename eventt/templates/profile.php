<?php declare(strict_types=1); ?>

<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-8 border">

<h1 class="text-2xl font-bold mb-6 text-center">
<?= htmlspecialchars((string)($title ?? 'Profile'), ENT_QUOTES, 'UTF-8') ?>
</h1>

<div class="space-y-4">

<div>
<span class="font-semibold">User ID:</span>
<?= htmlspecialchars((string)$user['user_id'], ENT_QUOTES, 'UTF-8') ?>
</div>

<div>
<span class="font-semibold">ชื่อ:</span>
<?= htmlspecialchars((string)$user['name'], ENT_QUOTES, 'UTF-8') ?>
</div>

<div>
<span class="font-semibold">อีเมล:</span>
<?= htmlspecialchars((string)$user['mail'], ENT_QUOTES, 'UTF-8') ?>
</div>

<div>
<span class="font-semibold">เบอร์โทรศัพท์:</span>
<?= htmlspecialchars((string)$user['telno'], ENT_QUOTES, 'UTF-8') ?>
</div>

</div>

<div class="mt-6 text-center">

<a
href="/events"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
>
กลับหน้าหลัก
</a>

</div>

</div>

</div>

<?php include 'footer.php'; ?>