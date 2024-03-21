<?php
$file = 'messages.txt';

$messageId = $_POST['messageId'];
$criteria = array(
    'type' => 'message_id',
    'value' => $messageId
);

$lines = file($file);
$output = '';
$messageDeleted = false;

foreach ($lines as $line) {
    $data = explode(' | ', $line);

    if ($criteria['type'] === 'message_id' && trim($data[1]) === $criteria['value']) {
        $line = str_replace($data[2], 'Админ', $line);
        $line = str_replace($data[4], 'Сообщение пользователя: "' . $data[3] . '" удалено администратором', $line);
        $messageDeleted = true;
    }

    $output .= rtrim($line, "\r\n") . "\r\n";
}

file_put_contents($file, $output);

