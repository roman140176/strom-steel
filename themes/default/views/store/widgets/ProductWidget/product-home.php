     <div class="container product-header d-flex">
        <h2 class="page_title no-margin with-link">
          <?= $title?>
          <a class = "red-color-link" href="#">Смотреть все</a>
        </h2>
        <div class="arrow-container"></div>
    </div>
<div class="container container-sale">
    <div class="product-box product-box-carousel">
        <?php foreach ($products as $key => $data) : ?>

        <?php if (current($data->getCategoriesId()) == $linkedCategory): ?>
                <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
            <?php elseif (!empty($data->getCategoriesId())): ?>
                <?php Yii::app()->controller->renderPartial('//store/product/_item', ['data' => $data]) ?>
        <?php endif ?>

        <?php endforeach; ?>
    </div>
</div>