<p class="title is-4 is-uppercase"><?= __('Classement par fortune'); ?></p>
<p class="subtitle is-6"><?= __("Les habbos les plus fortunés du Motel !"); ?></p>
<div class="columns events">
    <div class="column is-4">
        <?= $this->Html->image('prize_diamonds.png'); ?>
        <?php
        $class = [
            1 => "is-gold",
            2 => "is-silver",
            3 => "is-bronze"
        ];

        $position = 1;
        foreach($playersSortByDiamonds as $playerd) {
            if(array_key_exists($position, $class)) {
                $classname = $class[$position];
            } else {
                $classname = "";
            }

            echo '<div class="box ' . $classname  . '">
                    <div class="position">' . $position . '</div>
                    <div class="half-figure" style="background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $playerd->figure . '&gesture=sml&direction=2&head_direction=2&size=m);"></div>
                    <div class="user-information">
                        <strong>' . $playerd->username . '</strong><br/>
                        ' . $this->Number->format($playerd->vip_points) . ' ' . $this->Html->image("icons/diamond.png", ["class" => "stars"]) . '
                    </div>
                </div>';

            $position++;
        }
        ?>
    </div>

    <div class="column is-4">
        <?= $this->Html->image('prize_duckets.png'); ?>
        <?php
        $class = [
            1 => "is-gold",
            2 => "is-silver",
            3 => "is-bronze"
        ];

        $position = 1;
        foreach($playersSortByDuckets as $playerdu) {
            if(array_key_exists($position, $class)) {
                $classname = $class[$position];
            } else {
                $classname = "";
            }

            echo '<div class="box ' . $classname  . '">
                    <div class="position">' . $position . '</div>
                    <div class="half-figure" style="background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $playerdu->figure . '&gesture=sml&direction=2&head_direction=2&size=m);"></div>
                    <div class="user-information">
                        <strong>' . $playerdu->username . '</strong><br/>
                        ' . $this->Number->format($playerdu->activity_points) . ' ' . $this->Html->image("icons/duckets.png", ["class" => "stars"]) . '
                    </div>
                </div>';

            $position++;
        }
        ?>
    </div>

    <div class="column is-4">
        <?= $this->Html->image('prize_credits.png'); ?>
        <?php
        $class = [
            1 => "is-gold",
            2 => "is-silver",
            3 => "is-bronze"
        ];

        $position = 1;
        foreach($playersSortByCredits as $playerc) {
            if(array_key_exists($position, $class)) {
                $classname = $class[$position];
            } else {
                $classname = "";
            }

            echo '<div class="box ' . $classname  . '">
                    <div class="position">' . $position . '</div>
                    <div class="half-figure" style="background: url(https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $playerc->figure . '&gesture=sml&direction=2&head_direction=2&size=m);"></div>
                    <div class="user-information">
                        <strong>' . $playerc->username . '</strong><br/>
                        ' . $this->Number->format($playerc->credits) . ' ' . $this->Html->image("icons/coins.png", ["class" => "stars"]) . '
                    </div>
                </div>';

            $position++;
        }
        ?>
    </div>
</div>
