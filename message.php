<?php

if (!isset($_COOKIE['user_id'])) {
    $user_id = uniqid();
    setcookie('user_id', $user_id, time() + 3600 * 24 * 30);
} else {
    $user_id = $_COOKIE['user_id'];
}

if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
    setcookie('user_name', $name, time() + 3600 * 24 * 30);
} elseif (isset($_COOKIE['user_name'])) {
    $name = $_COOKIE['user_name'];
} else {
    $name = 'Гость';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    $messagesFile = 'messages.txt';
    $maxMessages = 30;

    $messages = file($messagesFile);

    if (count($messages) >= $maxMessages) {
        $messages = array_slice($messages, 1 - $maxMessages);
        file_put_contents($messagesFile, implode('', $messages));
    }

    $messageId = uniqid();


    file_put_contents($messagesFile, date('Y-m-d H:i:s') . ' | ' . $messageId . ' | ' . $user_id . ' | ' . $name . ' | ' . $message . PHP_EOL, FILE_APPEND);
}
