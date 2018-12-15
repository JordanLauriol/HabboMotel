<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column">
				<?= $this->Flash->render(); ?>
				<div class="box">
					<p class="title is-6"><?= __("Bannir un Habbo"); ?></p>
					<p class="subtitle is-6"><?= __("Les actions que vous réalisez dans l'administration sont sauvegardées et consultable par la haute administration."); ?></p>

					<?= $this->Form->create($ban); ?>

					<?= $this->Form->label('username', __('Pseudonyme du Habbo'), ['class' => 'label']); ?>
				    <?= $this->Form->control('username', [
				        'label' => false,
				        'templateVars' => [
				            'help'      => null,
				            'icon'      => 'user',
				            'has_icon'  => 'has-icons-left'
				        ]
				    ]); ?>

				    <?= $this->Form->label('reason', __("Motif de l'exclusion"), ['class' => 'label']); ?>
				    <?= $this->Form->control('reason', [
				    	'label' => false,
				    	'templateVars' => [
				    		'help' 		=> __("Définissez un motif explicite pour faciliter la gestion par la haute administration."),
				    		'icon' 		=> 'pencil',
				    		'has_icon'  => 'has-icons-left'
				    	]
				    ]); ?>

				    <?= $this->Form->label('type', __("Type d'exclusion"), ['class' => 'label']); ?>
				    <?= $this->Form->select('type', [
				    		'user' 		=> 'Bannir seulement le Habbo',
				    		'machine' 	=> 'Bannir la machine du Habbo',
				    		'ip'		=> 'Bannir son adresse IP'
 				    	], 
				    	[
				    		'id' => 'type'
				    ]); ?>
				    <br/><br/>
				    <?= $this->Form->label('expire', __("Durée de l'exclusion"), ['class' => 'label']); ?>
				    <?= $this->Form->select('expire', [
				    		'+2 hours' 	=> 'Pendant 2H',
				    		'+12 hours' => 'Pendant 12H',
				    		'+1 day'    => 'Pendant 1 jour',
				    		'+2 days'  	=> 'Pendant 2 jours',
				    		'+1 week'   => 'Pendant 1 semaine',
				    		'+2 weeks'	=> 'Pendant 2 semaines',
				    		'+1 month'	=> 'Pendant 1 mois',
				    		'+3 month'	=> 'Pendant 3 mois',
				    		'+10 years'	=> 'Permanent'
 				    	], 
				    	[
				    		'id' => 'type'
				    ]); ?>
				    <br/><br/>

				    <?= $this->Form->submit(__('Bannir le Habbo'), [
				    	'class' => 'button is-success'
				    	]); ?>

				    <?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</section>