<!DOCTYPE html>
<html lang="<?= $locale == "fr_FR" ? "fr" : "pt"; ?>">
<head>
  <title><?= $title; ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <?= $this->Html->css('habboflashclient'); ?>
  <?= $this->Html->css('ajax/base.css?' . $lastModified); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <?= $this->Html->script('swfobject'); ?>

</head>
<body id="client" class="flashclient">
    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.async=true; js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.11&appId=<?= ($locale == "fr_FR") ? "2042368839367599" : "209131013199447"; ?>';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <script type="text/javascript">
    var hostname = "https://<?= $_SERVER['HTTP_HOST']; ?>";
    var notShared = "<?= 'Malheureusement, tu n\'as pas partagé notre publication sur tes réseaux sociaux pour ton abonnement HC.'; ?>";

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

    <?= $this->element('Modal/adblock'); ?>
    <?= $this->Html->script('ads'); ?>

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
    

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

    <script>
    var wsHost = "<?= $flashVars["emulator"]["wsHost"]; ?>";
    var wsPort = "<?= $flashVars["emulator"]["wsPort"]; ?>";
    </script>

    <audio id="notificationAudio">
        <source src="<?= $this->request->webroot; ?>sounds/light.ogg">
    </audio>

    <?= $this->Html->script('websocket/main.js?' . $lastModified); ?>
    <?= $this->Html->script('websocket/RoomComposer.js?' . $lastModified); ?>
    <?= $this->Html->script('websocket/RoomPollComposer.js?' . $lastModified);  ?>
    <?= $this->Html->script('websocket/UserComposer.js?' . $lastModified);  ?>
    <?= $this->Html->script('websocket/NotificationComposer.js?' . $lastModified);  ?>
    <?= $this->Html->script('websocket/ItemComposer.js?' . $lastModified);  ?>
    <?= $this->Html->script('websocket/CommandComposer.js?' . $lastModified);  ?>
    <?= $this->Html->script('websocket/HabboClubComposer.js?' . $lastModified);  ?>
    <!--<script>
    $(window).load(function() {
        setTimeout(function() {
            $(".loading").fadeOut("slow");;
        }, 2500);
	});
    </script>-->
</body>
</html>
