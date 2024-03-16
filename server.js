import express from 'express';
import axios from 'axios';
import fs from 'fs';
const app = express();
const baseUrl = 'https://electro-fix.ramime.com/api/v1';
const certUrl = '/home/ramime/ssl/certs/www_electro_fix_ramime_com_a2b88_5ef4d_1693819388_7933daa92cc437c8253f0e5ef10c126e.crt';
const CertKey = '/home/ramime/ssl/keys/a2b88_5ef4d_1798ee102b319e33223b01268f530ada.key';
var privateKey  = fs.readFileSync(CertKey, 'utf8');
var certificate = fs.readFileSync(certUrl, 'utf8');
var credentials = {
    key: privateKey,
    cert: certificate
};
var server = require('http').createServer(app);
const io = require('socket.io')(server, {
    cors: { origin: "*"}
});
 const sessionsMap = {};
io.on('connection', (socket) => {


    socket.on('test_test', () => {
        socket.emit('updateOfferStatus', response.data);
        socket.broadcast.emit('updateOfferStatus', response.data);

    });
    socket.on('disconnect', (socket) => {
        console.log(socket);
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log('Server is running');
});
