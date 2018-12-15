// Namespace global
var Main = { };

// Initialisation des messages
var Message = {
    'RoomComposer' : null,
    'RoomPollComposer': null,
    'UserComposer': null,
    'NotificationComposer': null,
    'ItemComposer': null,
    'CommandComposer': null,
    'HabboClubComposer': null
};

$(document).ready(function() {
    Main.hostname = hostname;

    // Initialisation de la connexion avec le serveur WS.
    Main.websocket = new WebSocket("wss://" + wsHost + "/websocket/" + $("#secretKey").attr("data-ticket"));

    /**
     * Lorsqu'une connexion est ouverte avec le serveur WS.
     * @param
     */
    Main.websocket.onopen = function() {
        console.log("User is connected");  
    }

    /**
     * Lorsqu'une connexion est fermée avec le serveur WS.
     * @param
     */
    Main.websocket.onclose = function() {
        console.log("User is disconnected");
    }

    /**
     * Lorsque le serveur envoie des données au client.
     * @param {JSON} message - Données envoyées par le serveur WS.
     */
    Main.websocket.onmessage = function(message) {
        var message = JSON.parse(message.data);
        
        switch(message.packet.name) {
            case "RoomComposer": {
                Main.RoomComposer().receive(message);
                break;
            }
            case "RoomPollComposer": {
                Main.RoomPollComposer().receive(message);
                break;
            }
            case "UserComposer": {
                Main.UserComposer().receive(message);
                break;
            }
            case "NotificationComposer": {
                Main.NotificationComposer().receive(message);
                break;
            }
            case "ItemComposer": {
                Main.ItemComposer().receive(message);
                break;
            }
            case "CommandComposer": {
                Main.CommandComposer().receive(message);
                break;
            }
            case "HabboClubComposer": {
                Main.HabboClubComposer().receive(message);
                break;
            }
        }
    }

    /**
     * Intègre la fonction à jQuery pour l'animation des éléments du DOM.
     * @param {string} animationName - Nom de l'action
     * @param {object} callback - Callback de retour
     */
    $.fn.extend({
        animateCss: function (animationName, callback) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
                if (callback) {
                  callback();
                }
            });
            return this;
        }
    });

    $.fn.extend({
        isJSON: function(str) {
            try {
              return (JSON.parse(str) && !!str);
            }
            catch(e) {
              return false;
            }
        }
    });

    /*$(document).on("contextmenu", "body", function(event) {
        event.preventDefault();
        return false;
    });*/
});
