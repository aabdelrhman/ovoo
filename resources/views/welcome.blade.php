<!-- chat.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
    <div id="messages"></div>
    <input id="message-input" type="text">
    <button id="send-btn">Send</button>

    <script src="https://cdn.jsdelivr.net/npm/socket.io-client/dist/socket.io.js"></script>
    <script>
        const socket = io('https://ovoo.app:6001');

        socket.on('chat message', (msg) => {
            const messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML += `<p>${msg}</p>`;
        });

        document.getElementById('send-btn').addEventListener('click', () => {
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value;
            socket.emit('chat message', message);
            messageInput.value = '';
        });
    </script>
</body>
</html>
