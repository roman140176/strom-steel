<?php $this->breadcrumbs = [
    'Каталог' => '/store',
    'Сравнение'
];
$this->title = 'Сравнение товаров';
?>

<div class="page-content">
    <div class="container">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
        <?php if (empty($products)) : ?>
            <h1>Вы не добавляли товары в сравнение</h1>
        <?php else : ?>
            <div class="product-compare-desc">
                <h1 class="page_title" id="offer-title">Сравнение товаров</h1>
                <!-- <span>В сравнение товаров: <?php //= count($products) ?></span> -->
                <a href="<?= Yii::app()->createUrl('/store/offers/clear') ?>" class="offers-clear">
                    <i class="fa fa fa-times"></i>
                    <span>Удалить список</span>
                </a>
            </div>
            <div id="product-compare">
                <?php Yii::app()->controller->renderPartial('_item', [
                    'products' => $products,
                    'attr' => $attr,
                ]); ?>
            </div>
        <?php endif; ?>
   </div>
</div>
