<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="notification is-success animated fadeInDown">
  <button class="delete"></button>
  <span class="icon is-small"><i class="fa fa-check"></i></span> <span><?= $message; ?></span>
</div>
