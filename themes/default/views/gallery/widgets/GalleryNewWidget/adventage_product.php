<?php if($models->images) : ?>
    <div class="adventage to-product">
        <?php foreach ($models->images(['order' => 'position ASC']) as $key => $item): ?>
            <div class="adventage__item">
                <div class="adventage__img" style="background-image: url('<?= $item->getImageUrl(); ?>');
                background-repeat: no-repeat;
                background-position: 0 0;
                -webkit-background-size: cover;
                background-size: cover;
                ">

                </div>
                <div class="adventage__info">
                    <div class="adventage__info-name">
                        <?= $item->name ?>
                    </div>
                    <div class="adventage__info-desc">
                        <?= $item->description ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif; ?>