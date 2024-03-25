const express = require('express');
const axios = require('axios');
const fs = require('fs');
const app = express();

// Load SSL certificates
const baseUrl = "http://ovoo.app/api/v1"
const certUrl = '/home/admin1/ssl/certs/ovoo_app_c206e_905e5_1716249599_508a752e2b9b96c84ae16b3ce4f8cf8e.crt';
const certKey = '/home/admin1/ssl/keys/c206e_905e5_88ab613d74c96fa03e27608e42333ad6.key';
var privateKey  = fs.readFileSync(certKey, 'utf8');
var certificate = fs.readFileSync(certUrl, 'utf8');
var credentials = {
    key: privateKey,
    cert: certificate
};

var server = require('https').createServer(credentials , app);
const io = require('socket.io')(server, {
    cors: { origin: "*"}
});

// Define Socket.io event handlers
io.on('connection', (socket) => {
    socket.join('chat-'+socket.handshake.query.chat_id);
    console.log('chat-'+socket.handshake.query.chat_id);
    socket.on('chat-'+socket.handshake.query.chat_id, (message) => {
        var token = socket.handshake.headers.authorization;
        const headers = {
            "Content-Type": "application/json",
            "Authorization": token,
        };


        if(token !== undefined){
            axios.post(baseUrl+'/send-message' , message , {headers})
                .then(response => {
                    console.log(response.data);
                    socket.emit('sendChatToClient', response.data);
                    socket.to('chat-'+socket.handshake.query.chat_id).emit('sendChatToClient', response.data);
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        }else{
            console.log('Token is required')
        }

    });
});

const port = 6001;
server.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
