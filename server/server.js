var express = require("express");
var app = express();

var server = require("http").Server(app);
var io = require("socket.io")(server);
server.listen(3000);

io.on("connection", function(socket){
    console.log("Co ket noi moi: " + socket.id);
    // socket.adapter.rooms;
    // socket.join('room');
    // socket.leave('room');
    // io.sockets.emit('SERVER_SEND_ALL', data);
    // io.sockets.in('room').emit('SERVER_SEND_ALL_ROOM', data);
    // socket.emit('SERVER_SEND_USER', data);
    // socket.broadcast.emit('SERVER_SEND_ALL', data);

    socket.on("disconnect", function(){
        console.log(" ngat ket noi tu: " + socket.id);
    });

    socket.on("CLIENT_SEND", function(data){
        console.log(socket.id + ': ' + data);
        io.sockets.emit('CLIENT_SEND', data);
    });

    socket.on("CHANGE_TABLE", function(data){
        console.log('change table');
        io.sockets.emit('CHANGE_TABLE', data);
    });

    // socket.on("CLOSE_TABLE", function(data){
    //     console.log('close table');
    //     io.sockets.emit('CLOSE_TABLE', data);
    // });

    socket.on("ADD_ORDER", function(data){
        console.log('add order');
        io.sockets.emit('ADD_ORDER', data);
    });

    socket.on("CHANGE_ORDER", function(data){
        console.log('change order');
        io.sockets.emit('CHANGE_ORDER', data);
    });
});
