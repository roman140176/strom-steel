
<?php

$this->title = "Отзывы";
$this->description =Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = Yii::app()->getModule('yupe')->siteKeyWords;
// $this->breadcrumbs = $this->getBreadCrumbs();
$this->breadcrumbs = ["Отзывы"];

?>

<div class="page-content">
    <div class="content">
        <?php $this->widget('application.components.MyTbBreadcrumbs', [
                'links' => $this->breadcrumbs,
        ]); ?>
        <h1>Отзывы</h1>

        <?php $this->widget(
            'bootstrap.widgets.TbListView', [
                'dataProvider' => $dataProvider,
                'id' => 'review-box',
                'itemView' => '_item',
                'summaryText'=>"",
                'template'=>'
                    {items}
                    {pager}
                ',
                'itemsCssClass' => 'review-box review-page',
                'htmlOptions' => [
                    'class' => 'review-list-view'
                ],
                'ajaxUpdate'=>true,
                'enableHistory' => false,
                // 'ajaxUrl'=>'GET',
                'pagerCssClass' => 'pagination-box',
                'pager' => [
                    'header' => '',
                    'lastPageLabel' => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    'firstPageLabel' => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                    'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                    'maxButtonCount' => 5,
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'htmlOptions' => [
                        'class' => 'pagination',
                     ],
                ]
            ]
        ); ?>
        <div class="review-form" id="review-form-more">
            <?php $this->widget('application.modules.review.widgets.ReviewWidget'); ?>
        </div>
    </div>
</div>
