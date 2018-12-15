<div class="columns">
    <div class="column is-3">
    	<div class="box">
    		<aside class="menu">
                <p class="menu-label">
                    Articles correspondant
                </p>
                <ul class="menu-list">
                    <?php
                    foreach($articlesByCategory->articles as $article) {
                        echo $this->Text->insert('<li>:link</li>', [
                            'link' => $this->Html->link($article->title,
                                [
                                    'action' => 'view',
                                    $article->slug
                                ], [
                                    'class' => (($this->request->getParam('pass')[0] == $article->slug) ? 'is-active' : '')
                                ])
                            ]);
                    }
                    ?>
                </ul>
            </aside>
    	</div>
    </div>

    <div class="column">
    	<nav class="breadcrumb is-medium" aria-label="breadcrumbs">
    		<ul>
    			<li><?= $this->Html->link('Articles', ['action' => 'index']); ?></li>
    			<li class="is-active"><a href="#" aria-current="page"><?= $articlesByCategory->name; ?></a></li>
    		</ul>
    	</nav>
    </div>

    <div class="column is-2">
        <?= $this->element('Advertising/160x600'); ?>
    </div>
</div>
