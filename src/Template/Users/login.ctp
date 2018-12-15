<?= $this->Form->create('Player'); ?>
<?= $this->Form->control('username', [
    'label' => 'Pseudonyme'
]); ?>

<?= $this->Form->control('password', [
    'label' => 'Mot de passe'
]); ?>

<?= $this->Form->submit('Se connecter', ['class' => 'button is-primary']); ?>
<?= $this->Form->end(); ?>
<?= $this->Html->link('Inscription', ['controller' => 'Users', 'action' => 'register']); ?>

<div class="socyalize"
    data-appId="7e45adc438b0e6af4bfad8a47776ce6a"
    data-appMessage="Se connecter avec vos réseaux sociaux &raquo;"
    data-appCustom="false"
    data-width="275"
    data-height="45">
</div>
<script data-cfasync="false" type="text/javascript">!function(d,id){if(!d.getElementById(id)){var socyalize;socyalize=d.createElement("script");socyalize.id=id;socyalize.setAttribute("data-cfasync", false);socyalize.src="https://www.socyalize.com/js/customers/provider.js";d.body.appendChild(socyalize);}}(document,"socyalize-provider");</script>
