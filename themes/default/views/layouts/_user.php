<?php $assetsUrl = Yii::app()->getTheme()->getAssetsUrl(); ?>
<div class="header-lk">
    <?php if (Yii::app()->user->isGuest): ?>
        <div class="header-lk__guest" data-user-dropdown>
            <button type="button" class="header-lk__btn" aria-haspopup="true" aria-expanded="false" aria-label="Личный кабинет">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </button>
            <div class="header-lk__dropdown" role="menu">
                <a class="header-lk__dropdown-item" role="menuitem" href="<?= Yii::app()->createUrl('user/account/login'); ?>">Войти</a>
                <a class="header-lk__dropdown-item" role="menuitem" href="<?= Yii::app()->createUrl('user/account/registration'); ?>">Зарегистрироваться</a>
            </div>
        </div>
    <?php else: ?>
        <div class="header-lk__item">
            <a class="lk-visible-menu" href="<?= Yii::app()->createUrl('user/profile/index'); ?>" aria-label="Профиль">
                <div class="lk-visible-menu__img">
                    <?php if (Yii::app()->user->getProfile()->avatar): ?>
                        <?= CHtml::image(Yii::app()->user->getProfile()->getAvatar(40)) ?>
                    <?php else: ?>
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
