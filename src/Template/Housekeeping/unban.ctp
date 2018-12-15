<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column">
				<?= $this->Flash->render(); ?>
				<div class="box">
					<p class="title is-6"><?= __("Débannir un Habbo"); ?></p>
					<p class="subtitle is-6"><?= __("Les actions que vous réalisez dans l'administration sont sauvegardées et consultable par la haute administration."); ?></p>

					<?= $this->Form->create(); ?>
					<?= $this->Form->label("username", __("Pseudonyme du Habbo"), ['class' => "label"]); ?>
					<?= $this->Form->control("username", [
						"label" => false,
						'templateVars' => [
				            'help'      => __("Tous les types d'exclusions vont être supprimés (utilisateur, adresse ip et machine)"),
				            'icon'      => 'user',
				            'has_icon'  => 'has-icons-left'
				        ]
						]); ?>
					<?= $this->Form->submit(__("Débannir le Habbo"), [
						'class' => 'button is-success']
						); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</section>