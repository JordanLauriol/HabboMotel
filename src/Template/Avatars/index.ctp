<div class="columns">
    <div class="column is-8">
        <!-- PERSONAL INFORMATION -->
        <div class="box personal-info">

            <?= $this->Html->image('https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $this->request->session()->read('Auth.User.figure') . '&gesture=sml&action=&head_direction=3&size=l', ['class' => 'figure']); ?>

            <center>
                <a style="margin-top: 30px; margin-left: 413px;"; class="button is-success sign-in is-medium is-uppercase" target="_blank" href="<?= $this->Url->build(['controller' => 'Community', 'action' => 'client']); ?>">
                    <span><?= __("Entrer dans l'hôtel"); ?></span>
                </a>
            </center>

            <div style="margin-top: 10px;margin-left: 130px;margin-right: -17px;">
                <span class="user-information">
                    <?= $this->Html->image('icons/diamond.png', ['style' => 'position: absolute; margin:3px 0 0 10px;']); ?> <span style="margin-left: 35px"><b><?= $this->Number->format($this->request->session()->read('Auth.User.vip_points')); ?></b> <?= __('diamants'); ?></span>
                </span>

                <span class="user-information">
                    <?= $this->Html->image('icons/duckets.png', ['style' => 'position: absolute; margin:3px 0 0 10px;']); ?><span style="margin-left: 35px"> <b><?= $this->Number->format($this->request->session()->read('Auth.User.activity_points')); ?></b> <?= __('duckets'); ?></span>
                </span>

                <span class="user-information">
                    <?= $this->Html->image('icons/hc.gif', ['style' => 'position: absolute; margin:5px 0 0 10px;']); ?><span style="margin-left: 35px"> <?= ($this->request->session()->read("Auth.User.vip") == "1") ? __("HC") : __("Non HC"); ?></span>
                </span>

                <span class="user-information">
                    <?= $this->Html->image('icons/hours.png', ['style' => 'position: absolute; margin:3px 0 0 10px; height:16px; width: 16px;']); ?><span style="margin-left: 35px"> <?= $this->Time->timeAgoInWords($this->request->session()->read('Auth.User.last_online')); ?></span>
                </span>
            </div>

            <?php
            /*<?= $this->Html->image('https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $this->request->session()->read('Auth.User.figure') . '&gesture=sml&action=wlk&head_direction=3&size=l', ['class' => 'figure']); ?>
            <center>
                <a style="margin-top: 30px"; class="button is-success sign-in is-medium is-uppercase" target="_blank" href="<?= $this->Url->build(['controller' => 'Community', 'action' => 'client']); ?>">
                    <span>Entrer dans l'hôtel</span>
                </a>
            </center>
            <div style="margin-top: 10px; margin-left: 150px;">
                <span class="user-information">
                    <?= $this->Html->image('icons/diamonds.png', ['style' => 'position: absolute; margin-left: 10px;']); ?> <span style="margin-left: 40px"><b><?= $this->Number->format($this->request->session()->read('Auth.User.vip_points')); ?></b> <?= __('diamants'); ?></span>
                </span>

                <span class="user-information">
                    <?= $this->Html->image('icons/duckets.png', ['style' => 'position: absolute; margin-left: 10px;']); ?><span style="margin-left: 40px"> <b><?= $this->Number->format($this->request->session()->read('Auth.User.activity_points')); ?></b> <?= __('duckets'); ?></span>
                </span>

                <span class="user-information">
                    <?= $this->Html->image('icons/hc1.png', ['style' => 'position: absolute; margin-left: 10px;']); ?><span style="margin-left: 40px"> Non HC</span>
                </span>

                <span class="user-information">
                    <?= $this->Html->image('icons/hours.png', ['style' => 'position: absolute; margin-left: 10px;']); ?><span style="margin-left: 40px"> <?= $this->Time->timeAgoInWords($this->request->session()->read('Auth.User.last_online')); ?></span>
                </span>
            </div>
            <?php */ ?>


        </div>
    </div>

    <div class="column">
        <!--
        <?php
        $facebook = $locale == "fr_FR" ? "hmotelfr" : "hmotelbr";
        ?>
        <div class="fb-page" data-href="https://www.facebook.com/<?= $facebook; ?>/" data-tabs="timeline" data-height="235" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/<?= $facebook; ?>/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?= $facebook; ?>/"><?= $facebook; ?></a></blockquote></div>
        -->
        <h2 class="title is-5"><?= __("Dernière activités"); ?></h2>
        <h3 class="subtitle is-6"><?= __("ci-dessous les discussions dernièrement actif sur le forum."); ?></h3>
        <style>
        #threads-activities {
        }

        #threads-activities .activity {
            display: block;
            margin: 0px 0px 5px 10px;
            font-size: 16px;
        }
        </style>
        <div id="threads-activities">
            <?php
            foreach($threads as $thread) {
                echo '
                <div class="activity">
                    ' . $this->Html->image("forum/flashy_arrow.gif") . ' <a class="tooltip is-tooltip-bottom" data-tooltip="' . sprintf(__("par %s"), $thread->player->username) . '" href=" ' . $this->Url->build(["controller" => "Forum", "action" => "thread", $thread->slug]) . '">' . $this->Text->truncate($thread->name, 75) . '</a>
                </div>';
            }
            ?>

            <small><center>
            <?= $this->Html->link(__("Voir plus d'activités sur le forum &raquo;"), ["controller" => "Forum", "action" => "index"], ["escape" => false]); ?>
            </center></small>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-narrow">
        <div style="width: 665px">
            <!-- CAROUSEL -->
            <div class="slideshow-container">
                <?php foreach($articles as $article) { ?>
                    <div class="mySlides fade" style="background-image:url('<?= $article->topstory; ?>');">
                        <p class="title"><?= $article->title; ?></p>
                        <a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'view', $article->slug]); ?>" style="font-size: 17px;" class="more button is-boxed is-success is-medium"><?= $article->button; ?></a>
                    </div>
                <?php } ?>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <div class="dot-container">
                    <?php $i = 0; foreach($articles as $article) { $i++;?>
                        <span class="dot" onclick="currentSlide(<?= $i; ?>)"></span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="column">
        <?= $this->element('Modal/share'); ?>

        <!-- PARRAINAGE -->
        <div class="box shared">
            <div class="box-title is-warning has-text-centered is-uppercase"><?= __('Parrainage'); ?></div>
            <div class="content">
                <?= $this->Html->image('facebook-habbo.gif', ['alt' => 'Facebook', 'align' => 'right', 'style' => 'height:220px;margin-top:-17px']); ?>

                <p class="has-text-justified">
                    <p class="title is-6 is-spaced"><?= __('{0}, tu n\'as pas encore remporté ton cadeau du jour', $this->request->session()->read('Auth.User.username')); ?></p>
                    <p class="subtitle is-6"><?= __('En ce moment des rares et des badges inédits sont à gagner.'); ?></p>

                    <?= __('Clique sur le bouton ci-dessous pour profiter de l\'offre !'); ?>
                </p>
                <p class="has-text-centered"><a class="button is-danger is-outlined modal-share"><span class="icon"><i class="fa fa-gift"></i></span><span><?= __('Parrainer à mes amis'); ?></span></a></p>
            </div>
        </div>
    </div>
</div>

<div class="notifications">
    <?php
    foreach($player->player_notifications as $notification) {
        echo $this->Text->insert('
        <article class="message is-light animated bounceInUp">
        <div class="message-header is-uppercase">
        Notification
        :delete
        </div>
        <div class="message-body">
        :message
        :read
        </div>
        </article>', [
            'message' => $notification->message,
            'created' => $this->Time->timeAgoInWords($notification->created),
            'delete'  => $this->Html->link('', [
                'controller' => 'Notifications',
                'action'     => 'read',
                $notification->id
            ], ['class' => 'delete', 'data-id' => $notification->id, 'title' => 'Marquer comme lu']),
            'read' => ($notification->location == null) ? '' : $this->Html->link(__('Voir plus'), $notification->location)
        ]);
    }
    ?>
</div>

<?php
// Newbie
if($this->request->session()->read('Auth.User.newbie') == 1) {
?>
<script>
    var trophies = { title: "<?= __("Mes Trophées"); ?>", content: "<?= __("Gagne et mets en avant <b>tes trophées</b> dans l\'hôtel en réalisant des actions<br/> sur le site, tel que commenter un article."); ?>" };

    var shared = { title: "<?= __("Partage à tes amis"); ?>", content: "<?= __("Remporte tous les jours 10 duckets pour t\'acheter<br/>des rares ou des badges en partageant <b>HabboMotel</b><br/> à tes amis !"); ?>" };

    var signin = { title: "<?= __("Rejoins les Habbos connectés"); ?>", content: "<?= __('<span class=\"icon is-small\"><i class=\"fa fa-check\"></i></span> Bravo, tu as terminé la visite guidée.</p><p>Pour rejoindre les autres utilisateurs connectés clique<br/> sur le bouton <b>\"Entrer dans l\'hôtel\"</b>.'); ?>" };
</script>
<?php
    echo $this->Html->script([
        'newbie/jquery.guide.js',
        'newbie/actions.js'
    ]);
} ?>
