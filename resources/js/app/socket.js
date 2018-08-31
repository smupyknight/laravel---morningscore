const io = require("socket.io-client");
const uuid = require('uuid/v4');
const console = require("app/services/logger");

//const hosts = ["http://127.0.0.1:4002", "http://127.0.0.1:4003", "http://127.0.0.1:4004"];
//const hosts = ["https://socket.msio.pw"];
//pconst hosts = ["http://socket.morningscore.dk"];
const hosts = ["https://socket.morningscore.io"];

class API {

    constructor() {
        //this.makeSocket();
        this.dataBackCount = 0;
    }

    get host() {
        let key = Math.floor(Math.random() * (hosts.length));
        console.log(hosts, key);
        return hosts[key];
    }

    get emitsPerSocket() {
        return 10;
    }

    makeSocket() {
        if (typeof(this.socketsCount) === 'undefined') {
            this.socketsCount = 0;
        }
        this.socketsCount++;

        let host = this.host;

        this.socket = io.connect(host, {reconnect: true, transports: ['websocket']});

        //this.socket = socketIOClient(host);

        this.socket.jobs = 0;

        this.socket.on('connect', function (socket) {
            //console.log('Connected');
        });

        this.socket.on('reconnect_attempt', () => {
            this.socket.io.opts.transports = ['polling', 'websocket'];
        });

        console.log('Created socket', this.socketsCount, host);
    }

    getSocket() {
        if (typeof(this.socket) === 'undefined' || this.socket === null || this.socket.jobs >= this.emitsPerSocket) {
            this.makeSocket();
        }

        return this.socket;
    }

    setCallback(channel, id, callback) {

        if (typeof(this.callbacks) === 'undefined') {
            this.callbacks = {};
        }

        if (typeof(this.callbacks[channel]) === 'undefined') {
            this.callbacks[channel] = {};
        }

        this.callbacks[channel][id] = callback;

    }

    executeCallback(channel, id, data) {


        if (typeof(this.callbacks) === 'undefined') {
            return;
        }

        if (typeof(this.callbacks[channel]) === 'undefined') {
            return;
        }

        this.callbacks[channel][id](data);
    }

    toPayload(request){
        let payload = {};
        payload.data = request;
        payload.id = uuid();
        return payload;
    }

    request(channel, payload, callback) {
        this.setCallback(channel, payload.id, callback);
        var socket = this.getSocket();
        socket.jobs++;
        socket.emit(channel, payload, (data) => {
            socket.jobs--;
            if (socket.jobs <= 0) {
                socket.disconnect();
                this.socket = null;
            }
            this.dataBackCount++;
            console.log('Got some data back', payload, data, this.dataBackCount);
            callback(data);
        });
    }

}

module.exports = new API();
