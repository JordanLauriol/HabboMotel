
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Le Motel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="/css/habboflashclient.css"/>  <link rel="stylesheet" href="/css/ajax/base.css"/>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="/js/swfobject.js"></script>
</head>
<body id="client" class="flashclient">
    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.async=true; js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.11&appId=2042368839367599';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <script type="text/javascript">
    var hostname = "https://www.habbomotel.com";
    var notShared = "Malheureusement, tu n'as pas partagé notre publication sur tes réseaux sociaux pour ton abonnement HC.";

    $(function() {
        $("#unfreeze").click(function() {
            var originalWidth = $("#client").width();
            $("#client").width("10");
            $("#client").width(originalWidth);
        });

        setTimeout(function() {
            $("#unfreeze").show();
        }, 10000);
    });
    </script>

    <!--<div class="loading"></div>-->

    <div class="modal">
    <div class="modal-background"></div>
    <div class="modal-card" style="width: 600px">
        <header class="modal-card-head">
            <p class="modal-card-title is-uppercase has-text-centered">Oh non... pas toi :(</p>
            <!--<button class="delete is-danger" disabled aria-label="close"></button>-->
        </header>
        <section class="modal-card-body">
            <div class="content has-text-justified">
                <div class="notification" style="display: none"></div>
                <img src="/img/sticker_pointing_hand_4.gif" alt="Box" style="padding-left: 20px;" align="right" class="animated shake"/>
                <p class="title is-5 is-spaced">Hey Jordan,</p>

                <p class="subtitle is-6">Nous avons remarqué que tu utilises un <b>bloqueur de publicité</b> sur HabboMotel.</p>

                <article class="message is-info">
                    <div class="message-body">
                    Sais-tu que la publicité est la principale source de financement de HabboMotel ?                    </div>
                </article>
                <img src="/img/frank_08.gif" alt="Box" style="padding-right: 20px" align="left" class="animated shake"/>                <p>Pour nous aider à maintenir un jeu fluide et de qualité nous te demandons de désactiver le bloqueur de publicité sur notre site.</p>
                <p><b>Pas de panique</b>, sur HabboMotel nos publicités sont discrètes et ne produisent aucune gêne pour ta navigation.</p>
            </div>
        </section>
        <footer class="modal-card-foot">
            <div class="field is-grouped">
              <p class="control">
                <a class="button is-light">
                    Fermeture dans&nbsp;<b><span class="timeleft"></span></b>&nbsp;secondes                </a>
              </p>
              <p class="control">
                <a class="button is-primary close" disabled><span class="icon"><i class="fa fa-thumbs-up"></i></span><span>Je soutiens HabboMotel</span></a>
              </p>
            </div>

        </footer>
    </div>
</div>
    <script src="/js/ads.js"></script>
    <script type="text/javascript">
    if(!document.getElementById('roiIOMnjQTzf')){
        var timeleft = 20;
        var interval = setInterval(function() {
            if(timeleft >= 0) {
                $("#roiIOMnjQTza").hide();
                $(".timeleft").html(timeleft);
                timeleft--;
            }
            else {
                $("p.control").first().hide();
                $(".button").removeAttr("disabled");
                clearInterval(interval);
            }
        }, 1000);

        $(".modal").addClass("is-active");

        $(".delete, .close").click(function() {
            if(timeleft <= 0)
                $(".modal").removeClass("is-active");
        })
    } else {
        var timeleft = 20;
        var interval = setInterval(function() {
            if(timeleft > 0) {
                $(".timeLeft").html(timeleft);
                timeleft--;
            }
            else {
                $("#roiIOMnjQTza").hide();
                clearInterval(interval);
            }
        }, 1000);
    }
    </script>
    

        <div id="client-ui">
    <div id="flash-wrapper">
        <section data-id="webradio">
                    </section>

                <style>
        #roiIOMnjQTza {
            position: absolute;
            top: 8px;
            left: 50%;
            margin-left: -364px;
            z-index: 100;
            box-sizing: content-box;
            width: 728px;
            border: 4px solid #333;
            color: #fff;
            border-radius: 2px;
        }

        #roiIOMnjQTza .header {
            padding: 0 6px;
            background-color: #333;
            font-size: 13px;
            height: 20px;
        }

        #roiIOMnjQTza .close {
            position: absolute;
            right: 0;
            top: 0;
        }

        #roiIOMnjQTza .container {
            height: 90px;
        }

        </style>

        <section data-id="roiIOMnjQTza">
            <div id="roiIOMnjQTza">
                <div class="header">
                    <div class="timer-text">
                        La publicité se fermera dans <span class='timeLeft'><b>x</b></span> secondes 
                    </div>
                    <div onclick="$('#roiIOMnjQTza').hide();" class="close">x</div>
                </div>

                <div class="container">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 728x90 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-5310895972740818"
     data-ad-slot="2695623055"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>                </div>
            </div>
        </section>
                
        <!-- WebSocket on Flash -->
        <section data-id="websocket">
            <style>
            #room-loading {
                display: none;
                width: 100%;
                height: 100%;
                z-index: 200;
                background-color: rgba(0, 0, 0, 0.7);
                position: absolute;
            }

            #room-loading .room-loading-content {
                width: 700px;
                height: 600px;
                margin: auto;
            }

            #room-loading .room-loading-content .content {
                display: grid;
                grid-template-columns: 60% 40%;
                width: 100%;
                height: 100%;
                color: #FFF;
            }

            #room-loading .room-loading-content .content .user-figure {
                width: 110px;
                height: 110px;
                background: #253035;
                box-shadow: 0 0 0 1px rgba(0,0,0,.3);
                border-radius: 50%;
                border: 2px solid #465b62;
                margin: 60px auto;
            }

            #room-loading .room-loading-content .content .user-figure img {
                position: absolute;
                margin: -18px 0px 0px 0px;
            }

            #room-loading #progressbar {
                background: #003038;
                width: 100%;
                height: 40px;
                border-radius: 8px;
                border: 3px solid #237e88;
            }

            progress {
                background: #003038;
                width: 100%;
                height: 40px;
                border-radius: 8px;
                border: 3px solid #237e88;
            }
            progress::-webkit-progress-bar {
                background: #003038;
            }
            progress::-webkit-progress-value {
                background: #026768;
            } 
            progress::-moz-progress-bar {
                background: #026768;
            }
            </style>
            <section data-packet="room-loading">
                <div id="room-loading">
                    <div class="room-loading-content">
                        <div class="content">
                            <div style="background: #00283c; height: 600px;">
                                    <div class="user-figure"><img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= $this->request->session()->read("Auth.User.figure"); ?>&gesture=sml&action=&head_direction=3&size=l&headonly=1"></div>

                                    <div style="text-align: center; margin: -50px 0px 0px 0px;text-shadow: 1px 1px 1px #000, 1px 1px 0 rgba(0,0,0,.6);font-size: 26px;">
                                        <?= __("Salut {username}", [
                                            "username" => $this->request->session()->read("Auth.User.username")
                                        ]); ?>
                                    </div>

                                    <div style="padding: 20px">
                                        <center>
                                            <?= __('En route vers &laquo; <span class="roomname"></span> &raquo;'); ?><br/><br/>
                                        </center>
                                        <progress id="progressbar" value="0" max="100"></progress>
                                    </div>
                            </div>
                            <div id="roiIOMnjQTzQ">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section data-packet="hotelviewComposer">
                <div id="unfreeze" class="tooltip is-tooltip-right" data-tooltip="Débloquer mon écran">
                    <img src="/img/icons/unfreeze.png" alt=""/>                </div>
            </section>

            <section data-packet="profileInformationComposer">
                <div id="profileInformationComposer">
                </div>
                
                <div id="profileSocialComposer">
                </div>
            </section>

            <section data-packet="roomEntryInfoComposer">
                <div id="roomEntryInfoComposer" class="tooltip is-tooltip-right" data-tooltip="Outils pour propriétaire">
                    <span class="open">&#10095;</span>
                </div>

                <div class="roomEntryInfoComposer container">
                    <div class="content">
                        <li class="poll"><img src="/img/icons/questionmark.gif" style="position: absolute;" alt=""/><span class="txt">Gérer tes sondages</span></li>
                        <li class="hideWireds"><img src="/img/icons/wired.png" style="position: absolute;" alt=""/><span class="txt">Montrer / Cacher tes wireds</span></li>
                        <li class="promoteRoom"><img src="/img/icons/hc.gif" style="position: absolute;" alt=""/><span class="txt">Promouvoir son appart</span></li>
                                                <li class="ruleGame"><img src="/img/icons/rules.png" style="position: absolute;" alt=""/><span class="txt">Définir les règles de ton appart</span></li>
                                            </div>
                </div>
            </section>

            <section data-packet="roomPollComposer">
                <div id="roomPollComposer"></div>
                <div id="managePoll" class="modal-habbo ui-widget-content"></div>
            </section>

            <section data-packet="roomLeaveComposer">
            </section>

            <section data-packet="listCommandsComposer">
                <div id="listCommandsComposer" class="modal-habbo ui-widget-content">
                </div>
            </section>

            <section data-packet="notificationsComposer">
                <div id="notificationsComposer">
                </div>
            </section>

            <section data-packet="itemComposer">
                <div id="itemDisplayInformation" class="tooltip is-tooltip-left" data-tooltip="">
                    <span class="display"></span>
                </div>
            </section>

            <section data-packet="roomRuleComposer">
                <div id="roomRuleComposer" class="modal-habbo ui-widget-content"></div>
                <div id="readRules"><u>Lire les règles du jeu</u> <img src="/img/icons/rules.png" style="position: absolute;top:10px;right:10px" alt=""/></div>
                <div id="displayRules" class="modal-habbo ui-widget-content"></div>
            </section>

            <section data-packet="promoteRoomComposer">
                <div id="promoteRoomComposer" class="modal-habbo ui-widget-content"></div>
            </section>

            <section data-packet="habboClubComposer">
                <div id="habboClubComposer">
                    <img src="/img/icons/hc1.png" alt=""/>                    <span class="subscribe"></span>
                </div>

                <div id="habboClubCenter" class="modal-habbo ui-widget-content"></div>
                <div id="earnHabboClub" class="modal-habbo ui-widget-content"></div>
                <div id="advantagesHabboClub" class="modal-habbo ui-widget-content"></div>
            </section>

            <section data-packet="eventAlertComposer">
                <div id="eventAlertComposer" class="modal-habbo ui-widget-content">
                </div>
            </section>

            <div id="secretKey" data-ticket="62c54a65bd0a452bde83dad1d040c9f7cf12ae3f"></div>
        </section>
        <!-- End WebSocket On Flash -->

