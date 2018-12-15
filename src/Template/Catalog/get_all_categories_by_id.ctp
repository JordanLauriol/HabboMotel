<script>
Sortable.create(categories, {
    onEnd: function(event) {
        var categories = { };
        
        $("#categories .category").each(function(index) {
            var categoryId = $(this).attr("id");
            categories[index] = categoryId;
        });

        $.get(hostname + "/catalog/setOrderCategoryById", {
            categories: categories,
        })
        .done(function(content) {
        });
    }
});
</script>
<div id="categories">
    <?php
    foreach($categories as $category) { ?>
        <!-- Catégorie -->
        <div id="<?= $category->id; ?>" class="category">
            <a category-id="<?= $category->id; ?>" category-parent="<?= $category->parent_id; ?>" category-caption="<?= $category->caption; ?>" class="panel-block droppable" >
            <img src="https://flash.habbomotel.in/c_images/catalogue/icon_<?= $category->icon_image; ?>.png"> 
                <span><?= $category->caption; ?></span>  
            </a>

            <!-- Sous-catégories -->
            <div class="subCategories" category-id="<?= $category->id; ?>">
                
            </div>
            <!-- Sous-catégories -->
        </div>
        <!-- Catégorie -->
    <?php } ?>
</div>