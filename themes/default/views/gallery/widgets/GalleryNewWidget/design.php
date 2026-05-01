<?php if ($model): ?>
    <div class="design-projects">
        <?php foreach ($model->images as $key => $item): ?>
            <div class="design__item posrel">
                <div class="glass">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
                <?= CHtml::image($item->getImageUrl(320,240,true)) ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>