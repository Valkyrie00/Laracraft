var server = require('http').Server();

var io = require('socket.io')(server);


var Redis = require('ioredis');

var redis = new Redis();


redis.subscribe('laracraft');


redis.on('message', function(channel, message) {

    message = JSON.parse(message);

    io.emit(channel + ':' + message.event, message.data);

    //console.log(channel, message);

});



server.listen(3000);