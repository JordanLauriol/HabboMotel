<?php if($polls->count() == 0) { ?>
    <div class="notification is-warning" style="margin-bottom: 20px;">
        <?= __("Il n'y a pas eu de sondage dans cet appart pour le moment."); ?>
    </div>
<?php } else { ?>
    <div class="box" style="background: #F5F5F5;">
        <?php foreach($polls as $poll) { ?>
            <article class="media" data-poll="<?= $poll->id; ?>">
                <div class="media-content">
                    <div class="field">
                    <p class="control">
                        <?= $poll->question; ?>
                    </p>
                </div>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <i class="fa fa-thumbs-up has-text-success" aria-hidden="true"></i>&nbsp;<?= $poll->likeCount; ?>
                            </div>
                            <div class="level-item">
                                <i class="fa fa-thumbs-down has-text-danger" aria-hidden="true"></i>&nbsp;<?= $poll->dislikeCount; ?>
                            </div>
                            <div class="level-item">
                                <a><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <small><?= __('Lancé il y a {0}', $this->Time->timeAgoInWords($poll->created)); ?></small>
                            </div>
                        </div>
                    </nav>
                </div>
            </article>
        <?php } ?>
    </div>
<?php } ?>
