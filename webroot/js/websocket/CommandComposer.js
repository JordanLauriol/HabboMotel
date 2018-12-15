$(document).ready(function() {

    Main.CommandComposer = function() {
        return new function() {
            /**
             * Récupère et enregistre les messages envoyées par le serveur dans une variable
             * @param {JSON} message - Données envoyées par le serveur 
             * @return Déclenche les actions correspondantes au message
             */
            this.receive = function(message) {
                Message["CommandComposer"] = message;
                this.actions();
            }

            /**
             * Déclenche les actions correspondantes au message reçue
             * @param {UserComposer} message - Données envoyées par le serveur
             * @return Déclenche l'action correspondante au message.
             */
            this.actions = function() {
                switch(Message["CommandComposer"].packet.action) {
                    case "GetCommands": {
                        return this.getCommands();
                        break;
                    }
                }
            }

            this.getCommands = function() {
                console.log(Message["CommandComposer"]);
               $.post(Main.hostname + "/ajax/listCommandsComposer", { message : Message["CommandComposer"] })
                .done(function(result) {
                    $("#listCommandsComposer").html(result).draggable().show();
                });
            }
        }
    }
});