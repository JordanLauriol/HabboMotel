<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column">
				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<article class="tile is-child notification is-tile-red">
							<p class="title is-5"><?= __('Joueurs bannis'); ?></p>
							<p class="subtitle"><?= $bans->count(); ?></p>
						</article>
					</div>
					<div class="tile is-parent">
						<article class="tile is-child notification is-tile-gray">
							<p class="title is-5"><?= __('Record de connectés'); ?></p>
							<p class="subtitle"><?= $status->player_record; ?></p>
						</article>
					</div>
					<div class="tile is-parent">
						<article class="tile is-child notification is-tile-green">
							<p class="title is-5"><?= __('Joueurs connectés'); ?></p>
							<p class="subtitle"><?= $status->active_players; ?></p>
						</article>
					</div>
				</div>

				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<article class="tile is-child notification is-tile-subred">
							<p class="title is-5"><?= __('Joueurs enregistrés'); ?></p>
							<p class="subtitle"><?= $players->count(); ?></p>
						</article>
					</div>
					<div class="tile is-parent">
						<article class="tile is-child notification is-tile-subgray">
							<p class="title is-5"><?= __('Photos à approuver'); ?></p>
							<p class="subtitle"><?= $pictures->count(); ?></p>
						</article>
					</div>
					<div class="tile is-parent">
						<article class="tile is-child notification is-tile-subgreen">
							<p class="title is-5"><?= __('Apparts ouverts'); ?></p>
							<p class="subtitle"><?= $status->active_rooms; ?></p>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>