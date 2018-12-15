<div id="items-<?= $subCategoryId; ?>">
    <p class="title is-6" style="margin-top: 10px"><?= $caption; ?></p>
    <?php
    foreach($furnitures as $item) { ?>
    <div class="item tooltip" item-id="<?= $item->item_ids; ?>" item-parent="<?= $item->page_id; ?>" data-tooltip="<?= $item->furniture->item_name; ?>">
        <img src="https://flash.habbomotel.in/dcr/hof_furni/icons/icons.php?icon=<?= $item->furniture->item_name; ?>">
    </div>
    <?php } ?>
</div>