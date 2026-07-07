<?php
/**
 * @var $this NewsController
 * @var $model News
 *
 * Шаблон-конструктор. Подключает один из partial-ов из `parts/`
 * по значению `News.link` (например `longread`, `gallery`, `cards`).
 * В каждом partial-е рендерится разметка под одну группу произвольных полей.
 */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title . ' | Новости Стром Трейд';
$this->description = $model->meta_description ?: $model->title . '. Актуальные новости Стром Трейд о работе компании, примерах работ и производстве металлоконструкций.';
$this->keywords = $model->meta_keywords;
$this->breadcrumbs = [
    Yii::t('NewsModule.news', 'News') => ['/news/news/index'],
    $model->title,
];

$allowed = ['longread', 'gallery', 'cards'];
$tpl = (string)$model->link;

if (!in_array($tpl, $allowed, true)) {
    $this->render('view', ['model' => $model]);
    return;
}
?>

<article class="news-longread">
    <?php if ($model->title_short !== 'breadcrumb') : ?>
    <div class="container">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', ['links' => $this->breadcrumbs]); ?>
    </div>
    <?php endif; ?>
    <?php $this->renderPartial('parts/_' . $tpl, ['model' => $model]); ?>
</article>
