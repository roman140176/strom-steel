
            <?php foreach ($products as $key => $product) : ?>
                    <div class="product-compare__item" data-remove="<?= $product->id?>">
                            <a href="<?= Yii::app()->createUrl('/store/offers/remove', ['id' => $product->id]) ?>" class="product-compare__remove">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        <div class="product-compare__img">
                            <img src="<?= StoreImage::product($product); ?>" alt="" />
                        </div>
                        <div class="product-compare__info">
                            <div class="product-compare__name">
                                <span>
                                    <?= $product->name?>
                                </span>
                            </div>
                            <div class="properties">
                            <?php foreach ($product->getAttributeGroups()as $groupName => $items): ?>
                             <?php foreach ($items as $attribute): ?>
                                 <?php if ((int)$attribute->group_id == 1): ?>
                                     <div class="key">
                                        <span><?= CHtml::encode($attribute->title); ?>:</span>
                                     </div>
                                    <div class="value">
                                        <?= AttributeRender::renderValue($attribute, $product->attribute($attribute)); ?>
                                    </div>
                                 <?php endif ?>
                             <?php endforeach ?>
                            <?php endforeach ?>

                        </div>
                            <div class="product-compare__price product-price">
                                <span class="product-price__result">
                                    <span class="price-result"> <?= number_format($product->getResultPrice(), 0, '', ' '); ?></span>
                                    <span class="ruble">руб.</span>
                                </span>
                            </div>
                        </div>
                    </div>
            <?php endforeach ?>
