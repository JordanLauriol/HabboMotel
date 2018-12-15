<?php if(is_null($poll)) { ?>
    <div class="notification is-warning" style="margin-bottom: 20px;">
        <?= __('Aucun sondage n\'est en cours dans ton appart.'); ?>
    </div>
<?php } else { ?>
    <div id="message">
        <div class="notification" style="display: none;margin-bottom: 20px;"></div>
    </div>

    <?= $this->Html->image('ivoted.gif', ['align' => 'right']); ?>
    <?= __('Tu as récemment lancé un sondage <small>&laquo; {0} &raquo;</small> pour les Habbos qui visitent ton appart.', $poll->question); ?><br/>
    <br/>
    <?= $this->Form->create(null, ['url' => ['controller' => 'Ajax', 'action' => 'inProgressPoll'], 'id' => 'form-inProgressPoll']); ?>
    <div class="field">
        <?= $this->Form->checkbox('enabled', ['id' => 'enabled', 'checked' => 'checked', 'class' => 'switch is-success is-rtl', 'hiddenField' => false]); ?>
        <?= $this->Form->label('enabled', 'Souhaites-tu l\'arrêter?'); ?>
    </div>
    <?= $this->Form->end(); ?>
    <br/>
<?php } ?>