<!--
        <script type="text/javascript">

            if(window.name == "")
                window.name="habboClient";

            window.FlashExternalInterface = {}, window.FlashExternalInterface.logError = function() {}, window.FlashExternalInterface.logCrash = function() {}, window.FlashExternalInterface.logLoginStep = function() {}, window.FlashExternalInterface.updateBuildersClub = function() {}, window.FlashExternalInterface.subscriptionUpdated = function() {}, window.FlashExternalInterface.logDisconnection = function() {}, window.FlashExternalInterface.listPlugins = function() {}, window.FlashExternalInterface.updateName = function() {}, window.FlashExternalInterface.logout = function() {}, window.FlashExternalInterface.logDebug = function() {}, window.FlashExternalInterface.logWarn = function() {}, window.FlashExternalInterface.showInterstitial = function() {}, window.FlashExternalInterface.updateFigure = function() {}, window.FlashExternalInterface.openRoomEnterAd = function() {}, window.FlashExternalInterface.openAvatars = function() {}, window.FlashExternalInterface.closeNews = function() {}, window.FlashExternalInterface.openNews = function() {}, window.FlashExternalInterface.openMinimail = function() {}, window.FlashExternalInterface.roomVisited = function() {}, window.FlashExternalInterface.openExternalLink = function() {}, window.FlashExternalInterface.disconnect = function() {}, window.FlashExternalInterface.closeHabblet = function() {}, window.FlashExternalInterface.openHabblet = function() {}, window.FlashExternalInterface.closeWebPageAndRestoreClient = function() {}, window.FlashExternalInterface.openWebPageAndMinimizeClient = function() {}, window.FlashExternalInterface.heartBeat = function() {}, window.FlashExternalInterface.openPage = function() {}, window.FlashExternalInterface.logEventLog = function() {}, window.FlashExternalInterface.loadConversionTrackingFrame = function() {}, window.FlashExternalInterface.track = function() {}, window.FlashExternalInterface.legacyTrack = function() {}

            window.FlashExternalInterface.disconnect = function() {
                window.location.href = "";
            };

            window.FlashExternalInterface.logout = function() {
                window.location.href = "";
            };

            var flashvars = {
                "connection.info.host":"164.132.204.94",
                "connection.info.port":"31000",
                "client.reload.url": "https://www.habbomotel.com/community/error",
                "client.fatal.error.url": "https://www.habbomotel.com/community/error",
                "client.connection.failed.url": "https://www.habbomotel.com/community/error",
                "logout.url": "https://www.habbomotel.com/users/logout",
                "logout.disconnect.url": "https://www.habbomotel.com/users/logout",               
                "url.prefix":"https://www.habbomotel.com",
                "client.starting":"ça mouline.. et ça mouline..",
                "has.identity":"1",
                "client.starting.revolving":"ça mouline.. et ça mouline..",
                "spaweb":"1",
                "client.notify.cross.domain":"1",
                "unique_habbo_id":"hhus-978764",
                "client.allow.cross.domain":"1",
                "nux.lobbies.enabled":"true",
                "flash.client.origin":"popup",
                "processlog.enabled":"0",
                "sso.ticket":"62c54a65bd0a452bde83dad1d040c9f7cf12ae3f",
                "account_id":"978764",
                "productdata.load.url":"https://flash.habbomotel.in/gamedata/productdata.txt",
                "furnidata.load.url":"https://flash.habbomotel.in/gamedata/furnidata_fr.xml",
                "external.texts.txt":"https://flash.habbomotel.in/gamedata/external_flash_texts.txt",
                "external.variables.txt":"http://flash.habbomotel.in/gamedata/external_variables.txt",
                "external.figurepartlist.txt":"https://flash.habbomotel.in/gamedata/figuredata.xml",
                "external.override.texts.txt":"https://habboon.pw/gamedata/override/external_flash_override_texts/06052018",
                "external.override.variables.txt":"https://flash.habbomotel.in/gamedata/override/external_override_variables_night.txt",
                "flash.client.url":"https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/",
            };

            var params = {
                "base" : "https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/",
                "allowScriptAccess" : "always",
                "menu" : "false",
                "wmode": "opaque"
            };

            swfobject.embedSWF('https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/Habbo_cracked.swf', 'flash-container', '100%', '100%', '11.1.0', '//habboo-a.akamaihd.net/habboweb/63_1d5d8853040f30be0cc82355679bba7c/10404/web-gallery/flash/expressInstall.swf', flashvars, params, null, null);
        </script>
