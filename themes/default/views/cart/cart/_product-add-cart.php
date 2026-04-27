<?php 
      $productCurrency = $data->getCurrency();
?>
<div class="product-cart">
    <div class="product-cart__item">
        <div class="pc__main">
            <div class="product-cart__img">
                <?= CHtml::image($data->getImageUrl(100,100,true)) ?>
            </div>
            <div class="product-cart__name">

                    <?= $data->name ?>

            </div>
        </div>
        <div class="pc__attrs">
            <div class="d-flex product-cart__price product-price <?= ($data->hasDiscount()) ? 'product-price-new' : ''; ?>">
                    <span class="product-price__res">
                        <span class="price-result" id="result-price<?= $data->id?>" style="font-size:24px">
                            <?= str_replace('.00', '', number_format($data->getResultPrice(), 2, '.', ' ')); ?>
                        </span>
                        <span class="ruble">
                            <?php if ($productCurrency !== null): ?>
                                <i class="fa fa-<?= mb_strtolower($productCurrency) ?>" aria-hidden="true"></i>
                            <?php else: ?>
                                <i class="fa fa-rub" aria-hidden="true"></i>
                            <?php endif ?></span>
                    </span>
                    <?php if ($data->hasDiscount()) : ?>
                        <span class="product-price__old price-through" style="font-size:18px">
                            <span class="price-old">
                                <?= str_replace('.00', '', number_format($data->getBasePrice(), 2, '.', ' ')); ?>
                            </span>
                            <span class="ruble">
                            <?php if ($productCurrency !== null): ?>
                                <i class="fa fa-<?= mb_strtolower($productCurrency) ?>" aria-hidden="true" style="font-size:12px"></i>
                            <?php else: ?>
                                <i class="fa fa-rub" aria-hidden="true" style="font-size:12px"></i>
                            <?php endif ?></span>
                        </span>
                    <?php endif; ?>
                </div>
            <div class="properties_widget">
                            <?php foreach ($data->getAttributeGroups()as $groupName => $items): ?>
                             <?php foreach ($items as $attribute): ?>
                                <?php if ($attribute->is_typ): ?>
                                     <?php if (AttributeRender::renderValue($attribute, $data->attribute($attribute)) !=null): ?>
                                    <div class="value_type">
                                        <?= AttributeRender::renderValue($attribute, $data->attribute($attribute)); ?>
                                    </div>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if ($attribute->is_visible): ?>
                                    <?php if (AttributeRender::renderValue($attribute, $data->attribute($attribute)) !=null): ?>

                                     <div class="props__wrap">
                                         <div class="key">
                                            <span><?= $attribute->description; ?>:</span>
                                         </div>

                                        <div class="value">
                                            <?= AttributeRender::renderValue($attribute, $data->attribute($attribute)); ?>
                                        </div>
                                     </div>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if ($data->category['id'] == 38 && AttributeRender::renderValue($attribute, $data->attribute($attribute)) != null): ?>
                                    <?php if ($attribute->id == 4 || $attribute->id == 1): ?>
                                    <div class="props__wrap">
                                         <div class="key">
                                            <span>
                                                <?php if ($attribute->id == 4): ?>
                                                    К/н:
                                                    <?php else: ?>
                                                    шгс:
                                                <?php endif ?>
                                            </span>
                                         </div>

                                        <div class="value">
                                            <?= AttributeRender::renderValue($attribute, $data->attribute($attribute)); ?>
                                        </div>
                                     </div>
                                    <?php endif ?>
                                <?php endif ?>
                             <?php endforeach ?>
                            <?php endforeach ?>
                        </div>
        </div>
    </div>
</div>
