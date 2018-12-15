<script>
Sortable.create(sortable<?= $categoryId; ?>, {
    onEnd: function(event) {
        var subCategories = { };
        $("#<?= $categoryId; ?> .subCategories a").each(function(index) {
            var subCategoryId = $(this).attr("category-id");
            console.log(index + " - " + subCategoryId);
            subCategories[index] = subCategoryId;
        });

        $.get(hostname + "/catalog/setOrderSubCategoryById", {
            subCategories: subCategories,
        })
        .done(function(content) {
            $("body").prepend(content);
        });
    }
});
</script>
<div id="sortable<?= $categoryId; ?>">
    <?php
    foreach($subCategories as $subCategory) { ?>
    <a category-caption="<?= $subCategory->caption; ?>" category-id="<?= $subCategory->id; ?>" category-parent="<?= $subCategory->parent_id; ?>" class="panel-block droppable">
        <img src="https://flash.habbomotel.in/c_images/catalogue/icon_<?= $subCategory->icon_image; ?>.png"> <span><?= $subCategory->caption; ?></span>
    </a>
    <?php } ?>
</div>