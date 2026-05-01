<?php $this->beginContent('//layouts/main'); ?>
    <div class="lk-content">
        <div class="container">

            <h2 class="title pad-top">Личный кабинет</h2>
            <div class="lk-box">
                <div class="lk-box__menu">
                    <ul class="lk-menu">
                        <li>
                            <a href="<?= Yii::app()->createUrl('/user/profile/index'); ?>">Профиль</a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->createUrl('/order/user/index'); ?>">История заказов</a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->createUrl('/user/profile/profile'); ?>">Настройки</a>
                        </li>
                        <li>
                            <a href="<?= Yii::app()->createUrl('/user/account/logout'); ?>">Выйти</a>
                        </li>
                    </ul>
                </div>
                <div class="lk-box__content">
                    <?= $content; ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>
