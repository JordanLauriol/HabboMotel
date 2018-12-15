<h1 class="title is-4 is-uppercase"><?= __("Historique des transactions réalisées sur HabboMotel"); ?></h1>
<h3 class="subtitle is-6"><?= __("ci-dessous retrouve les transactions réalisées dans la boutique du site."); ?></h3>

<table class="table is-striped is-fullwidth">
	<thead>
		<tr>
			<th><?= __('ID'); ?></th>
			<th><?= __('Action'); ?></th>
			<th><?= __('Date'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($transactions as $transaction) {
			echo $this->Text->insert('<tr><td>:id</td><td>:action</td><td>:created</td></tr>', [
				'id' => $transaction->id,
				'action' => $transaction->message,
				'created' => $this->Time->timeAgoInWords($transaction->created),
			]);
		}
		?>
	</tbody>
</table>