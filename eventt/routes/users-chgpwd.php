<?php

if (!isset($_GET['user_id'])) {
    header('Location: /users');
    exit;
} else {
    $user_id = (int)$_GET['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // ตรวจสอบว่ากรอกครบ
        if (empty($password) || empty($confirm_password)) {
            renderView('400', ['message' => 'Password is required']);
            exit;
        }

        // ตรวจสอบว่าตรงกันไหม
        if ($password !== $confirm_password) {
            renderView('400', ['message' => 'Password and Confirm Password do not match']);
            exit;
        }

        // hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // update password
        $res = updateUserPassword($user_id, $hashed_password);

        if ($res > 0) {
            header('Location: /users');
            exit;
        } else {
            renderView('400', ['message' => 'Something went wrong! on update password']);
            exit;
        }

    } else {

        $res = getUserById($user_id);

        if ($res) {
            renderView('users-chgpwd', ['result' => $res]);
        } else {
            renderView('400', ['message' => 'Something went wrong! on query user']);
        }
    }
}