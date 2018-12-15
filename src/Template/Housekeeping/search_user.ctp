<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column is-4">
				<?= $this->Flash->render(); ?>
				<div class="box">
					<p class="title is-6"><?= __("Rechercher un Habbo"); ?></p>
					<p class="subtitle is-6"><?= __("Les actions que vous réalisez dans l'administration sont sauvegardées et consultable par la haute administration."); ?></p>

					<?= $this->Form->create(); ?>
					<?= $this->Form->label("searchUsername", __('Pseudonyme du Habbo'), ['class' => 'label']); ?>
					<?= $this->Form->control('searchUsername', [
						'label' => false,
						'templateVars' => [
							'help' => null,
							'icon' => 'user',
							'has_icon' => 'has-icons-left'
						]
					]); 
					?>
					<?= $this->Form->submit(__("Rechercher cet Habbo"), ['class' => 'button is-success']); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>

			<div class="column">
				<div class="notification is-warning">
					<p class="title is-6"><?= __("Détails du Habbo"); ?></p>
					<p class="subtitle is-6"><?= __("Information générale du Habbo"); ?></p>

					<?php if(isset($player)) { ?>
					<?= $this->Form->create($player); ?>
					<?= $this->Form->hidden('id'); ?>
					<?= $this->Form->hidden('password'); ?>

					<?= $this->Form->label("username", __("Pseudonyme"), ['class' => 'label']); ?>
					<?= $this->Form->control('username', [
						'disabled' => 'disabled',
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
						]); ?>

					<?= $this->Form->label("motto", __("Mission"), ['class' => 'label']); ?>
					<?= $this->Form->control('motto', [
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->label("credits", __("Crédits"), ['class' => 'label']); ?>
					<?= $this->Form->control('credits', [
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->label("activity_points", __("Duckets"), ['class' => 'label']); ?>
					<?= $this->Form->control('activity_points', [
						'label' => false,
						'templateVars' => [
						'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->label("vip_points", __("Diamants"), ['class' => 'label']); ?>
					<?= $this->Form->control('vip_points', [
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->label("rank", __("Rang"), ['class' => 'label']); ?>
					<?= $this->Form->control('rank', [
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->label("responsability", __("Responsabilité"), ['class' => 'label']); ?>
					<?= $this->Form->control('responsability', [
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->label("vip", __("VIP"), ['class' => 'label']); ?>
					<?= $this->Form->control('vip', [
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->label("disabled", __("Désactiver le compte"), ['class' => 'label']); ?>
					<?= $this->Form->control('disabled', [
						'label' => false,
						'templateVars' => [
							'display_icon' => 'none'
						]
					]); ?>

					<?= $this->Form->submit(__("Valider les changements"), ["class" => "button is-success"]); ?>
					<?= $this->Form->end(); ?>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>