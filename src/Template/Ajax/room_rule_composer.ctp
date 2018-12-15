<div class="modal-header">
    <?= __('Règles de ton appart'); ?>
    <span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
</div>
<div class="modal-body">
    <div id="message">
        <div class="notification" style="display: none;margin-bottom: 20px;"></div>
    </div>
    <?= $this->Html->image('pencil.gif', ['align' => 'right']); ?>
    <p><?= __("Cet outil est mis à votre disposition dans le but de vous permettre de préparer les règles de vos animations en avance, merci d'éviter d'utiliser cet outil pour des utilisations privées. Les historiques sont sauvegardés.<br/>Afin de rendre vos règles plus attractives, vous pouvez vous rendre sur le site CKEditor en cliquant <a href=\"http://nightly.ckeditor.com/18-03-16-07-04/full/samples/index.html\" target=\"_blank\">ICI</a>. (préparez vos règles - cliquez sur SOURCE et copier/coller)."); ?>
    </p>
    <br/>
    <?= $this->Form->create($room, ['id' => 'form-rules']); ?>
    <?= $this->Form->label('rules', __('Règles de ton appart'), ['class' => 'label']); ?>
    <?= $this->Form->control('rules', [
        'label' => false,
        'placeholder' => __(''),
        'class' => 'textarea'
        ]); 
    ?>
    <div class="field is-grouped is-grouped-centered">
    <p class="control">
        <?= $this->Form->submit(__('Définir les règles'), ['class' => 'button is-link']); ?>
    </p>
</div>
    <?= $this->Form->end(); ?>
</div>
<div class="modal-footer">
</div>