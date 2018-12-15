<div class="content">
    <p class="title is-4"><?= __('Sécurise ton compte avant de poursuivre ton aventure..'); ?></p>
    <progress class="progress is-success" value="90" max="100"></progress>
    <p style="font-size: 18.5px;"><?= __('En sécurisant ton compte par une question de sécurité, tu protèges ton compte contre les connexions depuis un autre ordinateur que le tien.'); ?></p>

    <?= $this->Form->create($security); ?>
    <?= $this->Form->hidden('player_id', [
        'value' => $this->request->session()->read('Auth.User.id')
    ]); ?>
    <?= $this->Form->label('question_id', __('Choisis ta question de sécurité'), ['class' => 'label']); ?>
    <?= $this->Form->control('question_id', [
        'label' => false,
        'templateVars' => [
            'help'      => __('Choisis une question à laquelle tu seras capable de répondre si ton compte est verrouillé.'),
            'icon'      => 'shield',
            'has_icon'  => 'has-icons-left'
        ]
    ]); ?>

    <?= $this->Form->label('answer', __('Réponse à la question de sécurité'), ['class' => 'label']); ?>
    <?= $this->Form->control('answer', [
        'label' => false,
        'templateVars' => [
            'help'         => __('Ta réponse doit être personnelle et personne d\'autre que toi devra la connaître.'),
            'icon'         => 'pencil',
            'has_icon'     => 'has-icons-left'
        ]
    ]); ?>

    <div class="field is-grouped">
        <span class="control">
            <?= $this->Form->submit(__('Sécuriser mon compte'), ['class' => 'button is-success']); ?>
        </span>
        <span class="control">
            <?= $this->Html->link(
                __('Poursuivre sans sécuriser mon compte'),
                ['controller' => 'Avatars', 'action' => 'index'],
                ['class' => 'button is-light']
            ); ?>
        </span>
    </div>
    <?= $this->Form->end(); ?>
</div>
