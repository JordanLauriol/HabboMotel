<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column">
				<?= $this->Flash->render(); ?>
				<table class="table is-striped is-fullwidth">
					<thead>
						<tr>
							<th><?= __("Titre"); ?></th>
							<th><?= __("Date de publication"); ?></th>
							<th><?= __("Edition"); ?></th>
							<th><?= __("Suppression"); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($articles as $article) { ?>
							<tr>
								<td><?= $article->title; ?></td>
								<td><?= $this->Time->timeAgoInWords($article->created); ?></td>
								<td><?= $this->Html->link(__("Editer"), ["action" => "editArticle", "articleId" => $article->id], ["class" => "button is-warning"]); ?></td>
								<td><?= $this->Html->link(__("Supprimer"), ["action" => "deleteArticle", "articleId" => $article->id], ["class" => "button is-danger"]); ?></td>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>