<div class="columns">
    <?= $this->element('Avatars/Settings/nav'); ?>

    <div class="column">
        <div class="box">
            <div class="box-title is-dark has-text-centered is-uppercase"><?= __('Changement de mot de passe'); ?></div>
            <div class="content">
                <p>
                    <?= __("Tu peux modifier le mot de passe de ton compte à tout moment en complétant le formulaire ci-dessous."); ?>
                </p>

                <?= $this->Form->create($user); ?>
                <div class="field">
                    <?= $this->Form->label('password', __('Nouveau mot de passe'), ['class' => 'label']); ?>
                    <?=
                    $this->Form->control('password', [
                        'label' => false,
                        'type'  => 'password',
                        'value' => '',
                        'templateVars' => [
                            'help'     => __('Ton mot de passe doit comprendre au moins 6 caractères et inclure des lettres et des chiffres.'),
                            'has_icon' => 'has-icons-left',
                            'icon'     => 'lock'
                        ]]);
                    ?>
                </div>

                <div class="field">
                    <?= $this->Form->label('repassword', __('Confirme ton nouveau mot de passe'), ['class' => 'label']); ?>
                    <?=
                    $this->Form->control('repassword', [
                        'label' => false,
                        'type'  => 'password',
                        'templateVars' => [
                            'help'     => __('Saisi à nouveau ton mot de passe pour être sûr de son ortographe.'),
                            'has_icon' => 'has-icons-left',
                            'icon'     => 'lock'
                        ]]);
                    ?>
                </div>

                <div class="field">
                    <?= $this->Form->submit(__('Modifier mon mot de passe'), ['class' => 'button is-success']); ?>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
