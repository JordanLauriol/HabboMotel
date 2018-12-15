<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="notification is-danger animated shake">
  <button class="delete"></button>
  <span class="icon is-small"><i class="fa fa-exclamation-triangle"></i></span> <span><?= $message; ?></span>
</div>
