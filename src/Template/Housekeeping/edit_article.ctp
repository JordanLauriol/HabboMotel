<script src="//cdn.ckeditor.com/4.9.1/full/ckeditor.js"></script>
<section>
	<div class="container">
		<div class="columns">
			
			<?= $this->Element('Housekeeping/menu'); ?>

			<div class="column">
				<?= $this->Flash->render(); ?>
				<div class="box">
					<p class="title is-6"><?= __("Editir un article"); ?></p>
					<p class="subtitle is-6"><?= __("Les actions que vous réalisez dans l'administration sont sauvegardées et consultable par la haute administration."); ?></p>

					<?= $this->Form->create($article); ?>

					<?= $this->Form->label('title', __("Titre de l'article"), ['class' => 'label']); ?>
					<?= $this->Form->control('title', [
						'label' => false,
						'templateVars' => [
							'help' => __("Susciter l'envie de lire l'article avec un titre explicite."),
							'icon' => 'pencil',
							'has_icon' => 'has-icons-left'
						]
					]); ?>

					<?= $this->Form->label('category_id', __('Catégorie'), ['class' => 'label']); ?>
					<?= $this->Form->control('category_id', [
						'label' => false,
						'templateVars' => [
							'help' => __("Choisissez une catégorie appropriée pour faciliter la navigation des Habbos."),
							'icon' => 'sort',
							'has_icon' => 'has-icons-left'
						]
					]); ?>

					<?= $this->Form->label('topstory', __('Image de couverture'), ['class' => 'label']); ?>
					<?= $this->Form->control('topstory', [
						'label' => false,
						'templateVars' => [
							'help' => sprintf(__("Selectionner une image parmis celles ce trouvant %s et coller le lien de l'image."), $this->Html->link("http://flash.habbomotel.com/c_images/topstory/", "http://flash.habbomotel.com/c_images/topstory/", ['target' => '_blank'])),
							'icon' => 'picture-o',
							'has_icon' => 'has-icons-left'
						]
					]); ?>

					<?= $this->Form->label('button', __("Phrase du boutton"), ['class' => 'label']); ?>
					<?= $this->Form->control('button', [
						'label' => false,
						'templateVars' => [
							'help' => __('Exemple: En savoir plus &raquo;'),
							'icon' => 'comment',
							'has_icon' => 'has-icons-left'
						]
					]); ?>

					<?= $this->Form->label('body', __("Contenu de l'article"), ['class' => 'label']); ?>
					<?= $this->Form->control('body', [
						'label' => false
					]); ?>

					<?= $this->Form->submit(__("Editer cet article"), ['class' => 'button is-success']); ?>
					<?= $this->Form->end(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
    CKEDITOR.replace('body');
</script>