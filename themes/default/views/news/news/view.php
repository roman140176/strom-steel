<?php
/**
 * Отображение для ./themes/default/views/news/news/news.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 *
 * @var $this NewsController
 * @var $model News
 **/
?>
<?php
if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title . ' | Новости Стром Трейд';;
$this->description = $model->meta_description ?: $model->title . '. Актуальные новости Стром Трейд о работе компании, примерах работ и производстве металлоконструкций.';
$this->keywords = $model->meta_keywords;
$this->breadcrumbs = [
    Yii::t('NewsModule.news', 'News') => ['/news/news/index'],
    $model->title
];
?>


<div class="container">
 <?php $this->widget(
                    'bootstrap.widgets.TbBreadcrumbs',
                    [
                        'links' => $this->breadcrumbs,
                    ]
                );?>
</div>
<div class="pageMainContent">
<div class="container">
   <h1 class="page_title"><?= $model->title?></h1>
   <div class="full-text-wrappwer">
       <?= $model->full_text?>
   </div>
</div>
</div>