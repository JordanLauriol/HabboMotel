<div id="client-ui">
    <div id="flash-wrapper">
        <section data-id="webradio">
            <?php if($locale == "pt_PT") { ?>
            <script>
                $(document).ready(function() {
                    $.get("https://radio.habbomotel.in/player/")
                    .done(function(content) {
                        $("#radio").html(content);
                    });
                });
            </script>
            <div class="draggable ui-widget-content ui-draggable" id="radio">
            </div>
            <?php } ?>
        </section>

        <?php if($this->request->session()->read('Auth.User.username') == "Jordan") { ?>
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
                        <?= __("La publicité se fermera dans <span class='timeLeft'><b>x</b></span> secondes"); ?> 
                    </div>
                    <div onclick="$('#roiIOMnjQTza').hide();" class="close">x</div>
                </div>

                <div class="container">
                    <?= $this->element('Advertising/728x90'); ?>
                </div>
            </div>
        </section>
        <?php } ?>
        
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
                <div id="unfreeze" class="tooltip is-tooltip-right" data-tooltip="<?= __("Débloquer mon écran"); ?>">
                    <?= $this->Html->image('icons/unfreeze.png'); ?>
                </div>
            </section>

            <section data-packet="profileInformationComposer">
                <div id="profileInformationComposer">
                </div>
                
                <div id="profileSocialComposer">
                </div>
            </section>

            <section data-packet="roomEntryInfoComposer">
                <div id="roomEntryInfoComposer" class="tooltip is-tooltip-right" data-tooltip="<?= __("Outils pour propriétaire"); ?>">
                    <span class="open">&#10095;</span>
                </div>

                <div class="roomEntryInfoComposer container">
                    <div class="content">
                        <li class="poll"><?= $this->Html->image('icons/questionmark.gif', ['style' => 'position: absolute;']); ?><span class="txt"><?= __('Gérer tes sondages'); ?></span></li>
                        <li class="hideWireds"><?= $this->Html->image('icons/wired.png', ['style' => 'position: absolute;']); ?><span class="txt"><?= _('Montrer / Cacher tes wireds'); ?></span></li>
                        <li class="promoteRoom"><?= $this->Html->image('icons/hc.gif', ['style' => 'position: absolute;']); ?><span class="txt"><?= __('Promouvoir son appart'); ?></span></li>
                        <?php if($this->request->session()->read('Auth.User.rank') > 5) { ?>
                        <li class="ruleGame"><?= $this->Html->image('icons/rules.png', ['style' => 'position: absolute;']); ?><span class="txt"><?= __('Définir les règles de ton appart'); ?></span></li>
                        <?php } ?>
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
                <div id="readRules"><u><?= __('Lire les règles du jeu'); ?></u> <?= $this->Html->image('icons/rules.png', ['style' => 'position: absolute;top:10px;right:10px']); ?></div>
                <div id="displayRules" class="modal-habbo ui-widget-content"></div>
            </section>

            <section data-packet="promoteRoomComposer">
                <div id="promoteRoomComposer" class="modal-habbo ui-widget-content"></div>
            </section>

            <section data-packet="habboClubComposer">
                <div id="habboClubComposer">
                    <?= $this->Html->image('icons/hc1.png'); ?>
                    <span class="subscribe"></span>
                </div>

                <div id="habboClubCenter" class="modal-habbo ui-widget-content"></div>
                <div id="earnHabboClub" class="modal-habbo ui-widget-content"></div>
                <div id="advantagesHabboClub" class="modal-habbo ui-widget-content"></div>
            </section>

            <section data-packet="eventAlertComposer">
                <div id="eventAlertComposer" class="modal-habbo ui-widget-content">
                </div>
            </section>

            <div id="secretKey" data-ticket="<?= $ssoTicket; ?>"></div>
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
                "connection.info.host":"<?= $flashVars['emulator']['host']; ?>",
                "connection.info.port":"<?= $flashVars['emulator']['port']; ?>",
                "client.reload.url": "https://<?= $_SERVER['HTTP_HOST']; ?>/community/error",
                "client.fatal.error.url": "https://<?= $_SERVER['HTTP_HOST']; ?>/community/error",
                "client.connection.failed.url": "https://<?= $_SERVER['HTTP_HOST']; ?>/community/error",
                "logout.url": "https://<?= $_SERVER['HTTP_HOST']; ?>/users/logout",
                "logout.disconnect.url": "https://<?= $_SERVER['HTTP_HOST']; ?>/users/logout",               
                "url.prefix":"https://<?= $_SERVER['HTTP_HOST']; ?>",
                "client.starting":"<?= $flashVars['client']['revolving']; ?>",
                "has.identity":"1",
                "client.starting.revolving":"<?= $flashVars['client']['revolving']; ?>",
                "spaweb":"1",
                "client.notify.cross.domain":"1",
                "unique_habbo_id":"hhus-978764",
                "client.allow.cross.domain":"1",
                "nux.lobbies.enabled":"true",
                "flash.client.origin":"popup",
                "processlog.enabled":"0",
                "sso.ticket":"<?= $ssoTicket; ?>",
                "account_id":"978764",
                "productdata.load.url":"<?= $flashVars['furni']['productdata']; ?>",
                "furnidata.load.url":"<?= $flashVars['furni']['furnidata']; ?>",
                "external.texts.txt":"<?= $flashVars['gamedata']['texts']; ?>",
                "external.variables.txt":"<?= $flashVars['gamedata']['variables']; ?>",
                "external.figurepartlist.txt":"<?= $flashVars['gamedata']['figuredata']; ?>",
                "external.override.texts.txt":"https://habboon.pw/gamedata/override/external_flash_override_texts/06052018",
                "external.override.variables.txt":"<?= $flashVars['gamedata']['variables_override']; ?>",
                "flash.client.url":"<?= $flashVars['gordon']['base']; ?>",
            };

            var params = {
                "base" : "<?= $flashVars['gordon']['base']; ?>",
                "allowScriptAccess" : "always",
                "menu" : "false",
                "wmode": "opaque"
            };

            swfobject.embedSWF('<?= $flashVars['gordon']['base'] . $flashVars['gordon']['swf']; ?>', 'flash-container', '100%', '100%', '11.1.0', '//habboo-a.akamaihd.net/habboweb/63_1d5d8853040f30be0cc82355679bba7c/10404/web-gallery/flash/expressInstall.swf', flashvars, params, null, null);
        </script>
