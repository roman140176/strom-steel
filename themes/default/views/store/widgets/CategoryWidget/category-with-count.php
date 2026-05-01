<?php if($tree) : ?>
<div class="filter-block">
    <div class="filter-block__header">
        <span class="cat-name"><?= $this->name?></span>
    </div>
    <div class="filter-block__body">
        <div class="filter-block__content">
                <?php $count = 1; ?>
                <?php foreach ($tree as $item): ?>
                    <?php $id = "category-{$item['id']}" ?>
                    <div class="filter-block__item category-list-filter__item filter-list <?= ($count <= 10) ? '' : 'hidden'; ?>">
                        <input type="checkbox" name="category[]" value="<?= $item['id']; ?>" id="<?= $id ?>" class="checkbox">

                            <label for="<?= $id ?>" class="category-list-filter__name"><?= $item['label']; ?></label>

                    </div>
                    <?php $count++; ?>
                <?php endforeach; ?>
                <?php if($count > 10) : ?>
                    <a class="filter-block__more but-link" href="#">
                        <span data-text="Скрыть">Показать еще (<?= $count - 11 ?>)</span>
                    </a>
                <?php endif; ?>
 </div>

    </div>
</div>
<?php endif; ?>
