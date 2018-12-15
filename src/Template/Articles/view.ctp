<div class="columns">

    <?= $this->element('Articles/nav'); ?>

    <div class="column">
        <nav class="breadcrumb " aria-label="breadcrumbs" style="margin-bottom: 0.2rem">
            <ul>
                <li><?= $this->Html->link('Articles', ['action' => 'index']); ?></li>
                <li>
                    <?= $this->Html->link($article->category->name, ['action' => 'category', $article->category->slug]); ?>
                </li>
                <li class="is-active"><a href="#" aria-current="page"><?= $this->Text->truncate($article->title, 65); ?></a></li>
            </ul>
        </nav>
        <div class="box">
            <div class="content" style="padding: 15px">
                <p class="title is-5" style="padding-bottom: 8px"><?= $article->title; ?></p>
                <p class="subtitle" style="font-size: 14px"><?= __("Publié il y a"); ?> <?= $this->Time->timeAgoInWords($article->created); ?></p>
                <hr>
                <?= $article->body; ?>

                <!--<p class="title is-6">- <?= $article->player->username; ?></p>-->
            </div>
        </div>

        <p class="title is-4"><?= __('Commentaires'); ?></p>
        <p class="subtitle is-6"><?= __('Nous avons hâte de lire tes ressentis, donc exprime-toi vite !'); ?></p>
        <?php if($this->request->session()->check('Auth.User.id')) { ?>
        <article class="media">
            <figure class="media-left">
                <p class="image" style="margin-top: 15px;">
                    <img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= $this->request->session()->read('Auth.User.figure'); ?>&direction=3&head_direction=3&action=&gesture=sml&size=m&headonly=1">
                </p>
            </figure>
            <div class="media-content">
                    <?= $this->Form->create($comment); ?>
                    <?= $this->Form->hidden('article_id', [
                        'value' => $article->id
                        ]); ?>
                    <?= $this->Form->hidden('player_id', [
                        'value' => $this->request->session()->read('Auth.User.id')
                        ]); ?>
                    <?= $this->Form->control('body', [
                        'label' => false,
                        'placeholder' => __('Ecris ton commentaire..'),
                        'class' => 'textarea'
                        ]); ?>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <?= $this->Form->submit('Poster mon commentaire', ['class' => 'button is-success']); ?>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                    </nav>
            </div>
        </article>
        <?php
        }
        foreach($article->comments as $comment) {
        ?>
        <article id="comment#<?= $comment->id; ?>" class="media comment" data-id="<?= $comment->id; ?>">
            <figure class="media-left">
                <p class="image">
                    <img src="https://avatar-retro.com/habbo-imaging/avatarimage?figure=<?= $comment->player->figure; ?>&direction=3&head_direction=3&action=&gesture=sml&size=m&headonly=1">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <a href="#"><strong><?= $comment->player->username; ?></strong></a>
                        <small>il y a <?= $this->Time->timeAgoInWords($comment->created); ?></small>
                        <br>
                        <?= $comment->body; ?>
                    </p>
                </div>
                <nav class="level is-mobile">

                </nav>
            </div>

            <?php if($comment->player->id == $this->request->session()->read('Auth.User.id') || $this->request->session()->read('Auth.User.rank') > 3) { ?>
            <div class="media-right">
                <a href="#" class="delete is-medium"></a>
            </div>
            <?php } ?>
        </article>

        <?php } ?>
    </div>
</div>
