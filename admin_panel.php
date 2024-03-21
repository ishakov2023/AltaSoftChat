<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Панель Адмитристратора</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] === false) {
    ?>

    <div class="panel">
        <h1>Вход Администратора</h1>
        <form method="post" action="admin.php">
            <label for="name">Логин:</label>
            <input type="text" name="username" placeholder="Введите имя пользователя">
            <label for="name">Пароль:</label>
            <input type="password" name="password" placeholder="Введите пароль">
            <button type="submit">Войти</button>
        </form>
    </div>
    <?php
} else {
    ?>
    <div class="panel">
        <form method="POST" action="admin.php">
            <label for="password">Выход администратора:</label>
            <button type="submit" name="exit" class="logout-button">Выход</button>
        </form>
    </div>
    <?php
}
?>
</html>
