<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column">
				<?= $this->Flash->render(); ?>
				<table class="table is-striped is-fullwidth">
					<thead>
						<tr>
							<th><?= __("Photo"); ?></th>
							<th><?= __("Actions"); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($pictures as $picture) { ?>
							<tr>
								<td><a href="<?= $this->request->webroot . $picture->picture; ?>" target="_blank"><img src="<?= $this->request->webroot . $picture->picture; ?>" style="width: 100px; height: 100px;"></a></td>
								<td>
									<?= $this->Html->link(__("Accepter"), ["action" => "picture", "id" => $picture->id, "act" => "confirmed"], ["class" => "button is-success"]); ?>
									<br/><br/>
									<?= $this->Html->link(__("Refuser"), ["action" => "picture", "id" => $picture->id, "act" => "declined"], ["class" => "button is-danger"]); ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>