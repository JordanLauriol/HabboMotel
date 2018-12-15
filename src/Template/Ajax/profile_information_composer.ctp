<div class="user-figure">
    <span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
    <img class="head" src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= $message['user']['look']; ?>&gesture=sml&head_direction=3&headonly=1">
</div>

<div class="user-information tooltip is-tooltip-right" data-tooltip="<?= __('En savoir plus sur ce joueur'); ?>">
    <span class="username"><?= $message['user']['username']; ?></span>
</div>
