<div class="column is-full" style="padding: 0">
    <?php if($lang != "fr" && $lang != "pt") { ?>
    <div class="notification is-warning">
      <button class="delete"></button>
      Il semblerait que nous n'avons pas reconnu ta langue, souhaites-tu te rendre sur le site <?= $this->Html->image('icons/fr.png'); ?> <?= $this->Html->link('français', ['controller' => 'Home', 'action' => 'language', 'lang' => 'fr']); ?> ou <?= $this->Html->image('icons/br.png'); ?> <?= $this->Html->link('portugais', ['controller' => 'Home', 'action' => 'language', 'lang' => 'pt']); ?> ?
      <br/>
      Parece que nós não encontramos o seu idioma, deseja entrar no site <?= $this->Html->image('icons/fr.png'); ?> <?= $this->Html->link('francês', ['controller' => 'Home', 'action' => 'language', 'lang' => 'fr']); ?> ou <?= $this->Html->image('icons/br.png'); ?> <?= $this->Html->link('português', ['controller' => 'Home', 'action' => 'language', 'lang' => 'pt']); ?> ?
    </div>
    <?php } ?>
    <div class="slideshow-container">
        <nav class="navbar is-transparent topheader">
            <div class="navbar-brand">
                <div class="logo">
                    <?= $this->Html->image('habbomotel.gif', ['class' => 'animated zoomIn']); ?>
                </div>
                <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbarExampleTransparentExample" class="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item">
                        <?= $this->Form->create($player, ['url' => ['controller' => 'Users', 'action' => 'login'], 'class' => 'animated bounceInDown', 'style' => 'margin-top: 1.1rem;']); ?>
                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                      <?= $this->Form->control('username', [
                                        'label' => false,
                                        'placeholder' => __('Pseudonyme'),
                                        'templateVars' => [
                                            'icon'         => 'user',
                                            'has_icon'     => 'has-icons-left'
                                        ]
                                        ]); ?>
                                    </div>
                                    <div class="field">
                                      <?= $this->Form->control('password', [
                                        'label' => false,
                                        'placeholder' => __('Mot de passe'),
                                        'templateVars' => [
                                            'icon'         => 'unlock-alt',
                                            'has_icon'     => 'has-icons-left'
                                        ]
                                        ]); ?>
                                    </p>
                                </div>

                                <div class="field">
                                    <p class="control">
                                        <?= $this->Form->submit(__('Connexion'), ['class' => 'button is-warning is-uppercase']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </nav>

        <div class="mySlides fade" style="background-image:url('<?= $this->Url->image('homepage/winter/landing_user_page.png'); ?>');">
            <div class="filter"></div>
            <div class="container">
                <h1 class="title is-3 is-spaced is-uppercase"><?= __("EXPLORE UN HOTEL INSOLITE AVEC DES PERSONNES INCROYABLES"); ?></h1>

                <center>
                    <a href="#register" class="button is-success is-medium">
                        <span class="icon"><i class="fa fa-arrow-circle-o-down"></i></span>
                        <span><?= __("INSCRIS-TOI MAINTENANT !"); ?></span>
                    </a>
                </div>
            </div>

            <div class="mySlides fade" style="background-image:url('<?= $this->Url->image('homepage/valentin/lading_page.png'); ?>');">
                <div class="filter"></div>
                <div class="container">
                    <h1 class="title is-3 is-spaced is-uppercase"><?= __("Rencontre un tas de personnes extraordinaire sur HabboMotel"); ?></h1>

                </div>
            </div>

            <div class="mySlides fade" style="background-image:url('<?= $this->Url->image('homepage/winter/lading_page_3.png'); ?>');">
                <div class="filter"></div>
                <div class="container">
                    <h1 class="title is-3 is-spaced is-uppercase"><?= __("La communauté d'habbomotel s'agrandit de jour en jour, nous cherchons des nouveaux modérateurs"); ?></h1>
                    <p><a class="button is-medium is-link animated pulse infinite">
                        <span class="icon"><i class="fa fa-pencil-square-o"></i></span>
                        <span><?= __("Postuler"); ?></span>
                    </a></p>
                </div>
            </div>

            <a class="prev animated wobble infinite" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next animated wobble infinite" onclick="plusSlides(1)">&#10095;</a>

            <div class="dot-container">
                <span class="dot" onclick="currentSlide(1)"></span>
                <!--<span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>-->
            </div>
        </div>

        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="<?= $locale == "fr_FR" ? "column is-7" : "column is-8"; ?>" id="register">
                        <div class="content">
                            <h1 class="title is-4 is-uppercase" style="font-weight: bold;"><?= __("Inscris-toi maintenant !"); ?></h1>
                            <h2 class="subtitle is-5"><?= __("Fais-toi de nouveaux amis, crée ta chambre, adopte des animaux de compagnie, organise des grandes soirées! Amuse-toi gratuitement dès maintenant!"); ?></h2>

                            <?= $this->Form->create($player); ?>
                            <?= $this->Form->label('username', __('Pseudonyme de l\'avatar'), ['class' => 'label']); ?>
                            <?= $this->Form->control('username', [
                                'label' => false,
                                'templateVars' => [
                                    'help'         => __('Ton pseudonyme peut contenir seulement des majuscules, miniscules, nombres et tirets.'),
                                    'icon'         => 'user',
                                    'has_icon'     => 'has-icons-left'
                                ]
                            ]); ?>

                            <?= $this->Form->label('password', __('Mot de passe'), ['class' => 'label']); ?>
                            <?= $this->Form->control('password', [
                                'label' => false,
                                'templateVars' => [
                                    'help'         => __('Utilise au moins 6 caractères. Inclue au moins une lettre et au moins un chiffre ou un caractère spécial.'),
                                    'icon'         => 'unlock-alt',
                                    'has_icon'     => 'has-icons-left'
                                ]
                            ]); ?>

                            <?= $this->Form->label('repassword', __('Répeter le mot de passe'), ['class' => 'label']); ?>
                            <?= $this->Form->control('repassword', [
                                'label' => false,
                                'type'  => 'password',
                                'templateVars' => [
                                    'icon'         => 'unlock-alt',
                                    'has_icon'     => 'has-icons-left'
                                ]
                            ]); ?>

                            <?= $this->Form->label('email', __('Adresse e-mail'), ['class' => 'label']); ?>
                            <?= $this->Form->control('email', [
                                'label' => false,
                                'templateVars' => [
                                    'help'         => __('Ton adresse e-mail doit être valide en cas d\'oublis de mot de passe.'),
                                    'icon'         => 'envelope',
                                    'has_icon'     => 'has-icons-left'
                                ]
                            ]); ?>
                            <?= $this->Form->control('legal', [
                                'type'  => 'checkbox',
                                'escape' => false,
                                'label' => __('&nbsp; J\'accepte les <a href="#" target="_blank">conditions d\'utilisation</a>.'),
                                'templateVars' => [
                                    'display_icon' => 'none'
                                ]
                            ]); ?>
                            <div class="field">
                                <p class="control">
                                    <?= $this->Form->submit(__('Terminer mon inscription'), ['class' => 'button is-medium is-success']); ?>
                                </p>
                            </div>
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                                <div class="<?= $locale == "fr_FR" ? "column is-5" : "column is-4"; ?>">
                                    <div class="content">
                                        <?php
                                        if($locale == "fr_FR") { ?>
                                            <h1 class="title is-4 is-uppercase" style="font-weight: bold;"><?= __("Quelques raisons de s'inscrire sur HabboMotel.."); ?></h1>
                                            <h2 class="subtitle is-5"><?= __("Découvre encore plus de nouveautés en t'inscrivant !"); ?></h2>
                                             <video width="100%" height="100%" controls>
                                                  <source src="<?= $this->request->webroot; ?>videos/trailer-hd.mp4" type="video/mp4">
                                                <?= $this->Html->image('registration_background_step1.png'); ?>
                                            </video>
                                            <?php } else {
                                                echo $this->Html->image('registration_background_step1.png');
                                            } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
