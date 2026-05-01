<?php
/**
 * @var $this \yupe\widgets\YShortCuts
 * @var $modules \yupe\components\WebModule[]
 * @var $updates array
 */

?>
<div class="shortcuts">
<div class="shortcut shortcut-clock">
     <canvas id="myClock" width=320 height=320>
        Your browser does not support the HTML5 Canvas.
        </canvas>
</div>
    <?php foreach ($modules as $module): ?>
        <?php if (!$module->getIsShowInAdminMenu() && !$module->getExtendedNavigation()): ?>
            <?php continue; ?>
        <?php endif; ?>
        <?=  CHtml::link($this->render('_view', ['module' => $module, 'updates' => $updates], true), is_string($module->getAdminPageLink()) ? [$module->getAdminPageLink()] : $module->getAdminPageLink(), ['class' => 'shortcut']); ?>
    <?php endforeach; ?>
    <a class="shortcut" href="/backend/modulesettings?module=yupe">
       <div class="cn">
            <i class="shortcut-icon fa fa-cogs" aria-hidden="true" style="color:#000"></i>
        <span class="shortcut-label"><strong>Сайт</strong></span>
       </div>
    </a>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.config-update').on('click', function (event) {
            var $this = $(this);
            event.preventDefault();
            $.post('<?=  Yii::app()->createUrl('/yupe/modulesBackend/configUpdate/')?>', {
                '<?=  Yii::app()->getRequest()->csrfTokenName;?>': '<?=  Yii::app()->getRequest()->csrfToken;?>',
                'module': $(this).data('module')
            }, function (response) {

                if (response.result) {
                    $this.fadeOut();
                    $('#notifications').notify({
                        message: {text: '<?=  Yii::t('YupeModule.yupe','Successful');?>'},
                        type: 'success'
                    }).show();
                }

            }, 'json');
        });
    });
</script>
