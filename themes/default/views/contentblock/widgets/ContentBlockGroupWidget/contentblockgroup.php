<div class="adventages">
    <div class="container adventages-grid">
        <div class="adventages-grid__item item-main">
                <?php $this->widget('application.modules.contentblock.widgets.ContentBlockWidget',[
                'id' => 3
                ]); ?>
        </div>
        <?php foreach ($blocks as $block): ?>
            <div class="adventages-grid__item item-flex">
                <div class="adventages-grid__item-header">
                    <div class="adventages-grid__item-img">
                        <?= CHtml::image($block->getImageUrl(0,0,true,null,"image")) ?>
                    </div>
                    <div class="adventages-grid__item-name">
                        <?= $block->title_short?>
                    </div>
                </div>
                <div class="adventages-grid__item-text">
                    <?= $block->content?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
