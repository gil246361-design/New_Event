<?php
declare(strict_types=1);
?>

<?php include 'header.php' ?>

<div class="max-w-5xl mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-8 border">

<h1 class="text-2xl font-bold mb-6">
<?= htmlspecialchars($title ?? 'Users') ?>
</h1>

<!-- Search -->
<form method="GET" action="/users" class="flex gap-3 mb-6">

<input
type="text"
name="keyword"
value="<?= htmlspecialchars($keyword ?? '') ?>"
placeholder="ค้นหาผู้ใช้..."
class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>

<button
type="submit"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
Search
</button>

</form>

<?php if (!empty($result)): ?>

<div class="overflow-x-auto">

<table class="min-w-full border border-gray-300">

<thead class="bg-gray-100">
<tr>
<th class="border px-4 py-2 text-left">User ID</th>
<th class="border px-4 py-2 text-left">Name</th>
<th class="border px-4 py-2 text-left">Email</th>
<th class="border px-4 py-2 text-left">Tel</th>
<th class="border px-4 py-2 text-left">Role</th>
</tr>
</thead>

<tbody>

<?php foreach ($result as $user): ?>
<tr class="hover:bg-gray-50">

<td class="border px-4 py-2">
<?= htmlspecialchars($user['user_id']) ?>
</td>

<td class="border px-4 py-2">
<?= htmlspecialchars($user['name']) ?>
</td>

<td class="border px-4 py-2">
<?= htmlspecialchars($user['mail']) ?>
</td>

<td class="border px-4 py-2">
<?= htmlspecialchars($user['telno']) ?>
</td>

<td class="border px-4 py-2">
<?= htmlspecialchars($user['role']) ?>
</td>

</tr>
<?php endforeach; ?>

</tbody>

</table>

</div>

<?php else: ?>

<p class="text-gray-600">No users found.</p>

<?php endif; ?>

</div>

</div>

<?php include 'footer.php' ?>