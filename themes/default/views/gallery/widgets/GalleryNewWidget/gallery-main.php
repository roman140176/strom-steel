       <div class="interer-box">
                <?php foreach ($lists as $key => $item): ?>

                  <div class="interer-box__item">

                        <span class="interer-box__item__img">
                           <?= CHtml::image($item->previewImage(0)) ?>
                        </span>
                        <span class="interer-box__item__name"><?= $item->name?></span>

                    <?php foreach ($item->images as $k => $value): ?>
                        <?php if ($k == 0): ?>
                            <a href="<?= $value->getImageUrl()?>" class = "fimg" data-fancybox="item-<?= $item->id ?>"></a>
                            <?php else: ?>
                            <a href="<?= $value->getImageUrl()?>" style = "display: none" data-fancybox="item-<?= $item->id ?>"></a>
                        <?php endif ?>
                    <?php endforeach ?>

                </div>
                <?php endforeach ?>

        </div>


