<?php
session_start();
$messages = file('messages.txt');

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

$messages = array_slice($messages, -$limit);

foreach ($messages as $message) {
    $message_parts = explode(' | ', $message);

    if (count($message_parts) === 5) {
        list($date, $messageId, $user, $name, $text) = $message_parts;
        $current_user = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : 'Гость';

        echo '<div class="message-container">';


        $message_class = ($user === $current_user) ? 'my-message' : 'other-message';

        echo '<div class="message ' . $message_class . '">';

        echo $date . '<br>';

        echo '<span class="username">' . ($user === $current_user ? 'Вы(' . $name . ')' : $name) . '</span> : ' . $text;

        if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            if ($user != 'Админ'){
            echo '<div class="buttons-container">';
            echo '<button class="delete-message-btn" data-message-id="' . $messageId . '">Удалить сообщение</button>';
            echo '<button class="delete-user-messages-btn" data-user-id="' . $user . '">Удалить сообщения пользователя</button>';
            echo '</div>';
            }
        }

        echo '</div>';
        echo '</div>';
    }
}

