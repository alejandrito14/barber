cordova.define("cordova-plugin-customfcmreceiver.CustomFCMReceiverPlugin", function(require, exports, module) {
var receiverFn = function(){};

var customfcmreceiver = {};

customfcmreceiver.registerReceiver = function(callback) {
    receiverFn = callback;
};

customfcmreceiver._onMessageReceived = function(message){
    receiverFn(message);
};

module.exports = customfcmreceiver;

});
