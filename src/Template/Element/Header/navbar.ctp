<nav class="navbar has-shadow is-transparent">
    <div class="container">
        <div class="navbar-brand">
            <button class="button navbar-burger" data-target="navbar-menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="navbar-menu" id="navbar-menu">
            <div class="navbar-start">
                <?php if($this->request->controller == "Notifications" || $this->request->controller == "Avatars") { ?>
                    <?= $this->Html->link(__('Personnage'), [
                            'controller' => 'Avatars',
                            'action'     => 'index'
                        ], [
                            'class'      => (($this->request->controller == "Avatars" && $this->request->action == "index")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>

                    <div class="navbar-item has-dropdown is-hoverable">
                         <?= $this->Html->link(__('Paramètres du compte'), [
                            'controller' => 'Avatars',
                            'action'     => 'privacy'
                            ], [
                                'class'      => (($this->request->controller == "Avatars" && $this->request->action != "index")
                                                    ? "navbar-link is-active"
                                                    : "navbar-link")
                            ]);
                        ?>
                        <div class="navbar-dropdown is-boxed">
                            <a class="navbar-item <?php if($this->request->controller == "Avatars" && $this->request->action == "privacy") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'privacy']); ?>">
                                <?= __('Modifications générales'); ?>
                            </a>
                            <a class="navbar-item <?php if($this->request->controller == "Avatars" && $this->request->action == "password") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'password']); ?>">
                                <?= __('Changement de mot de passe'); ?>
                            </a>
                            <a class="navbar-item <?php if($this->request->controller == "Avatars" && $this->request->action == "security") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'security']); ?>">
                                <?= __('Protection du compte'); ?>
                            </a>
                            <a class="navbar-item <?php if($this->request->controller == "Avatars" && $this->request->action == "history") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'history']); ?>">
                                <?= __('Historique de connexions'); ?>
                            </a>
                            <a class="navbar-item <?php if($this->request->controller == "Avatars" && $this->request->action == "network") { echo "is-active"; } ?>" href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'network']); ?>">
                                <?= __('Gestion du profil social'); ?>
                            </a>
                        </div>
                    </div>
                    <a class="navbar-item is-link trophies"><?= __('Trophées'); ?></a>

                    <?= $this->Html->link(__('Notifications'), [
                            'controller' => 'Notifications',
                            'action'     => 'history'
                        ], [
                            'class'      => (($this->request->controller == "Notifications" && $this->request->action == "history")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>
                <?php } ?>

                <?php if($this->request->controller == "Community" || $this->request->controller == "Articles") { ?>
                    <?= $this->Html->link(__('Actualités'), [
                            'controller' => 'Articles',
                            'action'     => 'index'
                        ], [
                            'class'      => (($this->request->controller == "Articles")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>

                    <?= $this->Html->link(__('Staffs'), [
                            'controller' => 'Community',
                            'action'     => 'staff'
                        ], [
                            'class'      => (($this->request->controller == "Community" && $this->request->action == "staff")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>

                    <?= $this->Html->link(__('Architectes'), [
                            'controller' => 'Community',
                            'action'     => 'architect'
                        ], [
                            'class'      => (($this->request->controller == "Community" && $this->request->action == "architect")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>
                <?php } ?>

                <?php if($this->request->controller == "Prizes") { ?>
                    <?= $this->Html->link(__('Par animations'), [
                            'controller' => 'Prizes',
                            'action'     => 'events'
                        ], [
                            'class'      => (($this->request->controller == "Prizes" && $this->request->action == "events")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>

                    <?= $this->Html->link(__('Par fortune'), [
                            'controller' => 'Prizes',
                            'action'     => 'wealth'
                        ], [
                            'class'      => (($this->request->controller == "Prizes" && $this->request->action == "wealth")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>
                <?php } ?>

                <?php if($this->request->controller == "Forum") { ?>
                    <?= $this->Html->link(__('Forum de discussion'), [
                            'controller' => 'Forum',
                            'action'     => 'index'
                        ], [
                            'class'      => (($this->request->controller == "Forum" && $this->request->action == "index")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>
                <?php } ?>


                <?php if($this->request->controller == "Shop") { ?>
                    <?= $this->Html->link(__('Comprendre notre économie'), [
                            'controller' => 'Shop',
                            'action'     => 'index'
                        ], [
                            'class'      => (($this->request->controller == "Shop" && $this->request->action == "index")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>

                    <?php if($locale == "fr_FR") { ?>
                        <?= $this->Html->link(__('Acheter des diamants'), [
                                'controller' => 'Shop',
                                'action'     => 'diamonds'
                            ], [
                                'class'      => (($this->request->controller == "Shop" && $this->request->action == "diamonds")
                                                    ? "navbar-item is-link is-active"
                                                    : "navbar-item is-link")
                            ]);
                        ?>
                    <?php } ?>
                    <?= $this->Html->link(__('Historique des transactions'), [
                            'controller' => 'Shop',
                            'action'     => 'transactions'
                        ], [
                            'class'      => (($this->request->controller == "Shop" && $this->request->action == "transactions")
                                                ? "navbar-item is-link is-active"
                                                : "navbar-item is-link")
                        ]);
                    ?>
                <?php } ?>
            </div>

            <?php
            // Large navbar
            if($this->request->controller != "Shop") {
            ?>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="field is-grouped">
                        <?php if($this->request->session()->check('Auth.User.id')) { ?>
                        <p class="control">
                            <a class="button is-success" target="_blank" href="<?= $this->Url->build(['controller' => 'Community', 'action' => 'client']); ?>">
                                <span class="icon">
                                    <i class="fa fa-sign-in"></i>
                                </span>
                                <span><?= __('Entrer dans l\'hôtel'); ?></span>
                            </a>
                        </p>
                        <p class="control">
                            <a class="button is-light" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']); ?>">
                                <span class="icon">
                                    <i class="fa fa-sign-out"></i>
                                </span>
                                <span><?= __('Se déconnecter'); ?></span>
                            </a>
                        </p>
                        <?php } else { ?>
                        <p class="control">
                            <a class="button is-success" href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']); ?>">
                                <span class="icon">
                                    <i class="fa fa-sign-in"></i>
                                </span>
                                <span><?= __('Rejoins-nous'); ?></span>
                            </a>
                        </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</nav>
