<p class="title is-4 is-uppercase"><?= __('Classement des animations'); ?></p>
<p class="subtitle is-6"><?= __('du mois de {0}', date('F')); ?></p>
<div class="columns events">
    <div class="column">
        <?= $this->Html->image('prize_events.png'); ?>
        <?php
        $class = [
            1 => "is-gold",
            2 => "is-silver",
            3 => "is-bronze"
        ];

        $position = 1;
        foreach($playersSortByEvents as $player) {
            if(array_key_exists($position, $class)) {
                $classname = $class[$position];
            } else {
                $classname = "";
            }

            echo '<div class="box ' . $classname  . '">
                    <div class="position">' . $position . '</div>
                    <div class="half-figure" style="background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $player->figure . '&gesture=sml&direction=2&head_direction=2&size=m);"></div>
                    <div class="user-information">
                        <strong>' . $player->username . '</strong><br/>
                        ' . $player->anim_points . ' ' . $this->Html->image("icons/stars.png", ["class" => "stars"]) . '
                    </div>
                </div>';

            $position++;
        }
        ?>
    </div>

    <div class="column is-narrow" style="width: 331px">
        <h1 class="title is-5">Badges à remporter aux animations</h1>
        <h3 class="subtitle is-6">classés du plus rare au moins rare à obtenir</h3>
        <?php
            foreach($rewardBadges as $badge) {
                echo '<div style="margin-left: 50px; margin-bottom: 14px;">
                    <img src="https://flash.habbomotel.com/c_images/album1584/' . $badge["badge_id"] . '.gif" />
                    <small style="margin: 10px 0px 0px 10px; position: absolute;">' . $badge["chance"] . '% de chance</small>
                </div>';
            }
        ?>
    </div>

    <div class="column is-3">
        <?php if($this->request->session()->check('Auth.User.id')) { ?>
        <div class="box">
            <div class="box-title is-blue has-text-centered is-uppercase">
                <?= __('Statistiques'); ?>
            </div>

            <div class="content">
                <p>
                    <?= $this->Html->image("icons/stars.png", ["class" => "stars"]); ?>&nbsp; <?= $this->request->session()->read('Auth.User.anim_points'); ?> <?= __("étoiles"); ?>
                </p>
                <p>
                    <?= $this->Html->image("icons/king.png", ["class" => "stars"]); ?>&nbsp; <?= __("Tu as été 0 fois en tête du classement."); ?>
                </p>
                <p>
                    <?= $this->Html->image("icons/box.png", ["class" => "stars"]); ?>&nbsp; <?= __("Tu as ouvert 0 boîte mystère."); ?>
                </p>
            </div>
        </div>
        <?php } ?>

        <div class="box">
            <div class="content">
                <p><?= __("Le palmarès des animations est mis à jour tous les mois. Durant chaque animation, les habbos remportent des lots ainsi que des étoiles pour le classement."); ?>

                </p>
                <p><?= __("À la fin du mois, les habbos ayant le plus d'étoiles remportent un badge inédit."); ?>

                </p>
                <p>
                    <?= __("Les habbos cumulant 80 étoiles dans le mois pourront ouvrir un cadeau surprise."); ?>
                </p>
            </div>
        </div>
    </div>
</div>
