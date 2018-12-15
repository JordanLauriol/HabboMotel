<h1 class="title is-4 is-uppercase"><?= __("Acheter des diamants"); ?></h1>
<h3 class="subtitle is-6"><?= __("Les diamants sont la monnaie payante de HabboMotel, ils te permettent d'acheter du contenu inédit tels que des rares ou des badges."); ?></h3>

<div class="columns">
	<div class="column is-8">
		<p>
			<?= __("Si tu souhaites en savoir plus sur l'utilité des <b>diamants</b> dans l'hôtel, nous t'invitons à prendre connaissance du fonctionnement de notre économie en {url}.", [
					"url" => $this->Html->link(__("cliquant ici"), ["action" => "index"])
			]); ?>
		</p>
		<br/>

		<div class="content">
			<?= $this->Html->image("shop/room_icon_password.gif"); ?>
			<h3 style="position: absolute; margin-left: 55px; margin-top: -38px;margin-bottom: 10px;">Paiement sécurisé par DEDIPASS</h3>
			<br/><br/>
			<div class="box">
				<?php if($this->request->session()->check('Auth.User.id')) { ?>
				<script src="//api.dedipass.com/v1/pay.js"></script>
				<div data-dedipass="3fd3ce75d7b1577a94b316afd539474d" data-dedipass-custom=""></div>
				<?php } else { ?>
					<div class="notification is-danger"><?= __("Connecte-toi sur ton compte Habbo pour acheter des diamants."); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="column is-4">
		<div class="box">
            <div class="box-title is-gray has-text-centered is-uppercase">
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
</div>