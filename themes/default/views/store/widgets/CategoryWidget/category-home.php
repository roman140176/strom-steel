<div class="category-box">
    <?php $count = 0; ?>
    <?php foreach ($tree as $item): ?>
        <?php $count++; ?>
            <div class="category-box__item">
               <a class="category__image" href="<?= $item['url']; ?>" style="position: relative">
                    <?= CHtml::image($item['icon']) ?>
                        <?php if ($item['count'] > 0): ?>
                        <span class="productCount" style="">
                                <div class="productCount__num"><?= $item['count']?></div>
                                <span class="productCount__name">товаров</span>
                        </span>
                        <?php endif ?>
               </a>
               <div class="category__name">
                    <a href="<?= $item['url']?>">
                        <?= $item['label']?>
                    </a>
                </div>

            </div>
            <?php if ($count === 8){break;} ?>


    <?php endforeach; ?>
 </div>