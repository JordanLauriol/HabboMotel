<div style="height: 100%; width:100%; display: block; overflow-y: auto;">
<?php
    echo $this->Form->create($furniture, ['id' => $furniture->item_ids, "url" => ["controller" => "Catalog", "action" => "editFurnitureById"]]);
        echo $this->Form->hidden("id", ["id" => "id"]);
        echo $this->Form->control("catalog_name", [
            'label' => __('Nom du mobis'), 
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Le nom du mobis défini dans le catalogue.')
            ]
        ]);
        echo $this->Form->label("page_id", "Page ID");
        echo $this->Form->text("page_id", ["id" => "page-id"]);
        echo $this->Form->control("cost_credits", ["label" => "Coût en crédits"]);
        echo $this->Form->control("cost_diamonds", ["label" => "Coût en diamants"]);
        echo $this->Form->control("cost_pixels", ["label" => "Coût en pixels"]);

        echo $this->Form->control("amount", [
            'label' => __('Vendu par unité'),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('La quantité du même mobis achetée par achat.')
            ]
        ]);
        //echo $this->Form->control("vip", ["label" => "Attribue le mobis au VIP"]);
        echo $this->Form->control("limited_sells", [
            "label" => __("(LTD) Déjà vendu"), 
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Le nombre de fois que ce mobis a été acheté par les habbos pour ce LTD. Par défaut laisser 0.')
            ]
        ]);
        echo $this->Form->control("limited_stack", [
            "label" => __("(LTD) Unité mis en vente"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Le nombre de mobis mis en vente pour ce LTD.')
            ]
        ]);
        
        //echo $this->Form->control("offer_active", ["label" => "Etat de l'offre"]);
        echo $this->Form->hidden("furniture.id", ["id" => "furniture-id"]);
        echo $this->Form->control("furniture.is_rare", [
            "label" => __("Ce mobis est-il un rare?"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('0 = par défaut, 1 = Lorsqu\'on double-clic sur ce mobis dans l\'hôtel des détails s\'y affiche en tant que rare')
            ]
        ]);
        echo $this->Form->control("furniture.is_ltd", [
            "label" => __("Ce mobis est-il un LTD?"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('0 = par défaut, 1 = Lorsqu\'on double-clic sur ce mobis dans l\'hôtel des détails s\'y affiche en tant que LTD')
            ]
        ]);
        //echo $this->Form->control("furniture.large_furni", ["label" => "Image large du mobis"]);
        echo $this->Form->control("furniture.type", [
            "label" => __("Type du mobis"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('s = mobis au sol, i = mobis au mur')
            ]
        ]);
        echo $this->Form->control("furniture.width", ["label" => "Taille de la largeur du mobis"]);
        echo $this->Form->control("furniture.length", ["label" => "Taille de la longeur du mobis"]);
        echo $this->Form->control("furniture.stack_height", [
            "label" => _("Hauteur du mobis empilé"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Définit la hauteur ou ce positionnera le mobis qu\'on souhaite empiler sur celui-ci')
            ]
        ]);
        echo $this->Form->control("furniture.variable_heights", [
            "label" => _("Variantes des hauteurs du mobis empilé "),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Définit les hauteurs ou ce positionnera le mobis qu\'on souhaite empiler sur celui-ci')
            ]
        ]);
        echo $this->Form->control("furniture.interaction_type", [
            "label" => __("Type d'interaction"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('default = par défaut, teleport = mobis téléporteur, bed = lit')
            ]
        ]);
        echo $this->Form->control("furniture.interaction_modes_count", [
            "label" => __("Nombre d'états du mobis"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Nombre des différents états du mobis en double cliquant dessus. (Ex: une porte de bar mode = 2 (ouvert/fermé)')
            ]
        ]);
        echo $this->Form->control("furniture.vending_ids", [
            "label" => __("ID des items à consommer"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Exemple: 1,2,3)')
            ]
        ]);
        echo $this->Form->control("furniture.effect_id", [
            "type"  => "text",
            "label" => __("ID de l'effet"),
            'templateVars' => [
                'display_icon' => 'none',
                'help'      => __('Si le mobis est de type effect, attribuez lui un enable.')
            ]
        ]);
        echo $this->Form->control("furniture.can_stack", ["label" => "Autorise l'empilement sur ce mobis"]);
        echo $this->Form->control("furniture.can_sit", ["label" => "Pouvoir s'asseoir sur ce mobis"]);
        echo $this->Form->control("furniture.is_walkable", ["label" => "Pouvoir marcher sur ce mobis"]);
        echo $this->Form->control("furniture.allow_trade", ["label" => "Autoriser l'échange de ce mobis"]);
        echo $this->Form->control("furniture.allow_gift", ["label" => "Autoriser l'envoi de ce mobis en cadeaux"]);
        echo $this->Form->submit("Modifier", ["class" => "button is-primary"]);
    echo $this->Form->end();
?>
</div>