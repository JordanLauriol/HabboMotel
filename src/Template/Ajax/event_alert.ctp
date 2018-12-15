<div class="modal-header">
	<?= __('Message des Staffs'); ?>
	<span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
</div>
<div class="modal-body">
	<div class="header" style="background-image: url('https://flash.habbomotel.in/c_images/alertpics/<?= $message["event"]["header"]; ?>.png'); width: 100%; height: 100px; background-repeat: no-repeat; background-size:cover;">
	</div>
	<p style="padding: 10px 10px 0px 10px;word-wrap: break-word;font-size: 13.5px;">
		<?= $message["event"]["message"]; ?>
	</p>

	<div style="display: block; float: right; padding: 0px 15px 10px 0px;">
	<?php if($message["event"]["canFollow"] == "true") { ?>
		<button id="follow" class="btn-green"><?= __("J'y vais !"); ?></button>
	<?php } ?>
	</div>
</div>
<div class="modal-footer">
</div>