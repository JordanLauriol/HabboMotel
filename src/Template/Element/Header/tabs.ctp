<div class="hero-foot">
    <div class="container">
        <nav class="tabs is-boxed">
            <ul>
                <?php
                if($locale == "pt_PT") { ?>
                <style>
                /*.hero.is-dark .tabs.is-boxed li a {
                    color: #FFF !important;
                }
                .hero.is-dark .tabs.is-boxed li.is-active a {
                    color: #363636 !important;
                    border: none !important;
                }*/
                </style>
                <?php } ?>

                <?php
                if($this->request->session()->check('Auth.User.id')) {
                    if($this->request->controller == "Notifications" || $this->request->controller == "Avatars") { ?>
                        <li class="is-dark is-active"><a><?= $this->Html->image('icons/user.png'); ?><?= $this->request->session()->read('Auth.User.username'); ?></a></li>
                    <?php } else { ?>
                        <li class="is-dark"><a href="<?= $this->Url->build(['controller' => 'Avatars', 'action' => 'index']); ?>"><?= $this->Html->image('icons/user.png'); ?><?= $this->request->session()->read('Auth.User.username'); ?></a></li>
                    <?php }
                } ?>

                <?php
                if($this->request->controller == "Community" || $this->request->controller == "Articles") { ?>
                    <li class="is-dark is-active"><a><?= $this->Html->image('icons/community.png'); ?><?= __('Communauté'); ?></a></li>
                <?php } else { ?>
                    <li class="is-dark"><a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'index']); ?>"><?= $this->Html->image('icons/community.png'); ?><?= __('Communauté'); ?></a></li>
                <?php } ?>

                <?php
                if($this->request->controller == "Prizes") { ?>
                    <li class="is-dark is-active"><a><?= $this->Html->image('icons/palmares.png'); ?><?= __('Palmarès'); ?></a></li>
                <?php } else { ?>
                    <li class="is-dark"><a href="<?= $this->Url->build(['controller' => 'Prizes', 'action' => 'events']); ?>"><?= $this->Html->image('icons/palmares.png'); ?><?= __('Palmarès'); ?></a></li>
                <?php } ?>

                <?php
                if($this->request->controller == "Forum") { ?>
                    <li class="is-dark is-active"><a><?= $this->Html->image('icons/rules.png'); ?><?= __('Forum'); ?></a></li>
                <?php } else { ?>
                    <li class="is-dark"><a href="<?= $this->Url->build(['controller' => 'Forum', 'action' => 'index']); ?>"><?= $this->Html->image('icons/rules.png'); ?><?= __('Forum'); ?></a></li>
                <?php } ?>

                <?php
                if($this->request->controller == "Shop") { ?>
                    <li class="is-dark is-active"><a><?= $this->Html->image('icons/shop.png'); ?><?= __('Boutique'); ?></a></li>
                <?php } else { ?>
                    <li class="is-dark"><a href="<?= $this->Url->build(['controller' => 'Shop', 'action' => 'index']); ?>"><?= $this->Html->image('icons/shop.png'); ?><?= __('Boutique'); ?></a></li>
                <?php } ?>

                <?php if($this->request->session()->check('Auth.User.id') && $this->request->session()->read('Auth.User.rank') >= 5) { ?>
                    <li class="is-dark"><a href="<?= $this->Url->build(['controller' => 'Housekeeping', 'action' => 'index']); ?>" target="_blank"><?= $this->Html->image('icons/support.png'); ?><?= __('Admin.'); ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