-->
        <object id="flash-container" type="application/x-shockwave-flash" data="<?= $flashVars['gordon']['base'] . $flashVars['gordon']['swf']; ?>" style="visibility: visible;" width="100%" height="100%">
            <param name="base" value="<?= $flashVars['gordon']['base']; ?>">
            <param name="allowScriptAccess" value="always">
            <param name="menu" value="false">
            <param name="wmode" value="gpu">
            <param name="flashvars" value="connection.info.host=<?= $flashVars['emulator']['host']; ?>&amp;connection.info.port=<?= $flashVars['emulator']['port']; ?>&amp;client.reload.url=http://<?= $_SERVER['HTTP_HOST']; ?>/community/error&amp;client.fatal.error.url=http://<?= $_SERVER['HTTP_HOST']; ?>/community/error&amp;client.connection.failed.url=http://<?= $_SERVER['HTTP_HOST']; ?>/community/error&amp;logout.url=http://dev.habbomotel.com/&amp;logout.disconnect.url=http://<?= $_SERVER['HTTP_HOST']; ?>/&amp;url.prefix=http://<?= $_SERVER['HTTP_HOST']; ?>&amp;client.starting=<?= $flashVars['client']['starting']; ?>&amp;has.identity=1&amp;client.starting.revolving=<?= $flashVars['client']['revolving']; ?>&amp;spaweb=0&amp;client.notify.cross.domain=1&amp;unique_habbo_id=hhus-978764&amp;client.allow.cross.domain=1&amp;nux.lobbies.enabled=true&amp;flash.client.origin=popup&amp;processlog.enabled=0&amp;sso.ticket=<?= $ssoTicket; ?>&amp;account_id=1&amp;productdata.load.url=<?= $flashVars['furni']['productdata']; ?>&amp;furnidata.load.url=<?= $flashVars['furni']['furnidata']; ?>&amp;external.texts.txt=<?= $flashVars['gamedata']['texts']; ?>&amp;external.variables.txt=<?= $flashVars['gamedata']['variables']; ?>&amp;external.figurepartlist.txt=<?= $flashVars['gamedata']['figuredata']; ?>&amp;external.override.texts.txt=<?= $flashVars['gamedata']['texts_override']; ?>&amp;external.override.variables.txt=<?= $flashVars['gamedata']['variables_override']; ?>&amp;flash.client.url=<?= $flashVars['gordon']['base']; ?>">
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
