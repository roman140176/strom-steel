<?php
/**
 * @var $this NewsController
 * @var $model News
 *
 * Партиал-карточки. Произвольные поля группы CustomfieldGroup name='cards'
 * рендерятся как карточки (image + name + value + опц. CTA).
 */

$group = CustomfieldGroup::model()->find(
    'module_id = :m AND name = :n',
    [':m' => 'news', ':n' => 'cards']
);
$fields = ($group && method_exists($model, 'getAttributesGroup'))
    ? (array)$model->getAttributesGroup($group->id)
    : [];
?>
<article class="news-cards pageMainContent">
    <div class="container">
        <header class="news-cards__header">
            <time class="news-cards__date" datetime="<?= date('Y-m-d', strtotime($model->date)) ?>">
                <?= Yii::app()->dateFormatter->formatDateTime(strtotime($model->date), 'long', null) ?>
            </time>
            <h1 class="news-cards__title"><?= CHtml::encode($model->title) ?></h1>
            <?php if ($model->short_text): ?>
                <div class="news-cards__lead"><?= $model->short_text ?></div>
            <?php endif; ?>
        </header>

        <?php if ($model->full_text): ?>
            <div class="news-cards__intro"><?= $model->full_text ?></div>
        <?php endif; ?>

        <?php if (!empty($fields)): ?>
            <div class="news-cards__grid">
                <?php foreach ($fields as $field): ?>
                    <div class="news-cards__card" data-code="<?= CHtml::encode($field['code']) ?>">
                        <?php if (!empty($field['image'])): ?>
                            <div class="news-cards__card-image">
                                <img src="<?= $model->getFieldImageUrl(0, 0, false, $field['image']) ?>"
                                     alt="<?= CHtml::encode($field['name']) ?>">
                            </div>
                        <?php endif; ?>

                        <div class="news-cards__card-body">
                            <?php if (!empty($field['name'])): ?>
                                <h3 class="news-cards__card-title"><?= CHtml::encode($field['name']) ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($field['value'])): ?>
                                <div class="news-cards__card-text"><?= $field['value'] ?></div>
                            <?php endif; ?>

                            <?php if (!empty($field['butName']) && !empty($field['butLink'])): ?>
                                <a class="news-cards__card-cta js-button"
                                   href="<?= CHtml::encode($field['butLink']) ?>">
                                    <?= CHtml::encode($field['butName']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</article>
