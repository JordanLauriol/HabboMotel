<div class="columns">
    <div class="column is-9">
        <div class="content">
            <p class="title is-4"><?= __('Confirme ton identité pour poursuivre ton aventure..'); ?></p>
            <p style="font-size: 18.5px;"><?= __('Un autre ordinateur a tenté de se connecter sur ton compte. Pour débloquer l\'accès à ton compte répond à la question de sécurité ci-dessous.'); ?></p>

            <?= $this->Form->create(); ?>
            <?= $this->Form->label('answer', $security->player_question->name, ['class' => 'label']); ?>
            <?= $this->Form->control('answer', [
                'label' => false,
                'templateVars' => [
                    'display_icon' => 'none'
                ]
            ]); ?>
            <div class="field is-grouped">
                <span class="control">
                    <?= $this->Form->submit(__('Déverrouiller mon compte'), [
                    'class' => 'button is-dark'
                    ]); ?>
                </span>
                <span class="control">
                    <?= $this->Html->link(__('Se déconnecter'), [
                        'controller' => 'Users',
                        'action'     => 'logout'
                    ], [
                        'class'      => 'button is-light'
                    ]); ?>
                </span>
            </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>

    <div class="column is-3">
        <article class="message is-dark">
            <div class="message-header">
                <p class="is-uppercase"><?= __('Informations'); ?></p>
            </div>
            <div class="message-body">
                <p><?= __('Si tu as oublié la réponse à la question de sécurité, merci de prendre contact par mail avec les membres de l\'équipe.'); ?></p>
                <br/>
                <p>
                <?= $this->Html->link(__('Se déconnecter'), [
                    'controller' => 'Users',
                    'action'     => 'logout'
                ]); ?>
                </p>
            </div>
        </article>
    </div>
</div>
