<div class="columns">
    <?= $this->element('Avatars/Settings/nav'); ?>

    <div class="column">
        <div class="box">
            <div class="box-title is-dark has-text-centered is-uppercase"><?= __('Protection du compte'); ?></div>
            <div class="content">
                <?php if(is_null($security)) { ?>
                
                <p>
                    <?= __("La protection de compte protège votre compte de toutes sortes de piratages. La question de sécurité s’active automatiquement dès qu’une personne n’utilisant pas votre adresse IP tente de se connecter sur votre compte. Si le pirate ne parvient pas à répondre correctement aux questions de sécurité, le compte sera désactivé par mesure de sécurité."); ?>
                </p>
                <p>
                    <?= __("Ces mesures de sécurité sont d'autant plus importantes que ton mot de passe. Attention à ne pas renseigner de fausses informations."); ?>
                </p>
                <?= $this->Html->link(__('Proteger mon compte'), [
                    'controller' => 'Users',
                    'action'     => 'security'
                ], [
                    'class' => 'button is-success'
                    ]); ?>
                    <?php } else { ?>
                    <p><?= __("La protection du compte est <b>activé</b>, tu peux modifier le formulaire ci-dessous pour changer la question de sécurité."); ?></p>
                    <?= $this->Form->create($security); ?>
                    <?= $this->Form->hidden('user_id', [
                        'value' => $this->request->session()->read('Auth.User.id')
                        ]); ?>
                        <?= $this->Form->label('question_id', __('Choisis ta nouvelle question de sécurité'), ['class' => 'label']); ?>
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
                                    <div class="control">
                                        <?= $this->Form->submit(__('Modifier ma question de sécurité'), ['class' => 'button is-success']); ?>
                                        <?= $this->Form->end(); ?>
                                    </div>

                                    <div class="control">
                                        <?= $this->Form->create(); ?>
                                        <?= $this->Form->submit(__('Désactiver la protection'), ['class' => 'button is-danger']); ?>
                                        <?= $this->Form->end(); ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
