<div class="modal-header">
	<?= __('Les règles...'); ?>
	<span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
</div>
<div class="modal-body">
	<?= nl2br(str_replace("<a", "##", $room->rules)); ?>
</div>
<div class="modal-footer">
</div>
