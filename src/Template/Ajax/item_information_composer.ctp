            <div class="header">
                <?= $this->Html->image('icons/item_details.png'); ?> <?= $message["item"]["publicName"]; ?>
                <?= $this->Html->image('icons/close.gif', ['align' => 'right', 'class' => 'close']); ?>
            </div>

            <div class="item">
                <?= $this->Html->image('item_background.png'); ?>
                <?php
                    echo '<img class="rare-scale" src="https://flash.habbomotel.in/dcr/hof_furni/icons/icons.php?icon=' . $furniture->furniture->item_name . '">';
                ?>
                <?php if($message["item"]["isLtd"] == "true") echo $this->Html->image('ltd.png', ['class' => 'ltd']); ?>
            </div>

            <div class="item-details">
                <ul>
                    <?php                    
                    if($furniture->cost_diamonds > 0) {
                        echo '<li>' . $this->Html->image('icons/diamonds.png') . ' ' . __('Ce mobi a été vendu à <b>{0}</b> diamants.', $this->Number->format($furniture->cost_diamonds)) . '</li>';
                    } else if($furniture->cost_pixels > 0) {
                        echo '<li>' . $this->Html->image('icons/duckets.png') . ' ' . __('Ce mobi a été vendu à <b>{0}</b> duckets.', $this->Number->format($furniture->cost_pixels)) . '</li>';
                    } else {
                        echo '<li>' . $this->Html->image('icons/credits.png') . ' ' . __('Ce mobi a été vendu à <b>{0}</b> credits.', $this->Number->format($furniture->cost_credits)) . '</li>';
                    }
                    ?>
                    <li><?= $this->Html->image('icons/item_count.png'); ?> <?= __('<b>{0}</b> exemplaires en circulation,', count($items)); ?></li>
                    <li><?= $this->Html->image('icons/item_room.png'); ?> <?= __('dont <b>{0}</b> exemplaires posés dans des apparts', ((isset($itemsCount['room'])) ? $itemsCount['room'] : 0)); ?></li>
                    <li><?= $this->Html->image('icons/shop.png'); ?> <?= __('et <b>{0}</b> exemplaires stockés dans des inventaires.', ((isset($itemsCount['inventory'])) ? $itemsCount['inventory'] : 0)); ?></li>
                </ul>
            </div>

            <div class="item-rate" <?= (is_null($myRate)) ? 'data-canrate="true"' : 'data-canrate="false"'; ?>>
                <?= __('Souhaites-tu évaluer ce mobi ?'); ?>
                <div class="rate">
                    <center>
                        <?php 
                        for ($i = 1; $i <= 5; $i++) {
                            echo '<div class="stars ' . ((isset($myRate) && $i <= $myRate->rate) ? 'is-active' : '') . '"></div>';
                        }
                        ?>
                    </center>
                </div>
                
                <?= __('Ce mobi a reçu une note de <b>{0}</b> sur 5', $avg); ?>
                <center>
                    <?php 
                    for ($i = 1; $i <= 5; $i++) {
                        echo '<div class="stars ' . ((isset($avg) && $i <= $avg) ? 'is-active' : '') . '"></div>';
                    }
                    ?>
                </center>
            </div>