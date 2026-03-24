<?php declare(strict_types=1); ?>
<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto p-6">

<div class="bg-white shadow-lg rounded-lg p-8 text-center border">

<h2 class="text-2xl font-bold mb-2">
Check-in QR Code
</h2>

<p class="text-gray-600 mb-6">
สแกน QR Code นี้เพื่อเช็คอิน
</p>

<!-- แสดง QR Code -->
<div class="flex justify-center mb-6">

<img
src="<?= htmlspecialchars((string)$qrUrl, ENT_QUOTES, 'UTF-8') ?>"
alt="QR Code"
class="border p-3 rounded-lg shadow"
>

</div>

<!-- Countdown -->
<p class="text-gray-700 mb-4">
หมดอายุใน
<span id="countdown" class="font-bold text-red-500 text-lg">
<?= (int)$timeLeft ?>
</span>
วินาที
</p>

<!-- OTP Form -->
<form method="POST" action="/checkin_confirm" class="space-y-4">

<input type="hidden" name="event_id" value="<?= (int)$eventId ?>">

<input
type="text"
name="otp_input"
placeholder="กรอก OTP"
required
class="w-full border rounded px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-blue-400"
>

<button
type="submit"
class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded font-semibold">
ยืนยัน Check-in
</button>

</form>

</div>

</div>

<script>

/* แสดง alert จาก controller */

const msg = new URLSearchParams(window.location.search).get("msg");

if (msg === "invalid_event") {
    alert("กิจกรรมไม่ถูกต้อง");
}


/*
Javascript countdown
ทำหน้าที่ลดเวลาทุก 1 วินาที
ถ้าเวลาหมดจะ reload หน้าเพื่อสร้าง OTP ใหม่
*/

let timeLeft = <?= (int)$timeLeft ?>;

const countdown = document.getElementById("countdown");

const timer = setInterval(() => {

    timeLeft--;

    countdown.textContent = timeLeft;

    if (timeLeft <= 0) {

        clearInterval(timer);

        alert("QR Code หมดอายุ กำลังโหลดใหม่...");

        location.reload();

    }

}, 1000);

</script>

<?php include 'footer.php'; ?>