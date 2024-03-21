<?php
$file = 'messages.txt';

$userId = $_POST['userId'];
$criteria = array(
    'type' => 'user_id',
    'value' => $userId
);

$lines = file($file);
$output = '';

foreach ($lines as $line) {
    $data = explode(' | ', $line);

    if ($criteria['type'] === 'user_id' && trim($data[2]) === $criteria['value']) {
        $line = str_replace($data[2], 'Админ', $line);
        $line = str_replace($data[4], 'Сообщение пользователя: "' . $data[3] . '" удалено администратором', $line);
    }

    $output .= rtrim($line, "\r\n") . "\r\n";
}

file_put_contents($file, $output);

