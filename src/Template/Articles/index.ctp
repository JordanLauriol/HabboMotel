<div class="columns">

    <?= $this->element('Articles/nav'); ?>

    <div class="column">
        <article class="message is-light">
            <div class="message-header">
                <p>Aucun article a été selectionné</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Tu peux parcourir les articles grâce à leurs catégories ou bien leurs dates de publication grâce au menu situé à ta gauche.
            </div>
        </article>
    </div>

    <div class="column is-2">
        <?= $this->element('Advertising/160x600'); ?>
    </div>
</div>
