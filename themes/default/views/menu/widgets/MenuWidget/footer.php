<?php
Yii::import('application.modules.menu.components.YMenu');

$this->widget(
    'zii.widgets.CMenu',
    [
        'items' => $this->params['items'],
        'htmlOptions' => [
            'id'=>'menu_footer',
            'class'=>'menu_footer'
        ]
    ]
);