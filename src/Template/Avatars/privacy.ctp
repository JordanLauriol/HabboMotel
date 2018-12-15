<div class="columns">
    <?= $this->element('Avatars/Settings/nav'); ?>

    <div class="column is-8">
    	<div class="box">
    		<div class="box-title is-dark has-text-centered is-uppercase"><?= __('Modifications générales'); ?></div>
    		<div class="content">
	    		<?= $this->Form->create($user); ?>	    		
	    		<div class="field">
		    		<?= $this->Form->checkbox("allow_friend_requests", [
		    			"id" => "allow-friend-requests",
		    			"class" => "switch is-rtl is-rounded is-success" 
		    			]); ?>
		    		<?= $this->Form->label('allow_friend_requests', __("Accepter les demandes d'amis")); ?>
		    		<span class="help"><?= __("Les autres Habbos peuvent m'envoyer des demandes d'amis."); ?></span>
	    		</div>

	    		<div class="field">
		    		<?= $this->Form->checkbox("allow_trade", [
		    			"id" => "allow-trade",
		    			"class" => "switch is-rtl is-rounded is-success" 
		    			]); ?>
		    		<?= $this->Form->label('allow_trade', __("Activer le troc")); ?>
		    		<span class="help"><?= __("Les autres Habbos peuvent échanger avec moi."); ?></span>
	    		</div>


	    		<div class="field">
		    		<?= $this->Form->checkbox("allow_mentions", [
		    			"id" => "allow-mentions",
		    			"class" => "switch is-rtl is-rounded is-success" 
		    			]); ?>
		    		<?= $this->Form->label('allow-mentions', __("Autoriser les identifications")); ?>
		    		<span class="help"><?= __("Les autres Habbos peuvent m'identifier dans un message."); ?></span>
	    		</div>

	    		<div class="field">
		    		<?= $this->Form->checkbox("allow_sounds", [
		    			"id" => "allow-sounds",
		    			"class" => "switch is-rtl is-rounded is-success" 
		    			]); ?>
		    		<?= $this->Form->label('allow-sounds', __("Son des notifications")); ?>
		    		<span class="help"><?= __("Un son est produit lorsque tu reçois une notification."); ?></span>
	    		</div>

	    		<div class="field">
		    		<?= $this->Form->checkbox("allow_alerts", [
		    			"id" => "allow-alerts",
		    			"class" => "switch is-rtl is-rounded is-success" 
		    			]); ?>
		    		<?= $this->Form->label('allow-alerts', __("Recevoir les alertes des staffs")); ?>
		    		<span class="help"><?= __("En désactivant ce paramètre tu ne recevras plus d'alertes des staffs (animations et informations compris)"); ?></span>
	    		</div>

	    		<div class="field">
	    			<?= $this->Form->label('hide-online', __("Qui peut me voir connecté")); ?>
	    			<br/>
		    		<?= $this->Form->radio("hide_online", [__("Tout le monde"), __("Personne")], ["class" => "is-checkradio"]); ?>
	    		</div>

	    		<div class="field">
	    			<?= $this->Form->label('hide-inroom', __("Qui peut me rejoindre")); ?>
	    			<br/>
		    		<?= $this->Form->radio("hide_inroom", [__("Mes amis"), __("Personne")], ["class" => "is-checkradio"]); ?>
	    		</div>

	    		<?= $this->Form->submit(__("Modifier mes paramètres"), ["class" => "button is-success"]); ?>
	    		<?= $this->Form->end(); ?>
	    	</div>
    	</div>
    </div>
</div>
