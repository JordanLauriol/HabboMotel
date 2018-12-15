<p class="title is-4 is-uppercase"><?= __('Historique des notifications'); ?></p>
<p class="subtitle is-6"><?= $this->Html->link(__('Tout marquer comme lu'), [
    'controller' => 'Notifications',
    'action'     => 'clear'
]); ?></p>

<table class="table is-striped is-fullwidth">
    <thead>
        <tr>
            <th><?= __('Notification'); ?></th>
            <th><?= __('Date'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($notifications as $notification) {
            echo $this->Text->insert('<tr class=":class"><td>:message</td><td>:created</td></tr>', [
                'class'   => (($notification->is_read == 0) ? 'is-selected' : ''),
                'message' => $notification->message,
                'created' => $this->Time->timeAgoInWords($notification->created),
            ]);
        }
        ?>
    </tbody>
</table>
