<div class="column">
	<h1 class="title is-5"><?= $this->Html->link(__("Forum"), ["controller" => "Forum", "action" => "index"], ['class' => 'breadcrumbs']); ?> / <?= $this->Html->link($thread->forum_category->name, ["controller" => "Forum", "action" => "category", $thread->forum_category->slug], ['class' => 'breadcrumbs']); ?></h1>
	<h2 class="subtitle is-6"><?= htmlspecialchars($thread->name); ?></h2>
	
	<?php
	if($this->request->session()->check("Auth.User.id") && $this->request->session()->read("Auth.User.rank") >= 5) {
		echo '<a href="' . $this->Url->build(["action" => "togglePin", $thread->id]) . '" class="button ' . (($thread->has_pin == 0) ? "is-success" : "is-danger") . '">' . (($thread->has_pin == 0) ? __("Epingler") : __("Désépingler")) . '</a>';

		echo '&nbsp; <a href="' . $this->Url->build(["action" => "toggleState", $thread->id]) . '" class="button ' . (($thread->has_close == 0) ? "is-danger" : "is-success") . '">' . (($thread->has_close == 0) ? __("Fermer la discussion") : __("Ouvrir la discussion")) . '</a>';

		echo '<br/><br/>';
	}
	?>

	<div id="replies">
		<?php
		foreach($replies as $reply) {
			echo '<div id="reply">
			<div class="user-information">
			 	<img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $reply->player->figure . '&amp;gesture=sml&amp;action=&amp;head_direction=3&amp;size=l&headonly=1" alt=""/>

			 	' . (($reply->player->rank > 2) ? '<img class="badge" src="https://flash.habbomotel.in/c_images/album1584/ADM.gif">' : '') . '

			 	<span class="username">' . $reply->player->username . '</span>
			 	<span class="motto">' . htmlspecialchars($reply->player->motto) . '</span>
			 </div>

			 <div class="say"></div>
			 <div class="content">
			 	' . (($this->request->session()->read("Auth.User.id") == $reply->player_id || $this->request->session()->read("Auth.User.rank") >= 5) ? '<a href="' . $this->Url->build(['controller' => 'Forum', 'action' => 'deleteReply', $reply->id]) . '"><div class="close tooltip is-tooltip-bottom" data-tooltip="' . __("Supprimer la réponse") . '"></div></a>' : '') . '
			 	<div class="markdown">' . $reply->reply . '</div>
			 	<div style="text-align: right;font-size: 12px">' . sprintf(__("Il y a %s"), $this->Time->timeAgoInWords($reply->modified)) . '</div>
			 </div>
		</div>';
		}
		?>

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
	
		<?php if($this->request->session()->check('Auth.User.id') && $thread->has_close == 0) { ?>
		<div id="reply">
			<div class="user-information">
				<img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= $this->request->session()->read("Auth.User.figure"); ?>&amp;gesture=sml&amp;action=&amp;head_direction=3&amp;size=l&headonly=1" alt=""/>

				<span class="username"><?= $this->request->session()->read("Auth.User.username"); ?></span>
			 	<span class="motto"><?= $this->request->session()->read("Auth.User.motto"); ?></span>
			</div>

			<div class="say"></div>
				<?= $this->Form->create($newReply, ["url" => ["action" => "createReply"]]); ?>
				<?= $this->Form->hidden("thread_id", ["value" => $thread->id]); ?>
				<?= $this->Form->hidden("player_id", ["value" => $this->request->session()->read("Auth.User.id")]); ?>
				<?= $this->Form->control("reply", [
					"id" => "answer",
					"label" => false,
					"class" => "textarea",
					"templateVars" => [
						"help" => null
					]
				]); ?>
				<?= $this->Form->submit(__("Publier ma réponse"), ["class" => "button is-success"]); ?>
				<?= $this->Form->end(); ?>
		</div>
		<?php } ?>
	</div>
</div>

<script>
new SimpleMDE({
	autofocus: false,
	element: document.getElementById("answer"),
	spellChecker: false,
	placeholder: "<?= __("Répondre..") ?>",
});

$(".content .markdown").each(function() {
	var contentMarkDown = $(this).html();
	
	var converter = new showdown.Converter(),
    contentHtml      = converter.makeHtml(contentMarkDown);

    $(this).html(contentHtml);
});
</script>