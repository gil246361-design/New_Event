<?php


if (!isset($_GET['id'])) {
    header('Location: /students');
    exit;
} else {
    $id = (int)$_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm_password) {
            renderView('400', ['message' => 'Password and Confirm Password do not match']);
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $res = updateStudentPassword($id, $hashed_password);
        if ($res > 0) {
            header('Location: /students');
            exit;
        } else {
            renderView('400', ['message' => 'Something went wrong! on update password']);
            exit;
        }
    } else {        
        $res = getStudentById($id);
        if ($res) {
            renderView('students-chgpwd', array('result' => $res));
        } else {
            renderView('400', ['message' => 'Something went wrong! on query student']);
        }
    }
}