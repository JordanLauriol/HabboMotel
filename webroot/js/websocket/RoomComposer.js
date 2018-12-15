$(document).ready(function() {
    var roomVisited = 0;
    var randomVisited = Math.floor(Math.random() * 11);

    Main.RoomComposer = function() {
        return new function() {

            /**
             * Récupère et enregistre les messages envoyées par le serveur dans une variable
             * @param {Main} message - Données envoyées par le serveur 
             * @return Déclenche les actions correspondantes au message
             */
            this.receive = function(message) {
                Message["RoomComposer"] = message;
                return this.actions();
            }

            /**
             * Déclenche les actions correspondantes au message reçue
             * @param {RoomComposer} message - Données envoyées par le serveur
             * @return Déclenche l'action correspondante au message.
             */
            this.actions = function() {
                switch(Message["RoomComposer"].packet.action) {
                    case "AddUserToRoom": {
                        return this.addUserToRoom();
                        break;
                    }
                    case "RemoveUserFromRoom": {
                        return this.removeUserFromRoom();
                        break;
                    }
                    case "UserGetCommands": {
                        return this.userGetCommands();
                        break;
                    }
                    case "DisplayRules": {
                        return this.displayRules();
                        break;
                    }
                    case "HideRules": {
                        return this.hideRules();
                        break;
                    }
                }
            }

            /**
             * Action déclenchée lorsque l'utilisateur entre dans un appartement
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.addUserToRoom = function() {
                roomVisited++;

                Main.RoomPollComposer().initializePoll();
                Main.RoomComposer().initializeRules();
                Main.HabboClubComposer().displayTimeLeft();

                if(roomVisited == randomVisited) {
                    Main.RoomComposer().loadingRoom();
                    roomVisited = 0;
                    randomVisited = Math.floor(Math.random() * 21);
                }

                if(Message["RoomComposer"].user.owner) Main.RoomComposer().rights();
            }

            /**
             * Action déclenchée lorsque l'utilisateur quitte l'appartement
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.removeUserFromRoom = function() {
                // L'utilisateur est le propriétaire de l'appartement
                if(Message["RoomComposer"].user.owner) {
                    $("#roomEntryInfoComposer").hide();
                    $("#roomEntryInfoComposer").animate({ "height": "100px" }, "fast");
                    $("#roomEntryInfoComposer").find('.open').html('&#10095;');
                    $('.roomEntryInfoComposer.container').hide();
                }

                $("#roomPollComposer").hide();
                $("#readRules").hide();
                $("#displayRules").hide();
                $("#managePoll").hide();           
                $("#itemInformationComposer").hide();
                $("#itemDisplayInformation").hide();   
            }

            /**
             * Affiche le tableau de bord des fonctionnalités du propriétaire
             * de l'appartement
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.rights = function() {
                $("#roomEntryInfoComposer").animateCss("fadeInLeftBig").toggle();
                
                $("#roomEntryInfoComposer").click(function() {
                    if($(this).css("height") == "100px") {
                        $(this).animate({ "height": "120px"}, "fast");
                        $(this).find('.open').html('&#10094;');
                
                        $('.roomEntryInfoComposer.container').animateCss('fadeInLeftBig').show();
                    }
                    else {
                        $(this).animate({ "height": "100px" }, "fast");
                        $(this).find('.open').html('&#10095;');
                
                        $('.roomEntryInfoComposer.container').hide();
                    }
                });

                $(".roomEntryInfoComposer.container .content .poll").off().click(function() {
                    Main.RoomPollComposer().managePoll();
                });

                $(".roomEntryInfoComposer.container .content .hideWireds").off().click(function() {
                    Main.RoomComposer().hideWireds();
                });

                $(".roomEntryInfoComposer.container .content .ruleGame").off().click(function() {
                    Main.RoomComposer().rules();
                });

                $(".roomEntryInfoComposer.container .content .promoteRoom").off().click(function() {
                    Main.RoomComposer().promoteRoom();
                });
            }

            /**
             * L'utilisateur souhaite afficher les commandes disponibles
             * @param {RoomComposer} messages - Données envoyées par le serveur
             */
            this.userGetCommands = function() {
                $.post(Main.hostname + "/ajax/listCommandsComposer", { 
                    message : Message["RoomComposer"] 
                })
                .done(function(content) {
                    $("#listCommandsComposer").html(content).draggable().show();
                });
            }

            /**
             * Le propriétaire souhaite faire disparaitre ou apparaître les wireds
             * @param {RoomComposer} message - Données envoyées par le serveur
             */
            this.hideWireds = function() {
                if(Message["RoomComposer"].user.owner) {
                    var data = {
                        packet: {
                            name: "RoomComposer.HideWireds"
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
            }

            /**
            * Le propriétaire souhaite définir des règles pour son appartement.
            * @param {RoomComposer} message - Données envoyées par le serveur
            */
            this.rules = function() {
                if(Message["RoomComposer"].user.owner) {
                    $.post(Main.hostname + "/ajax/roomRuleComposer", { 
                        message : Message["RoomComposer"] 
                    })
                    .done(function(content) {
                        $("#roomRuleComposer").html(content).draggable().show();

                        $("#roomRuleComposer .close").click(function() {
                            $("#roomRuleComposer").hide();
                        });

                        $("#form-rules").submit(function(event) {
                            event.preventDefault();
                            
                            var serializeForm = {
                                'rules' : $("#rules").val()
                            };

                            $.post(Main.hostname + "/ajax/createRules", {
                                message: Message["RoomComposer"],
                                data: serializeForm
                            })
                            .done(function(content) {
                                var response = JSON.parse(content);
                       
                                $("#roomRuleComposer #message .notification").addClass(response.type).html(response.text).animateCss("fadeInDown", function() {
                                    setTimeout(function() {
                                        $("#roomRuleComposer #message .notification").removeClass(response.type).hide();
                                    }, 3000);
                                }).show();

                                if(response.type == "is-success" || response.type == "is-warning") {
                                    var data = {
                                        packet: {
                                            name: "RoomComposer.ToggleRules"
                                        },
                                        room: {
                                            id: Message["RoomComposer"].room.id
                                        },
                                        user: {
                                            id: Message["RoomComposer"].user.id
                                        }
                                    };

                                    if(response.type == "is-warning") {
                                        data["room"]["rules"] = false;
                                    }
                                    else {
                                        data["room"]["rules"] = true;
                                    }

                                    Main.websocket.send(JSON.stringify(data));  

                                    if(response.type == "is-success") {
                                        Main.RoomComposer().initializeRules();   
                                    }
                                }
                            });
                        });
                    });
                }
            }

            /**
            * Initialise le règlement d'un appart lorsqu'un utilisateur entre dedans
            * @param {RoomComposer} message - Données envoyées par le serveur
            */
            this.initializeRules = function() {
                var data = {
                    packet: {
                        name: "RoomComposer.InitializeRules"
                    },
                    room: {
                        id: Message["RoomComposer"].room.id
                    }
                };

                Main.websocket.send(JSON.stringify(data));
            }

            /**
            * Affiche le règlement d'un appart
            * @param {RoomComposer} message - Données envoyées par le serveur
            */
            this.displayRules = function() {
                $.post(Main.hostname + "/ajax/displayRules", {
                    message: Message["RoomComposer"]
                })
                .done(function(content) {

                    // Ajustement par rapport aux sondages
                    if($("#roomPollComposer").css("display") == "block")
                        $("#readRules").css('top', '125px').show();
                    else 
                        $("#readRules").css('top', '5px').show();

                    if($("#readRules").css("display") == "none") {
                        $("#readRules").animateCss("fadeInDown").show();
                    }


                    $("#readRules").off().click(function() {
                        $("#displayRules").html(content).draggable().toggle();

                        $("#displayRules .close").click(function() {
                            $("#displayRules").hide();
                        });
                    });
                });
            }

            /**
            * Cache le règlement d'un appart
            * @param {RoomComposer} message - Données envoyées par le serveur
            */
            this.hideRules = function() {
                $("#readRules").animateCss("fadeOutUp", function() {
                    $("#readRules").hide();
                    $("#displayRules").hide();
                });
            }


            /**
            * Promouvoir un appartement contre des diamants
            * @param {RoomComposer} message - Données envoyées par le serveur
            */
            this.promoteRoom = function() {
                if(Message["RoomComposer"].user.owner) {
                    $.post(Main.hostname + "/ajax/promoteRoomComposer", { 
                        message : Message["RoomComposer"] 
                    })
                    .done(function(content) {
                        $("#promoteRoomComposer").html(content).draggable().show();

                        $("#promoteRoomComposer .close").click(function() {
                            $("#promoteRoomComposer").hide();
                        });

                        $("#form-promote-room").submit(function(event) {
                            event.preventDefault();
                            
                            var serializeForm = {
                                'name' : $("#name").val()
                            };

                            $.post(Main.hostname + "/ajax/createPromote", {
                                message: Message["RoomComposer"],
                                data: serializeForm
                            })
                            .done(function(content) {

                                if(!$(this).isJSON(content))
                                    return;

                                var response = JSON.parse(content);

                                $("#promoteRoomComposer #message .notification").addClass(response.type).html(response.text).animateCss("fadeInDown", function() {
                                    setTimeout(function() {
                                        $("#promoteRoomComposer #message .notification").removeClass(response.type).hide();
                                    }, 3000);
                                }).show();

                                if(response.type == "is-success") {
                                    var data = {
                                        packet: {
                                            name: "RoomComposer.PromoteRoom"
                                        },
                                        room: {
                                            id: Message["RoomComposer"].room.id
                                        },
                                        promote: {
                                            id: serializeForm['name']
                                        }
                                    };

                                    Main.websocket.send(JSON.stringify(data));
                                }
                            });
                        });
                    });
                }
            }


            /**
            * Promouvoir un appartement contre des diamants
            * @param {RoomComposer} message - Données envoyées par le serveur
            */
            this.loadingRoom = function() {
                $("#room-loading").css("display", "flex");
                $("#room-loading .roomname").html(Message["RoomComposer"].room.name);

                $.get(Main.hostname + "/socyalize/socyalize", { })
                .done(function(result) {
                    $("#roiIOMnjQTzQ").html(result);
                });

                var progressbar = $("#room-loading #progressbar");
                var interval = setInterval(function() {
                    var progress = parseInt(progressbar.attr("value"));

                    if(progress < 100) {
                        var more = 0;
                        if(progress < 25) {
                            more = 3;
                        } else if(progress < 60) {
                            more = 5;
                        } else {
                            more = 10;
                        }

                        progressbar.attr("value", (progress + more));
                    } else {
                        $("#room-loading #progressbar").attr("value", "0");
                        $("#room-loading").css("display", "none");
                        clearInterval(interval);
                    }
                }, 100);
            }
        }
    }
});
