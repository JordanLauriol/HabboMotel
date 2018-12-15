<?php
    echo $this->Form->create($catalogPage);
        echo $this->Form->control('caption', ['label' => 'Nom de la catégorie']);
        echo $this->Form->control('parent_id', ['type' => 'text', 'label' => 'Id de la catégorie parente (-1 = navigation)']);
        echo $this->Form->control('min_rank', ['label' => 'Rang minimum']);
        echo $this->Form->submit('Créér', ['class' => 'button is-primary']);
    echo $this->Form->end();
?>
<br/>
Tu pourras modifier plus de paramètre lorsque tu passeras en mode éditeur sur une catégorie.