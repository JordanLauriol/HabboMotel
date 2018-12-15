<div class="header">
    <?= $this->Html->image('icons/profil.png', ['style' => 'position: absolute;']); ?>
    <span style="position: absolute; margin-top: -1px; margin-left: 40px;"><?= $message['user']['username']; ?></span>
    <?= $this->Html->image('icons/close.gif', ['align' => 'right', 'class' => 'close']); ?>
</div>
<div class="body">
    <div style="height: 150px; width: 100%;">
        <img class="avatar" align="left" src="<?= empty($network['picture']) ? $this->request->webroot . 'img/uploads/avatar_defaut.png' : $this->request->webroot . $network['picture']; ?>">
        <div style="position: absolute; margin-left: 160px">
            <p style="word-wrap: break-word;word-break: break-word;"><?= htmlspecialchars($message['user']['motto']); ?></p>
            <p style="margin-top: 20px" class="title is-6"><?= __('Trophées acquis :'); ?></p>
            <p class="subtitle is-6"><?= $playerTrophies; ?> <?= __('sur'); ?> <?= $trophies; ?></p>
        </div>
    </div>
    <div style="margin-top: 20px;height: 60px;">
        <div class="friend" style="display: inline-block;">
            <?php
            if($message['user']['username'] == $message['me']['username']) {
                echo $this->Html->image('icons/check.png') . __(' C\'est moi');
            } else if(!is_null($areFriend)) {
                echo $this->Html->image('icons/check.png') . __(' Ami');
            } else {
                echo $this->Html->image('icons/friends.png', ['class' => 'add-friend']);
            }
            ?>
        </div>

        <style>
        td {
            padding-right: 30px;
        }
        li {
            margin-bottom: 5px;
        }
        </style>
        <table style="display: inline-block;position: absolute;margin-left: 25px;margin-top: 3px;">
            <tr>
                <td><p class="title is-6"><?= __('Amis'); ?></p></td>
                <td><p class="title is-6"><?= $this->Number->format($message['user']['respects']); ?></p></td>
            </tr>
            <tr>
                <td><?= $this->Number->format($message['friends']['friendCount']); ?></td>
                <td><?= __('respects reçus'); ?></td>
            </tr>
        </table>
    </div>

    <div>
        <p class="title is-6" style="margin-top: 5px; padding-bottom: 10px; border-bottom: 1px solid rgb(36, 50, 60)"><?= __('Ses réseaux sociaux'); ?></p>

        <ul style="margin-top: 0px;">
            <li><?= $this->Html->image('icons/twitter.png'); ?> <span class="network"><?= (!empty($network['twitter'])) ? htmlspecialchars($network['twitter']) : __("non renseigné"); ?></span></li>
            <li><?= $this->Html->image('icons/instagram.png'); ?> <span class="network"><?= (!empty($network['instagram'])) ? htmlspecialchars($network['instagram']) : __("non renseigné"); ?></span></li>
            <li><?= $this->Html->image('icons/snapchat.png'); ?> <span class="network"><?= (!empty($network['snapchat'])) ? htmlspecialchars($network['snapchat']) : __("non renseigné"); ?></span></li>
        </ul>

        <p class="title is-6" style="margin-top: 20px; padding-bottom: 10px; border-bottom: 1px solid rgb(36, 50, 60)"><?= __('Côte de popularité'); ?></p>
        <div class="user-rate" <?= (is_null($myRate)) ? 'data-canrate="true"' : 'data-canrate="false"'; ?>>
            <center>
                <div class="rate">
                    <p><?= __('Souhaites-tu évaluer ce Habbo?'); ?></p>
                    <?php
                    for($i = 1; $i <= 5; $i++) {
                        echo '<div class="stars ' . ((isset($myRate) && $i <= $myRate->rate) ? 'is-active' : '') . '"></div>';
                    }
                    ?>
                </div>

                <p><?= __('Note <b>{0}</b> sur 5 ({1} votes)', $avg, $ratesCount->count()); ?></p>
                <?php
                for($i = 1; $i <= 5; $i++) {
                    echo '<div class="stars ' . ((isset($avg) && $i <= $avg) ? 'is-active' : '') . '"></div>';
                }
                ?>
            </center>
        </div>
    </div>
</div>
