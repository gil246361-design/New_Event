<?php declare(strict_types=1); ?>

<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto p-6">

<?php if (!$user): ?>

<div class="text-center">

<h2 class="text-2xl font-bold text-red-500">
User not found
</h2>

<a href="/events" class="text-blue-500 underline mt-4 inline-block">
Back
</a>

</div>

<?php else: ?>

<div class="bg-white shadow-lg rounded-lg p-8 border">

<h1 class="text-2xl font-bold mb-6 text-center">
<?= htmlspecialchars((string)$title, ENT_QUOTES, 'UTF-8') ?>
</h1>

<div class="space-y-4">

<div>
<span class="font-semibold text-gray-600">User ID</span>
<div class="text-lg">
<?= htmlspecialchars((string)$user['user_id'], ENT_QUOTES, 'UTF-8') ?>
</div>
</div>

<div>
<span class="font-semibold text-gray-600">Name</span>
<div class="text-lg">
<?= htmlspecialchars((string)$user['name'], ENT_QUOTES, 'UTF-8') ?>
</div>
</div>

<div>
<span class="font-semibold text-gray-600">Email</span>
<div class="text-lg">
<?= htmlspecialchars((string)$user['mail'], ENT_QUOTES, 'UTF-8') ?>
</div>
</div>

<div>
<span class="font-semibold text-gray-600">Phone</span>
<div class="text-lg">
<?= htmlspecialchars((string)$user['telno'], ENT_QUOTES, 'UTF-8') ?>
</div>
</div>

</div>

<div class="mt-6 text-center">

<a
href="javascript:history.back()"
class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded"
>
Back
</a>

</div>

</div>

<?php endif; ?>

</div>

<?php include 'footer.php'; ?>