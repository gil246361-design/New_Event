<?php

declare(strict_types=1); ?>
<?php include 'header.php'; ?>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    if (msg === 'join_success') {
        alert('ยืนยันการเข้าร่วมกิจกรรมเรียบร้อยแล้ว!');
    } else if (msg === 'leave_success') {
        alert('ยกเลิกการเข้าร่วมกิจกรรมเรียบร้อยแล้ว!');
    } else if (msg === 'error') {
        alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
    }

    if (msg) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    function checkEventStart(startTime) {
        const now = new Date();
        const start = new Date(startTime);

        if (now >= start) {
            alert('กิจกรรมเริ่มไปแล้ว ไม่สามารถเข้าร่วมได้');
            return false;
        }

        return true;
    }
</script>

<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        <?= htmlspecialchars((string)($title ?? 'Events'), ENT_QUOTES, 'UTF-8') ?>
    </h1>

    <form method="GET" action="/events" class="bg-white shadow rounded p-6 mb-8 border">

        <div class="mb-4">

            <label class="block font-semibold mb-1">
                ชื่อกิจกรรม
            </label>

            <input
                type="text"
                name="keyword"
                value="<?= htmlspecialchars((string)($keyword ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                placeholder="ค้นหาชื่อกิจกรรม..."
                class="border rounded w-full px-3 py-2">

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>

                <label class="block font-semibold mb-1">
                    วันที่เริ่มต้น
                </label>

                <input
                    type="date"
                    name="start_date"
                    value="<?= htmlspecialchars((string)($start_date ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                    class="border rounded w-full px-3 py-2">

            </div>

            <div>

                <label class="block font-semibold mb-1">
                    วันที่สิ้นสุด
                </label>

                <input
                    type="date"
                    name="end_date"
                    value="<?= htmlspecialchars((string)($end_date ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                    class="border rounded w-full px-3 py-2">

            </div>

        </div>

        <button
            type="submit"
            class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Search
        </button>

    </form>

    <?php if (!empty($result)): ?>

        <div class="space-y-6">

            <?php foreach ($result as $event): ?>

                <div class="bg-white shadow rounded p-6 border flex flex-col md:flex-row gap-6">

                    <div>

                        <img
                            src="<?= htmlspecialchars((string)$event['profile_photo'], ENT_QUOTES, 'UTF-8') ?>"
                            class="w-[250px] h-[250px] object-cover rounded">

                    </div>

                    <div class="flex-1">

                        <p class="text-gray-500 text-sm">
                            ID: <?= $event['event_id'] ?>
                        </p>

                        <h3 class="text-xl font-semibold mb-2">

                            <a
                                href="/event_detail?id=<?= urlencode((string)$event['event_id']) ?>"
                                class="text-blue-600 hover:underline">

                                <?= htmlspecialchars((string)$event['event_name'], ENT_QUOTES, 'UTF-8') ?>

                            </a>

                        </h3>

                        <p class="mb-2">
                            <strong>Description:</strong>
                            <?= htmlspecialchars((string)$event['description'], ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <p class="mb-1">
                            <strong>Max Users:</strong>
                            <?= $event['amount_user'] ?>
                        </p>

                        <p class="mb-1">
                            <strong>Location:</strong>
                            <?= htmlspecialchars((string)$event['location'], ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <p class="mb-1">
                            <strong>Start:</strong>
                            <?= htmlspecialchars((string)$event['start'], ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <p class="mb-4">
                            <strong>End:</strong>
                            <?= htmlspecialchars((string)$event['end'], ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <form 	method="POST" action="/event_join" style="display:inline;" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลงทะเบียนเข้าร่วมกิจกรรมนี้?')">
                            
                       		 <input 	type="hidden" name="event_id" value="<?= (int)$event['event_id'] ?>">

                 			<?php if (isset($_SESSION['user_id'])): ?>
                       		<button 
                                    type="submit"
                                	class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mr-2">เข้าร่วมกิจกรรม
                            </button>
                        
                            <?php else: ?>
                        
                            <button 
                                    type="button" 
                                    onclick="alert('กรุณาเข้าสู่ระบบก่อน');"> เข้าร่วมกิจกรรม
                            </button>
                        
                        <?php endif; ?>
                   	    </form>

                        <form method="POST" action="/event_leave" style="display:inline;">

                            <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">

                            <?php if (isset($_SESSION['user_id'])): ?>

                                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                    ออกจากกิจกรรม
                                </button>

                            <?php else: ?>

                                <button
                                    type="button"
                                    onclick="alert('กรุณาเข้าสู่ระบบก่อน');"
                                    class="bg-gray-400 text-white px-4 py-2 rounded">
                                    ออกจากกิจกรรม
                                </button>

                            <?php endif; ?>

                        </form>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <p class="text-gray-500">
            No events found.
        </p>

    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>