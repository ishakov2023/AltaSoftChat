<?php
session_start();

if (isset($_POST['password']) && isset($_POST['username'])) {
    $password = $_POST['password'];
    $name = $_POST['username'];
    if ($password === '123' && $name === 'admin') {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    } else {
        echo 'Неверный пароль администратора.';
    }
}
if (isset($_POST['exit'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
}
