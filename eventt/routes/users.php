<?php
declare(strict_types=1);

$keyword = $_GET['keyword'] ?? '';

if ($keyword === '') {
    $result = getUsers();
} else {
    $result = getUsersByKeyword($keyword);
}

renderView('users', [
    'title'   => 'User Management',
    'result'  => $result,
    'keyword' => $keyword
]);