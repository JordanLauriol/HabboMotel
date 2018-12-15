$(document).ready(function() {
    Main.NotificationComposer = function() {
        return new function() {
            /**
             * Récupère et enregistre les messages envoyées par le serveur dans une variable
             * @param {Main} message - Données envoyées par le serveur 
             * @return Déclenche les actions correspondantes au message
             */
            this.receive = function(message) {
                Message["NotificationComposer"] = message;
                return this.actions();
            }

            /**
             * Déclenche les actions correspondantes au message reçue
             * @param {NotificationComposer} message - Données envoyées par le serveur
             * @return Déclenche l'action correspondante au message.
             */
            this.actions = function() {
                switch(Message["NotificationComposer"].packet.action) {
                    case "Display": {
                        return this.displayNotification();
                        break;
                    }
                }
            }


            /**
             * Affiche la notification à l'utilisateur
             * @param {Array} notification - Données complémentaires de la notification
             */
            this.displayNotification = function() {
                $.post(Main.hostname + "/ajax/notificationsComposer", { 
                    message: Message["NotificationComposer"],
                })
                .done(function(result) {

                    $.get(Main.hostname + "/ajax/notificationsSettings", {
                        message: Message["NotificationComposer"]
                    })
                    .done(function(result) {
                        var result = JSON.parse(result);

                        if(result.sounds) {
                            var notificationAudio = $("#notificationAudio")[0];
                            notificationAudio.play();

                            setTimeout(function() {
                                notificationAudio.pause();
                                notificationAudio.currentTime = 0;
                            }, 1000);
                        }
                    });

                    var viewNotifications;
                    
                    if(window.screen.height <= 800) {
                        viewNotifications = 4;
                    } else if(window.screen.height <= 900) {
                        viewNotifications = 5;
                    } else {
                        viewNotifications = 6;
                    }

                    if($(".notification-content").length >= viewNotifications) {
                        var firstNotification = $(".notification-content").first();
                        firstNotification.animateCss("fadeOutRight").fadeOut("slow").remove();
                    }

                    $("#notificationsComposer").append(result);
                    var lastNotification = $(".notification-content").last();
                    lastNotification.animateCss('shake', function() {

                        setTimeout(function() {
                            lastNotification.fadeOut("slow").remove();
                        }, 15000);
                    });
        
                    $('.close').click(function() {
                        $(this).parent().animateCss('fadeOutRight').fadeOut("slow").remove();
                    });

                    $('.followRoom').click(function(event) {
                        event.preventDefault();
                        var data = {
                            packet: {
                                name: "NotificationsComposer.FollowRoom"
                            },
                            room: {
                                id: Message["NotificationComposer"].parameters.room_id
                            }
                        };
        
                        // Close notification
                        $(this).closest(".notification-content").animateCss("fadeOutRight").fadeOut("slow").remove();
                    
                        Main.websocket.send(JSON.stringify(data));
                    });
                });
            }
        }
    }
});