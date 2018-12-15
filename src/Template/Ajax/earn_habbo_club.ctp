<div class="modal-header">
	<?= __('Gagne un abonnement de 2H'); ?>
	<span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
</div>
<div class="modal-body">
	<div class="habbo-header">
		<h1><?= __("Hey"); ?> <?= $player->username; ?>!</h1>
	</div>
	<div class="habbo-content">
		<div class="notification" style="display: none"></div>
		<p><?= __("Tu souhaites profiter des fonctionnalités HC pendant deux heures gratuitement ? Tu es tombé sur la bonne page."); ?></p>
		<p><?= __("Il ne te reste plus qu'à partager une publication sur Facebook en cliquant sur \"Gagner mon abonnement HC\" et ton abonnement sera activé."); ?></p>
		<div class="habbo-avatar">
			<?= $this->Html->image('habboclub/3.png'); ?>
			<img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= $player->figure; ?>&gesture=sml&action=&direction=3&head_direction=3" style="position: absolute;margin-top: 40px;margin-left: 25px;">
		</div>
		<div class="habbo-button">
			<button class="btn share" type="submit"><?= __("Gagner mon abonnement"); ?></button>
		</div>
	</div>
</div>
<div class="modal-footer">
</div>