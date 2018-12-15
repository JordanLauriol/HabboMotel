<style>
#advantagesHabboClub .modal-body .habbo-content h1 {
	font-size: 15px;
	color: #e67e22;
	font-weight: bold;
	padding: 10px 0 10px 0;
}

#advantagesHabboClub .modal-body .habbo-content ul {
	padding: 0px 10px 10px 10px;
}

#advantagesHabboClub .modal-body .habbo-content li {
	margin: 0;
	font-size: 13px;
}
</style>
<div class="modal-header">
    <?= __('Les avantages du HabboCLUB'); ?>
    <span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
</div>
<div class="modal-body">
	<div class="header"></div>
	<div class="habbo-content">
		<?= $this->Html->image('habboclub/badges.png', ['align' => 'right']); ?>

		<h1><?= __("Quels sont les avantages de l’abonnement HC ?"); ?></h1>
		<ul>
			<li><?= __("- Badge HC"); ?></li>
			<li><?= __("- Texte de tchats en couleur"); ?></li>
			<li><?= __("- 5 respects supplémentaires par jour"); ?></li>
			<li><?= __("- 3 cajoles supplémentaires par jour"); ?></li>
			<li><?= __("- 500 win-win offerts"); ?></li>
			<li><?= __("- Catalogue dédie aux membres HC"); ?></li>
			<li><?= __("- Accès aux outils HC <i>(promouvoir son appart/définir les règles de son appart)</i>"); ?></li>
			<li><?= __("- Coupes de cheveux et vêtements exclusifs <i>(bientôt disponible)</i>"); ?></li>
			<li><?= __("- Cadeau HC mensuel"); ?></li>
			<li><?= __("- Liste d’amis doublée (jusqu’à 1500)"); ?></li>
			<li><?= __("- Des commandes spéciales telles que <span class=\"tag is-light\">:warp</span> <i>(téléporter les joueurs vers soi)</i>, <span class=\"tag is-light\">:enable</span> <i>(ajouter un effet à son avatar)</i>, <span class=\"tag is-light\">:teleport</span> <i>(se téléporter dans ses appart)</i> et bien plus à l’aide de <span class=\"tag is-light\">:commands</span> <i>(voir toutes les commandes disponibles)</i>"); ?></li>
		</ul>

		<h1><?= __("Qu’est-ce le HC ?"); ?></h1>
		<p>
			<?= __("L’abonnement HC est un club spécial que les joueurs normaux peuvent rejoindre pour obtenir des fonctionnalités supplémentaires que les joueurs normaux. "); ?>
		</p><br/>
		<p>
			<?= __("Combien cela coûte de faire partie du HC ? Être membre du HC coûte 50 diamants pour un abonnement de 31 jours et 31 diamants pour un abonnement de 14 jours."); ?>
		</p>

		<h1><?= __("Comment je sais depuis combien de temps je suis HC et combien de jours il me reste en tant que HC ?"); ?></h1>	
		<p>
			<?= __("Quand tu es connecté au Motel, cette information est disponible sur le haut de ton écran à droite. En cliquant sur cette icône HC tu ouvriras le Centre HC. Comment fonctionne le Cadeau Mensuel ? En fonction de ta période HC, tu recevras, tous les mois, un cadeau surprise."); ?>
		</p>
		<br/>
		<p>
			<?= __("Ce cadeau mensuel surprise peut inclure des diamants, un renouvellement d’abonnement HC, un rare, un badge et bien plus encore!"); ?>
		</p>

		<h1><?= __("Je ne veux plus être HC, puis-je annuler mon inscription ?"); ?></h1>
		<p><?= __("L’inscription au HC est d’un mois complet ou deux semaines, c’est pourquoi nous ne pourrons pas te rendre les diamants si tu décides de ne plus faire partie de ce Club avant la fin du mois correspondant à ton inscription."); ?>
		</p>
	</div>
</div>
<div class="modal-footer">
</div>