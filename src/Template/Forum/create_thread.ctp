<div class="columns">
	<div class="column is-8">
		<h1 class="title is-4"><?= __("Créer une nouvelle discussion"); ?></h1>
		<h2 class="subtitle is-5"><?= __("Profite de cette espace pour partager avec les autres Habbos!"); ?></h2>
		<?= $this->Form->create($thread); ?>
		<?= $this->Form->hidden("player_id", ["value" => $this->request->session()->read("Auth.User.id")]); ?>
		<?= $this->Form->label("name", __("Nom de la discussion"), ["class" => "label"]); ?>
		<?= $this->Form->control("name", [
			"label" => false,
			"templateVars" => [
				"help" => "C'est la première phrase que les Habbos verront lorsqu'ils navigueront dans la catégorie.",
				"has_icon" => "has-icons-left",
				"icon"	=> "pencil"
			]
			]); ?>
		<br/>
		<?= $this->Form->label("category_id", __("Catégorie"), ["class" => "label"]); ?>
		<?= $this->Form->control("category_id", [
			"label" => false,
			"style" => "width: 100%;",
			"templateVars" => [
				"help" => "Sélectionne une catégorie appropriée à la discussion que tu vas lancer.",
				"has_icon" => "has-icons-left",
				"icon" => "list"
			]
			]); ?>
		<br/>
		<?= $this->Form->hidden("forum_replies.0.player_id", ["value" => $this->request->session()->read("Auth.User.id")]); ?>
		<?= $this->Form->label("forum_replies.0.reply", __("Message"), ["class" => "label"]); ?>
		<?= $this->Form->control("forum_replies.0.reply", [
			"id" => "textarea",
			"label" => false,
			"class" => "textarea",
			"templateVars" => [
				"help" => "Exprime-toi librement dans ton message, pense à utiliser un langage correcte pour que les Habbos te comprennent."
			]
			]); ?>

		<?= $this->Form->submit(__("Créer ma discussion"), ["class" => "button is-success"]); ?>
		<?= $this->Form->end(); ?>
	</div>
	<div class="column is-4">
		<h1 class="title is-4"><?= __("Quelques conseils..."); ?></h1>
		<h2 class="subtitle is-6"><?= __("Le respect de la Habbo Attitude dans le forum est primordiale, nous comptons sur toi !"); ?></h2>
		<br/>
		<?= $this->Html->image("forum/create-thread.gif"); ?>
	</div>
</div>

<script>
	new SimpleMDE({
		element: document.getElementById("textarea"),
		spellChecker: false,
		autosave: {
			enabled: true,
			uniqueId: "textarea",
			delay: 1000,
		}
	});
</script>