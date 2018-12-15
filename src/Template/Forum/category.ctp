<div class="column">
	<h1 class="title is-5"><?= $this->Html->link(__("Forum"), ["controller" => "Forum", "action" => "index"]); ?> / <?= $category->name; ?></h1>
	<h2 class="subtitle is-6"><?= $category->description; ?></h2>
	
	<div class="category-information">
		<span style="font-size: 18px; text-transform: uppercase; float: left;"><?= sprintf(__("<b>%s</b> discussions"), $category->thread_count); ?></span>
		
		<?php if($this->request->session()->check("Auth.User.id")) { ?>
			<a href="<?= $this->Url->build(["controller" => "Forum", "action" => "createThread"]); ?>" style="float: right;" class="button is-success tooltip is-tooltip-left" data-tooltip="<?= __("Créer une nouvelle discussion"); ?>">
				<span class="icon is-small">
					<i class="fa fa-plus"></i>
				</span>
			</a>
		<?php } ?>
	</div>

	<div id="threads">
		<?php
		foreach($threads as $thread) {
			echo '
			<a href="' . $this->Url->build(["controller" => "Forum", "action" => "thread", $thread->slug]) . '">
			<div id="thread" class="tooltip is-tooltip-bottom ' . (strlen($thread->name) > 75 ? 'is-tooltip-multiline' : '') . '" data-tooltip="' . htmlspecialchars($thread->name) . '">

				' . (($thread->has_pin == 1) ? '<div class="pin"></div>' : '') . '

				' . (($thread->has_close == 1 && $thread->has_pin == 0) ? '<div class="close"></div>' : '') . '

				<img ' . (is_null($thread->forum_threads_read) ? 'class="unread"' : '') . ' src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $thread->player->figure . '&gesture=sml&head_direction=3&headonly=1">
				<h2 class="name">' . $this->Text->truncate(htmlspecialchars($thread->name), 45) . '</h2>
				<div class="last-activity">' . sprintf(__("Dernière activité %s"), $this->Time->timeAgoInWords($thread->modified)) . '
				</div>
				<div class="reply-count">
				' . sprintf(__("%s réponses"), $thread->reply_count) . '
				</div>
			</div>
			</a>';
		}
		?>
	</div>
	
	<div id="paginator">
		<div style="text-align:left;">
			<?= $this->Paginator->first(__("Revenir au début")); ?>

			<?= ($this->Paginator->hasPrev() ? $this->Paginator->prev(__("« Précédent")) : ""); ?>
		</div>

		<div style="text-align: center; margin-top: 10px">
			<?= $this->Paginator->counter(__("{{page}} sur {{pages}}")); ?><br/>
		</div>

		<div style="text-align: right;">
			<?= ($this->Paginator->hasNext() ? $this->Paginator->next(__("Suivant »")) : ""); ?>
			<?= $this->Paginator->last(__("Aller à la fin")); ?>
		</div>
	</div>
</div>