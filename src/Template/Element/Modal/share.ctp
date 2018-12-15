<div class="modal">
    <div class="modal-background"></div>
    <div class="modal-card" style="width: 500px">
        <header class="modal-card-head">
            <p class="modal-card-title is-uppercase has-text-centered"><?= __('Gagne ta box du jour'); ?></p>
            <button class="delete is-danger" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            <article class="message is-info">
                <div class="message-body">
                    <?= __('Si quand tu cliques sur le bouton rien ne se déclenche, autorise les popups venant de HabboMotel.'); ?>
                </div>
            </article>
            <div class="content has-text-justified">
                <div class="notification" style="display: none"></div>
                <?= $this->Html->image('rare_mysterybox.gif', ['alt' => 'Box', 'style' => 'padding-left: 20px', 'align' => 'right', 'class' => 'animated shake']); ?>

                <p class="title is-5 is-spaced"><?= __('Hey {0}', $this->request->session()->read('Auth.User.username')); ?>,</p>

                <p class="subtitle is-6"><?= __('Tu recevras automatiquement ta box dans ton inventaire avec les rares et les badges lorsque tu auras partagé à tes amis.'); ?></p>

                <p><?= __('Pour partager à tes amis et remporter ton cadeau rien de plus simple, clique sur le bouton ci-dessous <b>"Je veux mes cadeaux"</b>.'); ?></p>
            </div>
        </section>
        <footer class="modal-card-foot">
            <a class="button is-primary share"><span class="icon"><i class="fa  fa-share-square-o"></i></span><span><?= __('Je veux mes cadeaux !'); ?></span></a>
        </footer>
    </div>
</div>
