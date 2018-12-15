<p class="title is-4 is-uppercase"><?= __('Le personnel de l\'hôtel'); ?></p>

<?php
foreach($team as $rank => $players) {
    echo '<div class="column team">
            <p class="title is-4">' . $rank . '</p>
         ';

    foreach($players as $player) {
        echo '<div class="user" data-uid="' . $player->id . '">
                ' . $this->Html->image('https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $player->figure . '&gesture=sml&direction=3&head_direction=3&size=l') . '
                <div class="bottom">
                    <p>
                        <li style="text-transform:uppercase"><b>' . $player->username . '</b></li>
                        <li><small>' . $player->responsability . '</small></li>
                    </p>
                </div>
              </div>';
    }

    echo '</div>';
}
?>

<div class="team">
    <div class="box team ui" style="width: 23rem; display:none;">
        <div class="content">
            <div class="information">
                <p id="username" class="title is-4 is-uppercase"></p>
                <li id="motto" class="line"><?= $this->Html->image('icons/mission.png'); ?> <span><small><i></i></small></span></li>
                <li id="last_online" class="line"><?= $this->Html->image('icons/hours.png'); ?> <span><small><i></i></small></span></li>
            </div>
        </div>
    </div>
</div>
