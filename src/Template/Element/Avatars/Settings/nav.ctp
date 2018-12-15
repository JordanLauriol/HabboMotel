<div class="column is-4">
    <nav class="panel">
        <p class="panel-heading">
            <?= __('Paramètres du compte'); ?>
        </p>

        <a class="panel-block <?php if($this->request->action == "privacy") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'privacy']); ?>">
            <span class="panel-icon">
                <i class="fa fa-user-secret"></i>
            </span>
            <?= __('Modifications générales'); ?>
        </a>
        <a class="panel-block <?php if($this->request->action == "password") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'password']); ?>">
            <span class="panel-icon">
                <i class="fa fa-lock"></i>
            </span>
            <?= __('Changement de mot de passe'); ?>
        </a>
        <a class="panel-block <?php if($this->request->action == "security") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'security']); ?>">
            <span class="panel-icon">
                <i class="fa fa-shield"></i>
            </span>
            <?= __('Protection du compte'); ?>
        </a>
        <a class="panel-block <?php if($this->request->action == "history") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'history']); ?>">
            <span class="panel-icon">
                <i class="fa fa-history"></i>
            </span>
            <?= __('Historique de connexions'); ?>
        </a>
        <a class="panel-block <?php if($this->request->action == "network") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'network']); ?>">
            <span class="panel-icon">
                <i class="fa fa-camera-retro"></i>
            </span>
            <?= __('Gestion du profil social'); ?>
        </a>
    </nav>
</div>
