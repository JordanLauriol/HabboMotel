<div class="modal-header">
    <?= __('Promouvoir son appart'); ?>
    <span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
</div>
<div class="modal-body">
    <div id="message">
        <div class="notification" style="display: none;margin-bottom: 20px;"></div>
    </div>
    <?= $this->Html->image("promote.png", ['align' => 'right']); ?>
    
    <div class="promote">
        <p class="title is-6 is-spaced"><?= __("Promouvoir son appart !"); ?></p>
        <p class="subtitle is-6"><?= __("Ton appart est peu visité ? Achète de la visibilité et reçois plusieurs personnes chez toi... en même pas quelques secondes grâce à nos sélections de notifications déjà prêtes."); ?></p>

        <div class="price">
            <span class="txt"><?= __("Prix"); ?></span>
            <span class="diamonds">10 <?= $this->Html->image('icons/diamonds.png', ['style' => 'position: absolute; margin-top: 12px;margin-left:5px;']); ?></span>
        </div>
    </div>
    <br/>
    <?= $this->Form->create(null, ['id' => 'form-promote-room']); ?>
    <?= $this->Form->label('name', __('Choisi ton type d\'invitation'), ['class' => 'label']); ?>
    <?= $this->Form->select('name', $promotions, ['id' => 'name']); ?>
    <div class="field is-grouped is-grouped-centered">
        <?= $this->Form->submit("Inviter", ["class" => "btn-buy"]); ?>
    </div>
    <?= $this->Form->end(); ?>
</div>
</div>
<div class="modal-footer">
</div>