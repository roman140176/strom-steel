<?php
Yii::import('application.modules.menu.components.YMenu');

$this->widget(
    'application.components.CMenu',
    [
        'items' => $this->params['items'],
        'htmlOptions' => [
            'class'=>'menu_mobile'
        ],
        'submenuHtmlOptions' =>[
        'class' => 'subMenu'
        ]
    ]
);