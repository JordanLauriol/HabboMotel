<?= $this->Form->create($user); ?>
<?= $this->Form->control('username', [
    'label' => 'Pseudonyme' 
]); ?>
<?= $this->Form->control('password', [
    'label' => 'Mot de passe'
]); ?>
<?= $this->Form->control('mail', [
    'label' => 'Adresse e-mail'
]); ?>
<?= $this->Form->control('legal', [
    'type'  => 'checkbox',
    'label' => 'J\'accepte les conditions d\'utilisation'
]); ?>
<?= $this->Form->submit('S\'enregistrer'); ?>
<?= $this->Form->end(); ?>