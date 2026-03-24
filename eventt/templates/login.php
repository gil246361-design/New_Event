<?php include 'header.php'; ?>

<div class="max-w-md mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-8 border">

<h1 class="text-2xl font-bold text-center mb-6">
เข้าสู่ระบบ
</h1>

<form action="/login" method="post" class="space-y-4">

<div>
<label for="mail" class="block font-medium mb-1">
อีเมลผู้ใช้
</label>

<input
type="email"
name="mail"
id="mail"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<div>
<label for="password" class="block font-medium mb-1">
รหัสผ่าน
</label>

<input
type="password"
name="password"
id="password"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<button
type="submit"
class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded font-semibold">
เข้าสู่ระบบ
</button>

</form>

</div>

</div>

<?php include 'footer.php'; ?>