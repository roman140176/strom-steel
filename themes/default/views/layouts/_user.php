<div class="header-lk">
        <?php if (Yii::app()->user->isGuest): ?>
            <a class="header-lk__item header-lk__item_login" href="<?= Yii::app()->createUrl('user/account/login'); ?>">
                <span class="input-lk">Вход</span>
                <span class="input-svg">
                    <?= file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/user.svg'); ?>
                </span>
            </a>
            <span class="header-lk__hr">|</span>
            <a class="header-lk__item header-lk__item_registration" href="<?= Yii::app()->createUrl('user/account/registration'); ?>">
                <span>Регистрация</span>
            </a>
            <?php else: ?>
                <div class="header-lk__item">
                    <a class="lk-visible-menu" href="<?= Yii::app()->createUrl('user/profile/index'); ?>">
                        <div class="lk-visible-menu__img">
                            <?php if(Yii::app()->user->getProfile()->avatar) : ?>
                            <?= CHtml::image(Yii::app()->user->getProfile()->getAvatar(40)) ?>
                            <?php else : ?>
                                <?= Yii::app()->user->getProfile()->getFirstLetterName(); ?>
                            <?php endif; ?>
                        </div>
                        <span class="fullName"><?= Yii::app()->user->getProfile()->getFullName(); ?></span>
                    </a>
                    <?php $this->widget('zii.widgets.CMenu', [
                        'items' => $this->userMenu,
                        'htmlOptions' => ['class' => 'user-menu'],
                    ]) ?>
                </div>

        <?php endif ?>
 </div>
