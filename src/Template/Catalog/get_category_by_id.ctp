<?php
    echo '<center>' . $this->Html->link('Supprimer cette catégorie', ['action' => 'removeCategoryById', $catalogPage->id], ['class' => 'button is-danger']) . '</center><br/>';

    echo $this->Form->create($catalogPage, ['id' => $catalogPage->id]);
        echo $this->Form->control('id', ['id' => 'id', 'type' => 'text', 'disabled' => 'disabled', 'label' => 'ID de la catégorie']);
        echo $this->Form->control('caption', ['label' => 'Nom de la catégorie']);
        echo $this->Form->control('parent_id', ['type' => 'text', 'label' => '-1 = Navigation ou ID de la catégorie parent.']);
        echo $this->Form->control('type', ['label' => 'Type DEFAULT']);  
        echo $this->Form->control('icon_color', ['label' => 'Couleur de l\'icone']);    
        echo $this->Form->control('icon_image', ['label' => 'Numéro de l\'icone']);    
        echo $this->Form->control('visible', ['label' => 'Visible dans le catalogue']);   
        echo $this->Form->control('min_rank', ['label' => 'Rang minimum pour voir la catégorie']);  
        echo $this->Form->control('vip_only', ['label' => 'Accessible seulement pour les VIP']);  
        echo $this->Form->control('enabled', ['label' => 'Activé / Désactivé la catégorie']);   
        echo $this->Form->control('page_layout', ['label' => 'Template de la page']);   
        echo $this->Form->control('page_images', ['label' => 'Nom des images (via lien)']);   
        echo $this->Form->control('page_texts', ['label' => 'Textes dans la page']);    
        echo $this->Form->control('extra_data', ['label' => 'Extra data']);    
        echo $this->Form->submit('Modifier', ['class' => 'button is-primary']); 
    echo $this->Form->end();    

?>