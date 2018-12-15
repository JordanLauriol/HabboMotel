<div class="modal">
    <div class="modal-background"></div>
    <div class="modal-card" style="width: 600px">
        <header class="modal-card-head">
            <p class="modal-card-title is-uppercase has-text-centered"><?= __('Oh non... pas toi :('); ?></p>
            <!--<button class="delete is-danger" disabled aria-label="close"></button>-->
        </header>
        <section class="modal-card-body">
            <div class="content has-text-justified">
                <div class="notification" style="display: none"></div>
                <?= $this->Html->image('sticker_pointing_hand_4.gif', ['alt' => 'Box', 'style' => 'padding-left: 20px;', 'align' => 'right', 'class' => 'animated shake']); ?>

                <p class="title is-5 is-spaced"><?= __('Hey {0}', $this->request->session()->read('Auth.User.username')); ?>,</p>

                <p class="subtitle is-6"><?= __('Nous avons remarqué que tu utilises un <b>bloqueur de publicité</b> sur HabboMotel.'); ?></p>

                <article class="message is-info">
                    <div class="message-body">
                    <?= __('Sais-tu que la publicité est la principale source de financement de HabboMotel ?'); ?>
                    </div>
                </article>
                <?= $this->Html->image('frank_08.gif', ['alt' => 'Box', 'style' => 'padding-right: 20px', 'align' => 'left', 'class' => 'animated shake']); ?>
                <p><?= __('Pour nous aider à maintenir un jeu fluide et de qualité nous te demandons de désactiver le bloqueur de publicité sur notre site.'); ?></p>
                <p><?= __('<b>Pas de panique</b>, sur HabboMotel nos publicités sont discrètes et ne produisent aucune gêne pour ta navigation.'); ?></p>
            </div>
        </section>
        <footer class="modal-card-foot">
            <div class="field is-grouped">
              <p class="control">
                <a class="button is-light">
                    <?= __("Fermeture dans"); ?>&nbsp;<b><span class="timeleft"></span></b>&nbsp;<?= __("secondes"); ?>
                </a>
              </p>
              <p class="control">
                <a class="button is-primary close" disabled><span class="icon"><i class="fa fa-thumbs-up"></i></span><span><?= __('Je soutiens HabboMotel'); ?></span></a>
              </p>
            </div>

        </footer>
    </div>
</div>
