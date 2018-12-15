<div class="column">
	<h1 class="title is-4 is-uppercase"><?= __("Forum de discussion"); ?></h1>
	<h2 class="subtitle is-5"><?= __("Le forum est un lieu d'échanges sur HabboMotel où tu peux dire tout ce que tu veux."); ?></h2>

	<div class="columns">
		<div class="column is-8">
			<div id="categories">
				<?php
				foreach($categories as $category) {
					echo '<a href="' . $this->Url->build(["controller" => "Forum", "action" => "category", $category->slug]) . '">
					<div class="category">
						<img src="' . $category->image . '">
						<h2 class="name">' . $category->name . '</h2>
						<p class="description">' . $category->description . '</p>
					</div>
					</a>';
				} ?>
			</div>
		</div>
		<div class="column is-4">
			<h2 class="title is-5"><?= __("Les experts du forum"); ?></h2>
			<h3 class="subtitle is-6"><?= __("ci-dessous les Habbos qui s'impliquent le plus dans le forum."); ?></h3>

			<style>
			#highscore {
				margin-bottom: 20px;
			}

			#highscore .user-information {

			}

			#highscore .user-information img {
			}

			#highscore .user-information .username {
				position: absolute;
				margin: 13px 0px 0px 10px;
				font-size: 20px;
			}

			#highscore .user-information .reply-count {
				position: absolute;
				margin: 40px 0px 0px 10px;
				font-size: 12px;
			}
			</style>

			<div id="highscore">

				<?php
				foreach($players as $player) {
					echo '<div class="user-information">
						<img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $player->figure . '&gesture=sml&action=&head_direction=3&headonly=1">

						<span class="username">' . $player->username . '</span>
						<span class="reply-count">' . sprintf(__("%s réponses"), $player->forum_reply_count) . '</span>
					</div>';
				}
				?>
			</div>

			<h2 class="title is-5"><?= __("Dernière activités"); ?></h2>
			<h3 class="subtitle is-6"><?= __("ci-dessous les discussions dernièrement actif sur le forum."); ?></h3>
			<style>
			#threads-activities {
			}

			#threads-activities .activity {
				display: block;
				margin: 0px 0px 5px 10px;
				font-size: 16px;
			}
			</style>
			<div id="threads-activities">
				<?php
				foreach($threads as $thread) {
					echo '
					<div class="activity">
						' . $this->Html->image("forum/flashy_arrow.gif") . ' <a class="tooltip is-tooltip-bottom" data-tooltip="' . sprintf(__("par %s"), $thread->player->username) . '" href=" ' . $this->Url->build(["action" => "thread", $thread->slug]) . '">' . $this->Text->truncate($thread->name, 75) . '</a>
					</div>';
				}
				?>
			</div>
		</div>

	</div>
</div>
