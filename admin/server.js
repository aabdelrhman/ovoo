const express = require('express');
const https = require('https'); // Changed from 'http' to 'https'
const fs = require('fs');
const app = express();

// Load SSL certificates
const certUrl = '/home/admin1/ssl/certs/ovoo_app_c206e_905e5_1716249599_508a752e2b9b96c84ae16b3ce4f8cf8e.crt';
const CertKey = '/home/admin1/ssl/keys/c206e_905e5_88ab613d74c96fa03e27608e42333ad6.key';
var privateKey  = fs.readFileSync(CertKey, 'utf8');
var certificate = fs.readFileSync(certUrl, 'utf8');
var credentials = {
    key: privateKey,
    cert: certificate
};
var server = require('https').createServer(credentials, app);
const io = require('socket.io')(server, {
    cors: { origin: "*"}
});

// Define Socket.io event handlers
io.on('connection', (socket) => {
    console.log('A user connected');

    socket.on('chat message', (msg) => {
        io.emit('chat message', msg); // Broadcast the message to all connected clients
    });

    socket.on('disconnect', () => {
        console.log('User disconnected');
    });
});

const port = 4000;
server.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
