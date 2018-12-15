$(document).ready(function() {

    Main.RoomPollComposer = function() {
        return new function() {
            /**
             * Récupère et enregistre les messages envoyées par le serveur dans une variable
             * @param {JSON} message - Données envoyées par le serveur 
             * @return Déclenche les actions correspondantes au message
             */
            this.receive = function(message) {
                Message["RoomPollComposer"] = message;
                this.actions();
            }

            /**
             * Déclenche les actions correspondantes au message reçue
             * @param {RoomPollComposer} message - Données envoyées par le serveur
             * @return Déclenche l'action correspondante au message.
             */
            this.actions = function() {
                switch(Message["RoomPollComposer"].packet.action) {
                    case "DisplayPoll": {
                        return this.displayPoll();
                        break;
                    }
                    case "RefreshVote": {
                        return this.refreshVote();
                        break;
                    }

                    case "ClosePoll": {
                        return this.closePoll();
                        break;
                    }
                }
            }

            /**
             * Initialise un sondage dans un appartement
             * @param {RoomComposer} message - données envoyées par le serveur
             */
            this.initializePoll = function() {
                var data = {
                    packet: {
                        name: "RoomPollComposer.InitializePoll"
                    },
                    room: {
                        id: Message["RoomComposer"].room.id
                    }
                };

                Main.websocket.send(JSON.stringify(data));
            }

            /**
             * Affiche le sondage en cours dans l'appartement.
             * @param {RoomPollComposer} message - données envoyées par le serveur.
             */
            this.displayPoll = function() {
                $.get(Main.hostname + "/ajax/roomPollComposer")
                .done(function(content) {
                    // Affichage du sondage
                    if($("#roomPollComposer").css("display") == "none")  
                        $("#roomPollComposer").html(content).animateCss("fadeInDown").show();  

                    // Ajustement des règles
                    if($("#readRules").css("display") == "block") {
                        $("#readRules").css("top", "125px");
                        $("#readRules").css("right", "200px");
                    }

                    // Cache le HabboClub
                    $("#habboClubComposer").hide();

                    $(".polling").attr("data-poll", Message["RoomPollComposer"].poll.id);
                    $(".question").html(Message["RoomPollComposer"].poll.question);
                    $(".likeCount").html(Message["RoomPollComposer"].poll.likeCount);
                    $(".dislikeCount").html(Message["RoomPollComposer"].poll.dislikeCount);
                    
                    var data = {
                        packet: {
                            name: "RoomPollComposer.AddAnswer"
                        },
                        room: {
                            id: Message["RoomComposer"].room.id
                        },
                        user: {
                            id: Message["RoomComposer"].user.id
                        },
                        poll : {
                            id: $(".polling").attr("data-poll")
                        }
                    };

                    // Quand l'utilisateur clique sur le bouton +1
                    $(".polling .like").click(function() {
                        data["poll"]["answer"] = "1";
                        Main.websocket.send(JSON.stringify(data));
                    });

                        // Quand l'utilisateur clique sur le bouton -1
                    $(".polling .dislike").click(function() {
                        data["poll"]["answer"] = "-1";
                        Main.websocket.send(JSON.stringify(data));
                    });
                });
            }

            /**
             * Rafraîchit le score du sondage en cours dans l'appartement.
             * @param {RoomPollComposer} message - Données envoyées par le serveur
             */
            this.refreshVote = function() {
                $(".polling .likeCount").html(Message["RoomPollComposer"].poll.likeCount);
                $(".polling .dislikeCount").html(Message["RoomPollComposer"].poll.dislikeCount);
            }

            /**
             * Gestion des sondages dans l'appartement
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.managePoll = function() {
                $.post(Main.hostname + "/ajax/managePollComposer", { 
                    message : Message["RoomComposer"] 
                })
                .done(function(content) {
                    $("#managePoll").html(content).draggable().show();
                    
                    $("#managePoll .close").click(function() {
                        $("#managePoll").hide();
                    });

                    if($("#createPoll").empty()) {
                        Main.RoomPollComposer().createPoll();
                    }

                    $(".createPoll").click(function() {
                        Main.RoomPollComposer().createPoll();
                    });
                    
                    $(".inProgressPoll").click(function() {
                        Main.RoomPollComposer().inProgressPoll();
                    });                               

                    $(".historyPoll").click(function() {
                        Main.RoomPollComposer().historyPoll();
                    }); 
                });
            }

            /**
             * Création d'un nouveau sondage dans l'appartement
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.createPoll = function() {
                $.get(Main.hostname + "/ajax/createPoll")
                .done(function(content) {
                    $("#createPoll").html(content);

                    $("#form-createPoll").submit(function(event) {
                        event.preventDefault();
                        
                        var serializeForm = {
                            'question' : $("#question").val()
                        };

                        $.post(Main.hostname + "/ajax/createPoll", {
                            message: Message["RoomComposer"],
                            data: serializeForm
                        })
                        .done(function(content) {
                            var response = JSON.parse(content);
                   
                            $("#managePoll #createPoll #message .notification").addClass(response.type).html(response.text).animateCss("fadeInDown").show();

                            if(response.type == "is-success") {
                                Main.RoomPollComposer().initializePoll();   
                            }
                        });
                    });

                })
                .fail(function() {
                    console.error("[RoomPollComposer.createPoll] Une erreur est survenue dans la création d'un sondage.");
                });
            }

            /**
             * Gestion du sondage en cours
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.inProgressPoll = function() {
                $.get(Main.hostname + "/ajax/inProgressPoll", {
                    message: Message["RoomComposer"]
                })
                .done(function(content) {
                    $("#inProgressPoll").html(content);

                    $("#managePoll #inProgressPoll #enabled").click(function() {
                        $.post(Main.hostname + "/ajax/inProgressPoll", {
                            message: Message["RoomComposer"]
                        })
                        .done(function(content) {
                            var response = JSON.parse(content);
                            if(response.type == "is-success") {

                                $("#managePoll #inProgressPoll #message .notification").addClass(response.type).html(response.text).animateCss("fadeInDown").show();
                                
                                $("#managePoll #inProgressPoll #enabled").attr("disabled", true);

                                var data = {
                                    packet: {
                                        name: "RoomPollComposer.ClosePoll"
                                    },
                                    room: {
                                        id: Message["RoomComposer"].room.id
                                    },
                                    user: {
                                        id: Message["RoomComposer"].user.id
                                    }
                                };

                                Main.websocket.send(JSON.stringify(data));    
                            }
                        });
                    });
                })
                .fail(function() {
                    console.error('[RoomPollComposer.inProgressPoll] Une erreur est survenue lors de l\'arrêt du sondage');
                });
            }

            /**
             * Historique des sondages
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.historyPoll = function() {
                $.get(Main.hostname + "/ajax/historyPoll", {
                    message: Message["RoomComposer"]
                })
                .done(function(content) {
                    $("#historyPoll").html(content);

                    $(".media").each(function(index, element) {
                        $(this).find('.fa-trash').click(function(event) {
                            event.preventDefault();
                            $.post(Main.hostname + "/ajax/historyPoll/", {
                                message: Message["RoomComposer"],
                                poll: $(element).attr("data-poll")
                            })
                            .done(function() {
                                $(element).fadeOut("slow");
                            });
                        });
                    });
                });
            }

            /**
             * Ferme le sondage en cours dans l'appartement
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.closePoll = function() {
                // Fermeture du sondage
                $("#roomPollComposer").animateCss("fadeOutUp", function() {
                    $("#roomPollComposer").hide();

                    if($("#readRules").css("display") == "block") {
                        $("#readRules").css("top", "5px");
                        $("#readRules").css("right", "310px");
                    }

                    $("#habboClubComposer").show();
                });
            }
        }
    }
});