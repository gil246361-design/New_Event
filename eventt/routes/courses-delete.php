<?php

declare(strict_types=1);

require_once __DIR__ . '/../databases/courses.php';

$id = $_GET['id'] ?? null;

if ($id && deleteCourseById((int)$id)) {
    header('Location: /courses');
    exit;
}

renderView('404');