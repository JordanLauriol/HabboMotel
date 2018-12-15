<div class="columns">
    <?= $this->element('Avatars/Settings/nav'); ?>

    <div class="column">
        <div class="box">
            <div class="box-title is-dark has-text-centered is-uppercase"><?= __('Gestion du profil social'); ?></div>
            <div class="content">
                <?php if(is_null($network)) { ?>
                    <p>
                        <?= __("À partir de cette page, il est possible de procéder à la création d'un profil social directement disponible depuis l'hôtel. Une fois la création effectuée, il sera possible d'ajouter plusieurs données relatives à ta personne comme tes différents réseaux sociaux mais aussi d'ajouter une photo de profil. Ce profil peut être visible auprès de tous les joueurs ou alors, à l'inverse, il peut être invisible et dans ce cas, aucun d'entre eux ne pourra le voir. De plus, les informations partagées sur ton profil social seront soumises à la vérification des modérateurs de HabboMotel afin de contrôler le contenu partagé depuis cette page."); ?>
                    </p>
                    <p>
                        <?= __("Il est important de souligner que la publication de telles données sur l'hôtel nécessite un consentement clair de ta part."); ?>
                    </p>

                    <?= $this->Form->create(); ?>
                    <?= $this->Form->hidden('state', ['value' => 'enabled']); ?>
                    <?= $this->Form->submit('Créer ton profil social', ['class' => 'button is-success']); ?>
                    <?= $this->Form->end(); ?>
                <?php } else { ?>

                    <img src="<?= empty($network->picture) ? $this->request->webroot . 'img/uploads/avatar_defaut.png' : $this->request->webroot . $network->picture; ?>" align="right" style="width: 100px; height: 100px;">

                    <?= $this->Form->create($network, ['enctype' => 'multipart/form-data']); ?>
                    <?= $this->Form->label('picture', __('Photo de profil'), ['class' => 'label']); ?>
                    <?= $this->Form->control('picture', [
                        'label' => false,
                        'type'  => 'file',
                        'templateVars' => [
                            'help'     => __('Choisis une photo de profil que tu partageras avec les Habbos. <b>Taille maximale 2MO</b>'),
                            'has_icon' => '',
                            'icon'     => '',
                            'display_icon' => 'none',
                        ]]); 
                    ?>
                    
                    <?= $this->Form->label('snapchat', __('Snapchat'), ['class' => 'label']); ?>
                    <?= $this->Form->control('snapchat', [
                        'label' => false,
                        'templateVars' => [
                            'help'     => __('Saisis ton nom d\'utilisateur sur snapchat pour le partager aux Habbos.'),
                            'has_icon' => 'has-icons-left',
                            'icon'     => 'snapchat-ghost'
                        ]]); 
                    ?>

                    <?= $this->Form->label('instagram', __('Instagram'), ['class' => 'label']); ?>
                    <?= $this->Form->control('instagram', [
                        'label' => false,
                        'templateVars' => [
                            'help'     => __('Saisis ton nom d\'utilisateur sur instagram pour le partager aux Habbos.'),
                            'has_icon' => 'has-icons-left',
                            'icon'     => 'instagram'
                        ]]); 
                    ?>

                    <?= $this->Form->label('twitter', __('Twitter'), ['class' => 'label']); ?>
                    <?= $this->Form->control('twitter', [
                        'label' => false,
                        'templateVars' => [
                            'help'     => __('Saisis ton nom d\'utilisateur sur twitter pour le partager aux Habbos.'),
                            'has_icon' => 'has-icons-left',
                            'icon'     => 'twitter'
                        ]]); 
                    ?>
                    <div class="field is-grouped">
                        <div class="control">
                            <?= $this->Form->submit('Modifier mon profil social', ['class' => 'button is-success']); ?>
                        </div>
                        <?= $this->Form->end(); ?>

                        <?= $this->Form->create(); ?>
                        <?= $this->Form->hidden('state', ['value' => 'disabled']); ?>
                        <div class="control">
                            <?= $this->Form->submit('Supprimer mon profil social', ['class' => 'button is-danger']); ?>
                        </div>
                        <?= $this->Form->end(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>