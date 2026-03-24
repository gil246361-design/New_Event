<?php declare(strict_types=1); ?>

<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-8 border">

<h1 class="text-2xl font-bold mb-6 text-center">
<?= htmlspecialchars((string)$title, ENT_QUOTES, 'UTF-8') ?>
</h1>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-300 rounded">
        <?= htmlspecialchars((string)$_SESSION['error'], ENT_QUOTES, 'UTF-8'); 
           unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<form method="POST" action="/event_create" class="space-y-4">

<!-- Event Name -->
<div>
<label class="block mb-1 font-semibold">Event Name</label>
<input
type="text"
name="event_name"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<!-- Description -->
<div>
<label class="block mb-1 font-semibold">Description</label>
<textarea
name="description"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
></textarea>
</div>

<!-- Max People -->
<div>
<label class="block mb-1 font-semibold">Max People</label>
<input
type="number"
name="amount_user"
min="1"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<!-- Location -->
<div>
<label class="block mb-1 font-semibold">Location</label>
<input
type="text"
name="location"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<!-- Start -->
<div>
<label class="block mb-1 font-semibold">Start</label>
<input
type="datetime-local"
name="start"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<!-- End -->
<div>
<label class="block mb-1 font-semibold">End</label>
<input
type="datetime-local"
name="end"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<!-- Buttons -->
<div class="flex justify-between pt-4">

<a
href="/events"
class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded"
>
Back
</a>

<button
type="submit"
class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-semibold"
>
Create
</button>

</div>

</form>

</div>

</div>

<?php include 'footer.php'; ?>