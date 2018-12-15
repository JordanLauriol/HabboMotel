<div class="column is-3">
        <div class="box">
            <aside class="menu">
                <p class="menu-label">
                    <?= __('Trier par catégorie'); ?>
                </p>
                <ul class="menu-list">
                    <?php
                    foreach($categories as $category) {
                        echo $this->Text->insert('<li>:link</li>', [
                            'link' => $this->Html->link($category->name,
                                [
                                    'action' => 'category',
                                    $category->slug
                                ], [
                                    'class' => ((isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == $category->slug) ? 'is-active' : '')
                                ])
                            ]);
                    }
                    ?>
                </ul>

                <p class="menu-label">
                    <?= __('Aujourd\'hui'); ?>
                </p>
                <ul class="menu-list">
                    <?php
                    foreach($today as $article) {
                        echo $this->Text->insert('<li>:link</li>', [
                            'link' => $this->Html->link($article->title,
                                [
                                    'action' => 'view',
                                    $article->slug
                                ], [
                                    'class' => ((isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == $article->slug) ? 'is-active' : '')
                                ])
                            ]);
                    }
                    ?>
                </ul>

                <p class="menu-label">
                    <?= __('Hier'); ?>
                </p>
                <ul class="menu-list">
                    <?php
                    foreach($yesterday as $article) {
                        echo $this->Text->insert('<li>:link</li>', [
                            'link' => $this->Html->link($article->title,
                                [
                                    'action' => 'view',
                                    $article->slug
                                ], [
                                    'class' => ((isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == $article->slug) ? 'is-active' : '')
                                ])
                            ]);
                    }
                    ?>
                </ul>

                <p class="menu-label">
                    <?= __('Cette semaine'); ?>
                </p>
                <ul class="menu-list">
                    <?php
                    foreach($week as $article) {
                        echo $this->Text->insert('<li>:link</li>', [
                            'link' => $this->Html->link($article->title,
                                [
                                    'action' => 'view',
                                    $article->slug
                                ], [
                                    'class' => ((isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == $article->slug) ? 'is-active' : '')
                                ])
                            ]);
                    }
                    ?>
                </ul>

                <p class="menu-label">
                    <?= __('Ce mois-ci'); ?>
                </p>
                <ul class="menu-list">
                    <?php
                    foreach($month as $article) {
                        echo $this->Text->insert('<li>:link</li>', [
                            'link' => $this->Html->link($article->title,
                                [
                                    'action' => 'view',
                                    $article->slug
                                ], [
                                    'class' => ((isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == $article->slug) ? 'is-active' : '')
                                ])
                            ]);
                    }
                    ?>
                </ul>

                <p class="menu-label">
                    <?= __('Cette année'); ?>
                </p>
                <ul class="menu-list">
                    <?php
                    foreach($year as $article) {
                        echo $this->Text->insert('<li>:link</li>', [
                            'link' => $this->Html->link($article->title,
                                [
                                    'action' => 'view',
                                    $article->slug
                                ], [
                                    'class' => ((isset($this->request->getParam('pass')[0]) && $this->request->getParam('pass')[0] == $article->slug) ? 'is-active' : '')
                                ])
                            ]);
                    }
                    ?>
                </ul>
            </aside>
        </div>
    </div>
