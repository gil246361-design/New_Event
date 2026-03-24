<html>

<head></head>

<body>

<?php include 'header.php' ?>

<!-- ส่วนแสดงผลหลักของหน้า -->
<main class="max-w-5xl mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-10 text-center border">

<h1 class="text-4xl font-bold mb-4 text-gray-800">
Event Enrollment System
</h1>

<p class="text-gray-600 mb-8">
ระบบจัดการกิจกรรมและการเข้าร่วมกิจกรรมของผู้ใช้งาน
</p>

<div class="flex justify-center gap-4 flex-wrap">

<a
href="/events"
class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded font-semibold"
>
ดูรายการกิจกรรม
</a>

<a
href="/profile"
class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded font-semibold"
>
โปรไฟล์ของฉัน
</a>

<a
href="/users"
class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded font-semibold"
>
รายชื่อผู้ใช้
</a>

</div>

</div>


<!-- ส่วนแนะนำระบบ -->
<div class="grid md:grid-cols-3 gap-6 mt-10">

<div class="bg-white shadow rounded p-6 text-center border">
<h3 class="text-lg font-semibold mb-2">สร้างกิจกรรม</h3>
<p class="text-gray-600">
ผู้ดูแลสามารถสร้างกิจกรรมใหม่และกำหนดรายละเอียดกิจกรรมได้
</p>
</div>

<div class="bg-white shadow rounded p-6 text-center border">
<h3 class="text-lg font-semibold mb-2">เข้าร่วมกิจกรรม</h3>
<p class="text-gray-600">
สมาชิกสามารถสมัครเข้าร่วมกิจกรรมและรอการอนุมัติ
</p>
</div>

<div class="bg-white shadow rounded p-6 text-center border">
<h3 class="text-lg font-semibold mb-2">Check-in ด้วย QR</h3>
<p class="text-gray-600">
ผู้เข้าร่วมสามารถเช็คอินผ่านระบบ OTP และ QR Code
</p>
</div>

</div>

</main>
<!-- ส่วนแสดงผลหลักของหน้า -->

<?php include 'footer.php' ?>

</body>

</html>