<div class="columns">
    <?= $this->element('Avatars/Settings/nav'); ?>

    <div class="column">
        <p class="title is-4 is-uppercase"><?= __("Historique de connexions"); ?></p>
        <p class="subtitle is-6"><?= __("ci-dessous toutes les connexions enregistrées sur votre compte."); ?></p>
        <p style="text-align: right;margin-bottom: 5px;"><?= $this->Html->link(__("Vider l'historique de connexions"), ["action" => "clearHistory"]); ?></p>
        <table class="table is-striped is-fullwidth">
            <thead>
                <tr>
                    <th><?= __('Adresse IP'); ?></th>
                    <th><?= __('Navigateur'); ?></th>
                    <th><?= __('Date'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($user as $address) {
                    echo $this->Text->insert('<tr><td><a href="http://whatismyipaddress.com/ip/:address" target="_blank">:address</a></td><td>:browser</td><td>:created</td></tr>', [
                        'address' => $address->address,
                        'browser' => $address->agent,
                        'created' => $this->Time->timeAgoInWords($address->created),
                    ]);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
