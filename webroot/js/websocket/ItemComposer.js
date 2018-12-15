$(document).ready(function() {

    Main.ItemComposer = function() {
        return new function() {
            
            /**
             * Récupère et enregistre les messages envoyées par le serveur dans une variable
             * @param {Main} message - Données envoyées par le serveur 
             * @return Déclenche les actions correspondantes au message
             */
            this.receive = function(message) {
                Message["ItemComposer"] = message;
                return this.actions();
            }

            /**
             * Déclenche les actions correspondantes au message reçue
             * @param {ItemComposer} message - Données envoyées par le serveur
             * @return Déclenche l'action correspondante au message.
             */
            this.actions = function() {
                switch(Message["ItemComposer"].packet.action) {
                    case "GetDetails": {
                        return this.getDetails();
                        break;
                    }
                }
            }

            /**
             * Affiche les détails d'un mobis selectionné
             * @param {ItemComposer} message - Données envoyées par le serveur
             */
            this.getDetails = function() {
                $.post(Main.hostname + "/ajax/itemInformationComposer", { 
                    message : Message["ItemComposer"] 
                })
                .done(function(content) {      
                    $("#itemInformationComposer").html(content);
      
                    if($("#itemInformationComposer").css("display") == "none") {
                        $("#itemDisplayInformation").animateCss("bounceInRight").show();
                        $("#itemDisplayInformation").find(".display").html("&#10094;");
                        $("#itemDisplayInformation").attr("data-tooltip", "Voir les détails de ce mobis");
                    }

                    $("#itemDisplayInformation").off().click(function() {
                        // On ouvre les détails du mobis
                        if($("#itemInformationComposer").css("display") == "none") {
                            $("#itemInformationComposer").show();
                            $(this).find(".display").html("&#10095;");
                            $(this).attr("data-tooltip", "Rétrécir les détails");
                        } else {
                            $("#itemInformationComposer").hide();
                            $(this).find(".display").html("&#10094;");
                            $(this).attr("data-tooltip", "Voir les détails de ce mobis");
                        }
                    });

                    $("#itemInformationComposer .close").off().click(function() {
                        $("#itemInformationComposer").hide();
                        $("#itemDisplayInformation").hide();
                    });

                    var canRate = ($(".item-rate").attr("data-canrate") == 'true');
                    $(".item-rate .rate .stars").bind({
                        click: function() {
                            var index = $(this).index();

                            if(canRate) {
                                $.post(Main.hostname + "/ajax/rateItemById", {
                                    message: Message["ItemComposer"],
                                    rate: index
                                })
                                .done(function(content) {
                                    $(".item-rate .rate .stars").each(function(i) {
                                        if(i <= index) {
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
                                $(".item-rate .rate .stars").each(function(i) {
                                    if(i <= index) {
                                        $(this).removeClass("is-active");
                                    }
                                });
                            }
                        },
                        mouseenter: function() {
                            var index = $(this).index();
                            if(canRate) {
                                $(".item-rate .rate .stars").each(function(i) {
                                    if(i <= index) {
                                        $(this).addClass("is-active");
                                    }
                                });
                            }
                        }
                    });
                });
            }
        }
    }
});
