$(document).ready(function() {

    Main.HabboClubComposer = function() {
        return new function() {
            /**
             * Récupère et enregistre les messages envoyées par le serveur dans une variable
             * @param {JSON} message - Données envoyées par le serveur 
             * @return Déclenche les actions correspondantes au message
             */
            this.receive = function(message) {
                Message["HabboClubComposer"] = message;
                return this.actions();
            }

            /**
             * Déclenche les actions correspondantes au message reçue
             * @param {HabboClubComposer} message - Données envoyées par le serveur
             * @return Déclenche l'action correspondante au message.
             */
            this.actions = function() {
                switch(Message["HabboClubComposer"].packet.action) {
                    case "Display": {
                        // Rafraîchissement du temps restants toutes les 10 minutes
                        setInterval(this.displayTimeLeft, 60000 * 10);
                        this.displayTimeLeft();
                        break;
                    }
                }
            }

            /**
            * Affiche le temps restants
            * @param {HabboClubComposer} message - Données envoyées par le serveur
            * @return
            */
            this.displayTimeLeft = function() {
                $.get(Main.hostname + "/ajax/habboClub", {
                    message: Message["HabboClubComposer"]
                })
                .done(function(result) {
                    var result = JSON.parse(result);

                    if($("#roomPollComposer").css("display") == "none")
                        $("#habboClubComposer").show().find(".subscribe").html(result.state);

                    $("#habboClubComposer").off().click(function() {
                        Main.HabboClubComposer().displayClubCenter();
                    });
                });
            }

            /**
            * Affiche le Habbo Club Center
            * @param {HabboClubComposer} message - Données envoyées par le serveur
            * @return
            */
            this.displayClubCenter = function() {
                $.get(Main.hostname + "/ajax/habboClubCenter", {
                    message: Message["HabboClubComposer"]
                })
                .done(function(content) {
                    $("#habboClubCenter").html(content).draggable().show();
                    
                    $("#habboClubCenter .earnHabboClub").click(function() {
                        $.get(Main.hostname + "/ajax/earnHabboClub", {
                            message: Message["HabboClubComposer"]
                        })
                        .done(function(result) {
                            $("#earnHabboClub").html(result).draggable().show();

                            $("#earnHabboClub .close").click(function() {
                                $("#earnHabboClub").hide();
                            });

                            $("#earnHabboClub .share").click(function() {
                                $.get(hostname + "/share/facebook", function() {
                                }, 'json')
                                .done(function(data) {
                                    FB.ui({
                                        method: "share",
                                        href: hostname,
                                        quote: data.quote,
                                        hashtag: data.hashtag
                                    }, function(response) {
                                        if (response && !response.error_message) {
                                            $.get(hostname + "/share/reward", { reward: 'habboclub' }, function() {
                                            })
                                            .done(function(result) {
                                                var response = JSON.parse(result);
                                                $("#earnHabboClub .notification").fadeIn().addClass(response.type).animateCss('bounce').text(response.message);
                                                
                                                // refresh time
                                                Main.HabboClubComposer().displayTimeLeft();
                                            });
                                        } else {
                                            $("#earnHabboClub .notification").fadeIn().addClass("is-danger").animateCss('bounce').text(notShared);
                                        }
                                    });
                                });
                            });
                        });
                    });

                    $("#habboClubCenter .advMore").click(function() {
                        $.get(Main.hostname + "/ajax/advantagesHabboClub", {
                            message: Message["HabboClubComposer"]
                        })
                        .done(function(result) {
                            $("#advantagesHabboClub").html(result).draggable().show();

                            $("#advantagesHabboClub .close").click(function() {
                                $("#advantagesHabboClub").hide();
                            });
                        });
                    });

                    // Subscribe
                    $("#habboClubCenter .subscribe").click(function() {
                        var period = $(this).attr("data-period");

                        $.post(Main.hostname + "/ajax/subscribeHabboClub", {
                            message: Message["HabboClubComposer"],
                            period: period
                        })
                        .done(function(result) {
                            var response = JSON.parse(result);
                            $("#habboClubCenter .notification").fadeIn().addClass(response.type).animateCss('bounce').text(response.message);
                                                
                            // refresh time
                            Main.HabboClubComposer().displayTimeLeft();
                        });
                    });

                    $("#habboClubCenter .close").click(function() {
                        $("#habboClubCenter").hide();
                    });
                });
            }
        }
    }
});