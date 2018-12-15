<h1 class="title is-4 is-uppercase"><?= __("Comprendre notre économie"); ?></h1>
<h3 class="subtitle is-6"><?= __("HabboMotel possède une économie structurée et réfléchie pour apporter une réelle valeur aux mobis et badges en circulation dans l'hôtel afin de dynamiser le troc et les casinos."); ?></h3>

<div class="columns">
	<div class="column is-6">
		<div class="box">
			 <div class="box-title is-diamonds has-text-centered is-uppercase">
                <?= __('Les diamants'); ?>
            </div>
            <div class="content">
            	<?= $this->Html->image("shop/diamonds.png", ["align" => "right"]); ?>
           		<?= __("Les <b>diamants</b> sont la monnaie rare de l'hôtel. Ils te permettent d'acquérir du contenu inédit comme des <b>mobis LTD</b>, des <b>badges inédits</b> ou d'adhérer au <b>Habbo CLUB</b>.<br/><br/>
           		Cette monnaie est <b>très difficile</b> à obtenir, car contrairement aux duckets, les diamants ne sont pas distribués lors des animations ou évènements organisés par les staffs.<br/><br/>
           		Le seul moyen d'acquérir des diamants et d'en <b>acheter par le biais de la boutique</b> ou de convertir des duckets en diamants."); ?>
            </div>
		</div>
	</div>

	<div class="column is-6">
		<div class="box">
			 <div class="box-title is-duckets has-text-centered is-uppercase">
                <?= __('Les duckets'); ?>
            </div>

            <div class="content">
            	<?= $this->Html->image("shop/duckets.png", ["align" => "right"]); ?>
            	<?= __("Les <b>duckets</b> sont gagnés en participant aux <b>animations</b> ou aux <b>évènements</b> organisés par les staffs. Ils te permettent d'acquérir des <b>mobis rares</b> ou des <b>badges rares</b>.<br/><br/>
            	Il est également possible de convertir des <b>duckets</b> en <b>diamants</b> pour pouvoir acheter du contenu encore plus rare comme les <b>mobis LTD</b>, les <b>badges inédits</b> ou bien d'adhérer au <b>Habbo CLUB</b> et profiter de tous ses avantages."); ?>
            </div>
		</div>
	</div>
</div>
	<!--<div class="column is-4">
		<div class="box">
            <div class="box-title is-brown has-text-centered is-uppercase">
                <?= __('Mon porte-monnaie'); ?>
            </div>

            <div class="content">
               <?php if($this->request->session()->check('Auth.User.id')) { ?>
               		<p><?= __("Tu possèdes dans ton porte-monnaie:"); ?></p>
	                <p>
	                    <?= $this->Html->image("icons/diamond.png", ["class" => "stars"]); ?>&nbsp; <?= $this->request->session()->read('Auth.User.vip_points'); ?> <?= __("diamants"); ?>
	                </p>
	                <p>
	                    <?= $this->Html->image("icons/duckets.png", ["class" => "stars"]); ?>&nbsp; <?= $this->request->session()->read('Auth.User.activity_points'); ?> <?= __("duckets"); ?>
	                </p>
           		<?php } else { ?>
           			<div class="notification is-danger"><?= __("Connecte-toi sur ton compte Habbo pour accéder à ton porte-monnaie."); ?></div>
           		<?php } ?>
            </div>
        </div>
	</div>
</div>-->