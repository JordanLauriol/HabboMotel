<div class="column is-3">
	<div class="box">
		<aside class="menu is-link">
			<p class="menu-label">
				<?= __('Générale'); ?>
			</p>
			<ul class="menu-list">
				<li><?= $this->Html->link(__('Tableau de bord'), ['action' => 'index'], ['class' => ($page == "dashboard") ? "is-active" : ""]); ?></li>
			</ul>
			<p class="menu-label">
				<?= __('Modération'); ?>
			</p>
			<ul class="menu-list">
				<li>
					<a class="has-parent" data-children="manage-ban"><?= __ ('Gestion des exclusions'); ?></a>

					<ul class="has-children" data-children="manage-ban">
						<li><?= $this->Html->link(__('Bannir un Habbo'), ['action' => 'ban'], ['class' => ($page == "ban") ? "is-active" : ""]); ?></li>
						<li><?= $this->Html->link(__('Débannir un Habbo'), ['action' => 'unban'], ['class' => ($page == "unban") ? "is-active" : ""]); ?></li>
					</ul>
				</li>

				<li><?= $this->Html->link(__('Photos'), ['action' => 'picture'], ['class' => ($page == "picture") ? "is-active" : ""]); ?></li>
			</ul>

			<p class="menu-label">
				<?= __('Animation'); ?>
			</p>
			<ul class="menu-list">
				<li><?= $this->Html->link(__('Lancer une animation'), ['action' => 'event'], ['class' => ($page == "event") ? "is-active" : ""]); ?></li>
			</ul>

			<p class="menu-label">
				<?= __('Administration'); ?>
			</p>
			<ul class="menu-list">
				<li>
					<a class="has-parent" data-children="manage-article"><?= __('Gestion des articles'); ?></a>
					<ul class="has-children" data-children="manage-article">
						<li><?= $this->Html->link(__('Liste des articles publiés'), ['action' => 'listArticles'], ['class' => ($page == "listArticles") ? "is-active" : ""]); ?></li>
						<li><?= $this->Html->link(__('Créer un article'), ['action' => 'createArticle'], ['class' => ($page == "createArticle") ? "is-active" : ""]); ?></li>
					</ul>
				</li>
				<li>
					<a class="has-parent" data-children="manage-player"><?= __('Gestion des utilisateurs'); ?></a>
					<ul class="has-children" data-children="manage-player">
						<li><?= $this->Html->link(__('Rechercher un utilisateur'), ['action' => 'searchUser'], ['class' => ($page == "searchUser") ? "is-active" : ""]); ?></li>
					</ul>
				</li>
			</ul>

			<p class="menu-label">
				<?= __('Haute administration'); ?>
			</p>
			<ul class="menu-list">
				<li><?= $this->Html->link(__('Gestion du catalogue'), ['controller' => 'Catalog', 'action' => 'index'], ['target' => '_blank']); ?>
				</li>
			</ul>
		</aside>
	</div>
</div>