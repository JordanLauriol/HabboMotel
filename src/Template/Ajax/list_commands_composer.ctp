<script>
$('.close').click(function() {
    $(document).find('#listCommandsComposer').hide();
});

$("#commands").tabs();
</script>
<div id="commands">
<section class="hero is-link" style="width: 100%; border-top-left-radius: 10px; border-top-right-radius: 10px;background-color: #33799f;">
    <div class="hero-body">
        <span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
        <div class="container">
            <h1 class="title">
                <?= __('Les commandes'); ?>
            </h1>
            <h2 class="subtitle">
                <?= __('Liste des commandes classées par rang'); ?>
            </h2>
        </div>
    </div>
    <div class="hero-foot">
        <nav class="tabs is-fullwidth">
            <div class="container">
                <ul>
                    <?php if($message["user"]["rank"] >= 1) { ?>
                        <li><a href="#normal"><?= __('Normal'); ?></a></li>
                    <?php } ?>

                    <?php if($message["user"]["rank"] >= 2) { ?>
                        <li><a href="#hc"><?= __('HC'); ?></a></li>
                    <?php } ?>

                    <?php if($message["user"]["rank"] >= 3) { ?>
                        <li><a href="#staff"><?= __('Staff'); ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </div>
</section>

<div class="modal-body">
    <div class="content">

        <div id="normal">
            <p>
                <?= __('Liste des commandes des <b>utilisateurs normaux</b>.'); ?>
            </p>

            <p>
                <span class="tag is-link"><?= __('@pseudo %message%'); ?></span> - <?= __("Notifie l'utilisateur cible en le mentionnant."); ?>
            <p>
            <?php
            foreach($user as $command => $parameters) {
                echo '<p><span class="tag is-warning">:' . $command . ' ' . $parameters["parameter"] . '</span> - ' . $parameters["description"] . '</p>';
            }
            ?>
        </div>

        <div id="hc">
            <p>
                <?= ($message["user"]["rank"] >= 2) ? __('Liste des commandes des <b>utilisateurs HC</b>.') : ""; ?>
            </p>

            <?php
            foreach($hc as $command => $parameters) {
                echo '<p><span class="tag is-warning">:' . $command . ' ' . $parameters["parameter"] . '</span> - ' . $parameters["description"] . '</p>';
            }
            ?>
        </div>

        <div id="staff">
            <p>
                <?= ($message["user"]["rank"] >= 5) ? __('Liste des commandes des <b>utilisateurs staff</b>.') : ""; ?>
            </p>

            <?php
            foreach($staff as $command => $parameters) {
                if($parameters["permission"] > $message["user"]["rank"]) continue;

                echo '<p><span class="tag is-warning">:' . $command . ' ' . $parameters["parameter"] . '</span> - ' . $parameters["description"] . '</p>';
            }
            ?>
        </div>
    </div>
</div>
<div class="modal-footer">
</div>
</div>
