<div id="message">
    <div class="notification" style="display: none;margin-bottom: 20px;"></div>
</div>
<?= $this->Form->create(null, ['url' => ['controller' => 'Ajax', 'action' => 'createPoll'], 'id' => 'form-createPoll']); ?>

<?= $this->Form->label('question', __('Pose ta question'), ['class' => 'label']); ?>
<?= $this->Form->control('question', [
    'label' => false,
    'placeholder' => __('Aimez-vous mon appartement?'),
    'templateVars' => [
        'help'      => __('Les Habbos présents dans ton appart pourront répondre au sondage par un J’aime ou un Je n\'aime pas'),
        'icon'      => 'question',
        'has_icon'  => 'has-icons-left'
    ]
]); ?>

<div class="field is-grouped is-grouped-centered">
    <p class="control">
        <?= $this->Form->submit(__('Lancer le sondage'), ['class' => 'button is-link']); ?>
    </p>
</div>
<?= $this->Form->end(); ?>
