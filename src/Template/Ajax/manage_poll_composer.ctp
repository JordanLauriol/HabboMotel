<script>
$("#tabs-js").tabs();
</script>
<div id="tabs-js">
    <div class="modal-header">
        <?= __('Gérer tes sondages'); ?>
        <span class="close"><?= $this->Html->image('icons/close.gif'); ?></span>
    </div>
    <div class="modal-body">
        <div class="tabs is-centered">
            <ul>
                <li class="createPoll"><a href="#createPoll"><?= __('Créer un sondage'); ?></a></li>
                <li class="inProgressPoll"><a href="#inProgressPoll"><?= __('Sondage en cours'); ?></a></li>
                <li class="historyPoll"><a href="#historyPoll"><?= __('Historique des sondages'); ?></a></li>
            </ul>
        </div>

        <div id="createPoll"></div>
        <div id="inProgressPoll"></div>
        <div id="historyPoll"></div>
    </div>
    <div class="modal-footer">
    </div>
</div>
