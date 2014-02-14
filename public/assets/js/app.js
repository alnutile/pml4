$(document).ready(function(){
    window.app = {

        message: function (message) {
            console.log(message);
        },

        notice: function ( message, type ) {
            var n = noty({
                text: message,
                type: type
            });
        }
    };
});