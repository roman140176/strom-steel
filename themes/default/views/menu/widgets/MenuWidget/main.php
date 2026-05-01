<?php
Yii::import('application.modules.menu.components.YMenu');

$this->widget(
    'application.components.CMenu',
    [
        'items' => $this->params['items'],
        'htmlOptions' => [
            'id'=>'menu_header',
            'class' => 'menu_header',
        ]
    ]
);