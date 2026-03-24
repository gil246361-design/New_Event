<?php

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {

    header("Location: /events");
    exit;

}

$userId = (int)$_GET['id'];

$user = getUserById2($userId);

renderView('member_detail', [

    'title' => 'Member Detail',

    'user'  => $user

]);