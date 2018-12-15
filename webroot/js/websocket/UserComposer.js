$(document).ready(function() {

    Main.UserComposer = function() {
        return new function() {
            /**
             * Récupère et enregistre les messages envoyées par le serveur dans une variable
             * @param {JSON} message - Données envoyées par le serveur 
             * @return Déclenche les actions correspondantes au message
             */
            this.receive = function(message) {
                Message["UserComposer"] = message;
                this.actions();
            }

            /**
             * Déclenche les actions correspondantes au message reçue
             * @param {UserComposer} message - Données envoyées par le serveur
             * @return Déclenche l'action correspondante au message.
             */
            this.actions = function() {
                switch(Message["UserComposer"].packet.action) {
                    case "GetUser": {
                        return this.getUser();
                        break;
                    }

                    case "EventAlert": {
                        return this.eventAlert();
                        break;
                    }
                }
            }

            /**
             * Lorsque l'utilisateur clique sur un autre utilisateur dans un l'hôtel.
             * @param {UserComposer} message - Données envoyées par le serveur
             */
            this.getUser = function() {
                $.post(Main.hostname + "/ajax/profileInformationComposer", { message : Message["UserComposer"] })
                .done(function(result) {
                    if(result == "null") {
                        $("#profileInformationComposer").hide();
                        return;
                    }

                    $("#profileInformationComposer").html(result).show();
                    var unfreeze = $("#unfreeze").position();
                    if(unfreeze.top == 15 && unfreeze.left == 15) {
                        $("#unfreeze").css({ top: "78px", left: "22px" });
                    }

                    $("#profileInformationComposer .close").click(function() {
                        $(this).closest("#profileInformationComposer").hide();
                        unfreeze = $("#unfreeze").position();
                        if(unfreeze.top == 78 && unfreeze.left == 22) {
                            $("#unfreeze").css({ top: "15px", left: "15px" });
                        }
                    });

                    // Media social
                    if($("#profileSocialComposer").css("display") == "block") {
                        Main.UserComposer().social();
                    }

                    $("#profileInformationComposer .user-information").click(function() {
                        Main.UserComposer().social();
                    });
                });
            }

            /**
             * L'utilisateur accède aux informations relatives aux réseaux sociaux de l'utilisateur cible.
             * @param {UserComposer} message - données envoyées par le serveur.
             */
            this.social = function() {
                $.post(Main.hostname + "/ajax/profileSocialComposer", { 
                    message : Message["UserComposer"]
                })
                .done(function(result) {
                    if(result == "null") { 
                        $("#profileSocialComposer").hide();
                        return;
                    }
                    
                    $("#profileSocialComposer").html(result).animateCss("fadeInLeft").show();

                    var canRate = ($(".user-rate").attr("data-canrate") == 'true');
                    $(".user-rate .rate .stars").bind({
                        click: function() {
                            var index = $(this).index();

                            if(canRate) {
                                $.post(Main.hostname + "/ajax/ratePlayerById", {
                                    message: Message["UserComposer"],
                                    rate: index
                                })
                                .done(function(content) {
                                    $(".rate .stars").each(function(i) {
                                        if(i < index) {
                                            $(this).addClass("is-active");
                                        }
                                    });
                                    canRate = false;
                                });
                            }
                        },
                        mouseleave: function() {
                            var index = $(this).index();

                            if(canRate) {
                                $(".user-rate .rate .stars").each(function(i) {
                                    if(i < index) {
                                        $(this).removeClass("is-active");
                                    }
                                });
                            }
                        },
                        mouseenter: function() {
                            var index = $(this).index();
                            if(canRate) {
                                $(".user-rate .rate .stars").each(function(i) {
                                    if(i < index) {
                                        $(this).addClass("is-active");
                                    }
                                });
                            }
                        }
                    });

                    // Close social profile
                    $("#profileSocialComposer .header .close").click(function() {
                        $(this).closest("#profileSocialComposer").animateCss("fadeOutLeft", function() {
                            $("#profileSocialComposer").hide();
                        });
                    });
        
                    // Add friend
                    $("#profileSocialComposer .add-friend").click(function() {
                        var data = {
                            packet: {
                                name: "ProfileSocialComposer.AddFriend"
                            },
                            friend: {
                                username: Message["UserComposer"].user.username
                            }
                        };
                        Main.websocket.send(JSON.stringify(data));
        
                        $(this).closest('.friend').html('Demande envoyée');
                    });
                });
            }

            /**
            * Lorsqu'un evenement est envoyé l'alerte apparaît
            * @param {UserComposer} message - Données envoyées par le serveur
            */
            this.eventAlert = function() {
                console.log(Message["UserComposer"]);

                $.post(Main.hostname + "/ajax/eventAlert", {
                    message: Message["UserComposer"]
                })
                .done(function(result) {
                    var eventAlert = $("#eventAlertComposer");

                    if(eventAlert.css("display") == "none")
                        $("#eventAlertComposer").animateCss("bounceInLeft").draggable().show();

                    $("#eventAlertComposer").html(result);

                    $("#eventAlertComposer .close").click(function() {
                        $("#eventAlertComposer").hide();
                    });

                    $("#eventAlertComposer #follow").click(function(event) {
                        event.preventDefault();

                        var data = {
                            packet: {
                                name: "NotificationsComposer.FollowRoom"
                            },
                            room: {
                                id: Message["UserComposer"].event.roomId
                            }
                        };

                        $("#eventAlertComposer").hide();
                        Main.websocket.send(JSON.stringify(data));
                    })
                });
            }
        }
    }
});