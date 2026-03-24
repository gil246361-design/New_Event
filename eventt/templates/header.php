<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Events' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wide">
                Events
            </h1>

            <nav class="space-x-4 text-sm font-medium">

                <!--
                    <a href="/">หน้าแรก</a>
                    <a href="/contact">ติดต่อเรา</a>
                    <a href='/students'>ข้อมูลนักเรียน</a>
                    <a href='/courses'>คอร์ส</a>
                    <a href='/courses-new'>เพิ่มคอร์ส</a>
                    <a href='/ping'>ปิง</a><br>
                -->

                <a href="/" class="hover:text-yellow-300 transition">หน้าแรก</a>
                <a href="/users" class="hover:text-yellow-300 transition">รายชื่อ</a>
                <a href="/profile" class="hover:text-yellow-300 transition">ข้อมูลส่วนตัว</a>
                <a href="/events" class="hover:text-yellow-300 transition">กิจกรรม</a>
                <a href="/my_evens" class="hover:text-yellow-300 transition">กิจกรรมของฉัน</a>

                <?php if (!empty($_SESSION['user_id'])): ?>
                    <a href="/event_create" class="bg-white text-indigo-600 px-3 py-1 rounded-lg hover:bg-gray-200 transition">
                        สร้างกิจกรรม
                    </a>
                    <a href="/logout" class="ml-2 hover:text-red-300 transition">
                        ออกจากระบบ
                    </a>
                <?php else: ?>
                    <a href="/login" class="hover:text-yellow-300 transition">
                        เข้าสู่ระบบ
                    </a>
                    <a href="/register" class="bg-white text-indigo-600 px-3 py-1 rounded-lg hover:bg-gray-200 transition">
                        สมัคร
                    </a>
                <?php endif; ?>

            </nav>
        </div>
    </header>

    <!-- Content Wrapper -->
    <main class="flex-grow max-w-6xl mx-auto w-full px-6 py-8">