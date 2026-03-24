<?php include 'header.php'; ?>

<div class="max-w-md mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-8 border">

<h1 class="text-2xl font-bold text-center mb-6">
สมัครสมาชิก
</h1>

<form action="/register" method="post" class="space-y-4">

<div>
<label for="name" class="block font-medium mb-1">ชื่อ</label>
<input
type="text"
name="name"
id="name"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<div>
<label for="mail" class="block font-medium mb-1">อีเมล</label>
<input
type="email"
name="mail"
id="mail"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<div>
<label for="telno" class="block font-medium mb-1">เบอร์โทรศัพท์</label>
<input
type="text"
name="telno"
id="telno"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<div>
<label for="password" class="block font-medium mb-1">รหัสผ่าน</label>
<input
type="password"
name="password"
id="password"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<div>
<label for="confirm_password" class="block font-medium mb-1">ยืนยันรหัสผ่าน</label>
<input
type="password"
name="confirm_password"
id="confirm_password"
required
class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
>
</div>

<button
type="submit"
class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded font-semibold">
สมัครสมาชิก
</button>

</form>

<p class="text-center mt-4">
มีบัญชีอยู่แล้ว?
<a href="/login" class="text-blue-600 hover:underline">เข้าสู่ระบบ</a>
</p>

</div>

</div>

<?php include 'footer.php'; ?>