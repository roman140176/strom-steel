<?php
return array(
    'module'    => array(
        'class' => 'application.modules.review.ReviewModule',
    ),
    'import'    => array(),
    'component' => [
        'ReviewManager' => [
            'class' => 'application.modules.review.components.ReviewManager',
        ],
    ],
    'rules'     => array(
        '/review/page/<page>' => 'review/review/show',
        '/review' => 'review/review/show',
    	'/review/create' => 'review/review/create',
    ),
);
