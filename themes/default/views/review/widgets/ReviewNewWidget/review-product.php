<?php $this->widget('application.components.FtListView', [
    'id' => 'review-box',
    'itemView' => '_item',
    'dataProvider' => $dataProvider,
    'itemsCssClass' => 'review-box',
    'template' => '{items}{pager}',
    'htmlOptions' => [
        // "class" => "user-specialist"
    ],
    'pagerCssClass' => 'pagination-box',
    'emptyText' => '',
    'emptyTagName' => 'div',
    'emptyCssClass' => 'empty-form',
    'pager' => [
        'class' => 'application.components.ShowMorePager',
        'buttonText' => 'Показать еще',
        'wrapTag' => 'div',
        'htmlOptions' => [
            'class' => 'but'
        ],
        'wrapOptions' => [
            'class' => 'review-pagination'
        ],
    ]
]); ?>