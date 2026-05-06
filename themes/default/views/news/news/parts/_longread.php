<?php
/**
 * @var $this NewsController
 * @var $model News
 *
 * Партиал-лонгрид. Каждое произвольное поле группы id=3 содержит готовый HTML
 * (включая <style>) — выводим как есть.
 *
 * Плейсхолдеры в value (можно использовать в путях к ассетам):
 *   {{baseUrl}}     → Yii::app()->getBaseUrl()              корень сайта
 *   {{themeAssets}} → Yii::app()->getTheme()->getAssetsUrl()  опубликованные ассеты темы
 *                                                            (то, что раньше было $mainAssets)
 */

$replace = [
    '{{baseUrl}}'     => Yii::app()->getBaseUrl(),
    '{{themeAssets}}' => Yii::app()->getTheme()->getAssetsUrl(),
];

$sections = $model->getAttributesGroup(3);
?>
<?php if ($sections): ?>
    <?php foreach ($sections as $section): ?>
        <?= strtr($section['value'], $replace) ?>
    <?php endforeach; ?>
<?php endif; ?>
