<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column">
				<?= $this->Flash->render(); ?>
				<div class="box">
					<p class="title is-6"><?= __("Lancer une animation"); ?></p>
					<p class="subtitle is-6"><?= __("Les actions que vous réalisez dans l'administration sont sauvegardées et consultables par la haute administration."); ?></p>

					<?= $this->Form->create(); ?>
					<?= $this->Form->label('header', __('Image du header'), ['class' => 'label']); ?>
					<?= $this->Form->control('header', [
						'value' => 'arcades',
						'label' => false,
						'templateVars' => [
							'help' => __('Selectionner une image parmis ce dossier <a target="_blank" href="https://flash.habbomotel.in/c_images/alertpics/">en cliquant ici</a>'),
							'display_icon' => 'none'
						]
						]); ?>
					<?= $this->Form->label("message", __("Message"), ['class' => "label"]); ?>
					<?= $this->Form->control("message", [
						"label" => false,
						"type"  => "textarea",
						"class" => "textarea",
						"templateVars" => [
				            'help'      => __("Les utilisateurs seront invités dans l'apparts dans lequel tu te trouves lors du lancement de cette alerte."),
				            'display_icon' => 'none'
				        ]
						]); ?>
					
					<?= $this->Form->label("canFollow", __("Qui peut te rejoindre?"), ["class" => "label"]); ?>
					<?= $this->Form->select('canFollow', [
						    "true" 	=> __("Tout le monde"),
						    "false" => __("Personne"),
						]);
					?><br/><br/>
					<?= $this->Form->submit(__("Lancer"), [
						'class' => 'button is-success']
						); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</section>