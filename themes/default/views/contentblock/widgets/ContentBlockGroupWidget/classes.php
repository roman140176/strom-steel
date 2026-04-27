<div class="areas-flex d-flex">
    <?php foreach ($blocks as $key => $block): ?>
        <div class="areas">
            <div class="areas__img">
                <?= file_get_contents($block->getFileUrl()); ?>
            </div>
            <div class="areas__title">
                <?= $block->name?>
            </div>
        </div>
    <?php endforeach ?>
</div>
