<style>
#habboClubCenter .modal-body .btn-green {
	background:linear-gradient(#019002 45%, #008100 45%);
	box-shadow:0 0 0 3px #008100 inset;
    border:2px solid #000;
    border-radius:5px;
    outline:none;
    cursor:pointer;
    text-align:left;
    width:auto;
    padding: 5px;
    color:#FFF;
    font-weight:bold;
    font-size:13px;
    margin: -30px 0px 0px 0px;
    float: right;
}

#habboClubCenter .modal-body .btn-green:hover {
	background:linear-gradient(#0aa50b 45%, #0c900a 45%);
	box-shadow:0 0 0 3px #0c900a inset;
}

</style>
<div class="modal-header">
    <?= __('Centre HC'); ?>
    <span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
</div>
<div class="modal-body">
	    <div class="header"></div>
		<div class="subheader">
			<div class="buttons">
				<a href="<?= $this->Url->build(["controller" => "Shop", "action" => "diamonds"]); ?>" target="_blank"><button class="btn-blue"><?= __("Acheter des diamants"); ?> <img src="/img/icons/diamond.png"></button></a><br/>
				<button class="btn-red earnHabboClub"><?= __("Gagne 2H de HC"); ?> <img src="/img/habboclub/play.png"></button>
			</div>
			<div class="user">
				<img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= $player->figure; ?>&gesture=sml&action=&direction=4&head_direction=4&size=l">
			</div>
		</div>
		<div class="modal-container">
			<div class="advantages">
				<?= $this->Html->image('habboclub/advantages.png'); ?>
				<h3><?= __("Plus d'avantages HC :"); ?></h3>
				<p><?= __("- Catalogue dédié aux membres."); ?></p>
				<p><?= __("- Accès aux nouvelles fonctionnalités HC."); ?></p>
				<span class="advMore"><?= __("Découvrir tous les avantages..."); ?></span>
			</div>
			<div class="gifts">
				<h3><?= _("Cadeau mensuel HC"); ?></h3>
				<p><?= __("Les membres HC reçoivent un cadeau chaque mois !"); ?></p>
			</div>
			<div class="notification" style="display: none"></div>
			<div class="title-subscribe">
				<div class="title-price"><?= $this->Html->image("habboclub/hc5.png"); ?><?= __("14 jours"); ?></div>
				<p class="price">30 <?= $this->Html->image('icons/diamond.png', ['class' => 'diamond']); ?></p>
				<button class="btn-green subscribe" data-period="14"><?= __("Souscrire durant 14 jours"); ?></button>
			</div>
			<div class="title-subscribe">
				<div class="title-price"><?= $this->Html->image("habboclub/hc5.png"); ?><?= __("31 jours"); ?></div>
				<p class="price">50 <?= $this->Html->image('icons/diamond.png', ['class' => 'diamond']); ?></p>
				<button class="btn-green subscribe" data-period="31"><?= __("Souscrire durant 31 jours"); ?></button>
			</div>
			<div class="hc">
				<?= $this->Html->image('habboclub/hc4.png'); ?>
			</div>
		</div>
</div>
<div class="modal-footer">
</div>