-->
        <object id="flash-container" type="application/x-shockwave-flash" data="https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/Habbo_cracked.swf" style="visibility: visible;" width="100%" height="100%">
            <param name="base" value="https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/">
            <param name="allowScriptAccess" value="always">
            <param name="menu" value="false">
            <param name="wmode" value="gpu">
            <param name="flashvars" value="connection.info.host=164.132.204.94&amp;connection.info.port=31000&amp;client.reload.url=http://www.habbomotel.com/community/error&amp;client.fatal.error.url=http://www.habbomotel.com/community/error&amp;client.connection.failed.url=http://www.habbomotel.com/community/error&amp;logout.url=http://dev.habbomotel.com/&amp;logout.disconnect.url=http://www.habbomotel.com/&amp;url.prefix=http://www.habbomotel.com&amp;client.starting=Patiente encore un peu..&amp;has.identity=1&amp;client.starting.revolving=ça mouline.. et ça mouline..&amp;spaweb=0&amp;client.notify.cross.domain=1&amp;unique_habbo_id=hhus-978764&amp;client.allow.cross.domain=1&amp;nux.lobbies.enabled=true&amp;flash.client.origin=popup&amp;processlog.enabled=0&amp;sso.ticket=62c54a65bd0a452bde83dad1d040c9f7cf12ae3f&amp;account_id=1&amp;productdata.load.url=https://flash.habbomotel.in/gamedata/productdata.txt&amp;furnidata.load.url=https://flash.habbomotel.in/gamedata/furnidata_fr.xml&amp;external.texts.txt=https://flash.habbomotel.in/gamedata/external_flash_texts.txt&amp;external.variables.txt=http://flash.habbomotel.in/gamedata/external_variables.txt&amp;external.figurepartlist.txt=https://flash.habbomotel.in/gamedata/figuredata.xml&amp;external.override.texts.txt=https://flash.habbomotel.in/gamedata/override/external_flash_override_texts.txt&amp;external.override.variables.txt=https://flash.habbomotel.in/gamedata/override/external_override_variables_night.txt&amp;flash.client.url=https://flash.habbomotel.in/gordon/PRODUCTION-201711211204-412329988/">
        </object>
    </div>

    <!-- WebSocket without Flash -->
    <div id="withoutFlash">
        <section data-packet="itemComposer">
            <div id="itemInformationComposer">
            </div>
        </section>
    </div>
    <!-- End WebSocket without Flash -->
</div>

    <script>
    var wsHost = "ws.habbomotel.com";
    var wsPort = "8081";
    </script>

    <audio id="notificationAudio">
        <source src="/sounds/light.ogg">
    </audio>

    <script src="/js/websocket/main.js"></script>    <script src="/js/websocket/RoomComposer.js"></script>    <script src="/js/websocket/RoomPollComposer.js"></script>    <script src="/js/websocket/UserComposer.js"></script>    <script src="/js/websocket/NotificationComposer.js"></script>    <script src="/js/websocket/ItemComposer.js"></script>    <script src="/js/websocket/CommandComposer.js"></script>    <script src="/js/websocket/HabboClubComposer.js"></script>    <!--<script>
    $(window).load(function() {
        setTimeout(function() {
            $(".loading").fadeOut("slow");;
        }, 2500);
    });
    </script>-->
</body>
</html>
