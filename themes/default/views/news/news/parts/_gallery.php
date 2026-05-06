<?php
/**
 * @var $this NewsController
 * @var $model News
 *
 * Партиал-галерея. Произвольные поля группы CustomfieldGroup name='gallery'
 * рендерятся как медийная сетка (image + caption из name/value).
 */

$group = CustomfieldGroup::model()->find(
    'module_id = :m AND name = :n',
    [':m' => 'news', ':n' => 'gallery']
);
$fields = ($group && method_exists($model, 'getAttributesGroup'))
    ? (array)$model->getAttributesGroup($group->id)
    : [];
?>
<article class="news-gallery pageMainContent">
    <div class="container">
        <header class="news-gallery__header">
            <time class="news-gallery__date" datetime="<?= date('Y-m-d', strtotime($model->date)) ?>">
                <?= Yii::app()->dateFormatter->formatDateTime(strtotime($model->date), 'long', null) ?>
            </time>
            <h1 class="news-gallery__title"><?= CHtml::encode($model->title) ?></h1>
            <?php if ($model->short_text): ?>
                <div class="news-gallery__lead"><?= $model->short_text ?></div>
            <?php endif; ?>
        </header>

        <?php if ($model->full_text): ?>
            <div class="news-gallery__intro"><?= $model->full_text ?></div>
        <?php endif; ?>

        <?php if (!empty($fields)): ?>
            <div class="news-gallery__grid">
                <?php foreach ($fields as $field): ?>
                    <figure class="news-gallery__item" data-code="<?= CHtml::encode($field['code']) ?>">
                        <?php if (!empty($field['image'])): ?>
                            <img class="news-gallery__img"
                                 src="<?= $model->getFieldImageUrl(0, 0, false, $field['image']) ?>"
                                 alt="<?= CHtml::encode($field['name']) ?>">
                        <?php endif; ?>

                        <?php if (!empty($field['gallery'])): ?>
                            <div class="news-gallery__sub">
                                <?php foreach ($field['gallery'] as $img): ?>
                                    <?php if (empty($img['image'])) continue; ?>
                                    <img src="<?= $model->getFieldGalImageUrl(0, 0, false, $img['image']) ?>"
                                         alt="<?= CHtml::encode($img['alt'] ?? '') ?>"
                                         title="<?= CHtml::encode($img['title'] ?? '') ?>">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <figcaption class="news-gallery__caption">
                            <?php if (!empty($field['name'])): ?>
                                <span class="news-gallery__caption-title"><?= CHtml::encode($field['name']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($field['value'])): ?>
                                <span class="news-gallery__caption-text"><?= $field['value'] ?></span>
                            <?php endif; ?>
                        </figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</article>
