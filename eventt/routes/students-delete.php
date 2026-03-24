<?php

declare(strict_types=1);

if (!isset($_GET['id'])) {
    header('Location: /students');
    exit;
}

$id = (int)$_GET['id'];    
$res = deleteStudentsById($id);

if ($res) {
    header('Location: /students');
    exit;
} else {
    renderView('400', [
        'message' => 'Something went wrong on delete student'
    ]);
}