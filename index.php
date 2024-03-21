<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Простой чат</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<header>
    <a href="admin_panel.php">Панель администратора</a>
    <h1>Чат</h1></header>
<body>
<div id="chat"></div>
<form id="messageForm" method="POST">
    <label for="name">Ваш никнейм:</label>
    <input type="text" name="name" placeholder="Ваше ник или Гость">
    <label for="message">Ваше сообщение:</label>
    <textarea name="message" placeholder="Ваше сообщение (не более 500 знаков)" maxlength="500" required></textarea>
    <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
    <button type="submit" name="submit">Отправить</button>
</form>
<form id="limitForm">
    <label for="limit">Количество сообщений:</label>
    <input type="number" id="limit" name="limit" min="1" value="10">
    <button type="submit">Применить</button>
</form>
<script>
    $(document).ready(function () {
        function updateChat(limit) {
            $.ajax({
                url: 'chat.php?limit=' + limit,
                success: function (data) {
                    var $chat = $('#chat');
                    $chat.html(data);
                    $chat.find('.message').each(function () {
                        $(this).wrap('<div class="message-container"></div>');
                    });

                    $chat.on('click', '.delete-message-btn', function () {
                        var messageId = $(this).data('message-id');
                        $.ajax({
                            type: 'POST',
                            url: 'delete_message.php',
                            data: {messageId: messageId},
                            success: function () {
                                updateChat(limit);
                            }
                        });
                    });

                    $chat.on('click', '.delete-user-messages-btn', function () {
                        var userId = $(this).data('user-id');
                        $.ajax({
                            type: 'POST',
                            url: 'delete_user_messages.php',
                            data: {userId: userId},
                            success: function () {
                                updateChat(limit);
                            }
                        });
                    });
                }
            });
        }

        $('#limitForm').submit(function (e) {
            e.preventDefault();
            var limit = $('#limit').val();
            updateChat(limit);
        });

        updateChat(10);

        $('#messageForm').submit(function (e) {
            e.preventDefault();
            var limit = $('#limit').val();
            $.ajax({
                type: 'POST',
                url: 'message.php',
                data: $(this).serialize(),
                success: function () {
                    updateChat(limit);
                }
            });
        });
    });
</script>
</body>

</html>