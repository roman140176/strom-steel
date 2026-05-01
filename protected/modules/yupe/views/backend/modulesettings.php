<?php
$this->breadcrumbs = [
    Yii::t('YupeModule.yupe', 'Modules') => ['settings'],
    $module->name,
];
?>

<h1>
    Настройки "<?= CHtml::encode($module->name); ?>"
</h1>

<br/>

<?php if (is_array($groups) && count($groups)): { ?>
    <?= CHtml::beginForm(
        ['/yupe/backend/saveModulesettings'],
        'post',
        [
            'class' => 'well',
        ]
    ); ?>
    <?= CHtml::hiddenField('module_id', $module->getId()); ?>
    <div class="row">
        <div class="col-sm-8">
            <?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
            <?php $i = 0; ?>
            <?php foreach ((array)$groups as $title => $items): ?>
                <?php $i++; ?>
                <?php
                    $class = '';
                    switch ($title) {
                        case 'Социальные сети':
                            $class = ' soc-panel';
                            break;
                        case 'Реквизиты Компании / Организации':
                            $class = ' req-panel';
                            break;
                        case 'Настройки сайта':
                            $class = ' site-panel';
                            break;
                        default:
                            $class = ' them-panel';
                            break;
                    }
                 ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#group-<?= $i ?>">
                                <?= $title ?>
                            </a>
                        </h4>
                    </div>
                    <div id="group-<?= $i ?>" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?php foreach ((array)$items as $item): ?>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <?= $item ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>


            <?php $this->endWidget(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= CHtml::submitButton(
                Yii::t(
                    'YupeModule.yupe',
                    'Save "{{name}}" module settings',
                    [
                        '{{name}}' => CHtml::encode($module->name)
                    ]
                ),
                [
                    'class' => 'btn btn-primary',
                    'id'    => 'saveModuleSettings',
                    'name'  => 'saveModuleSettings',
                ]
            ); ?>
        </div>
    </div>
    <?= CHtml::endForm(); ?>
<?php } else: { ?>
    <b><?= Yii::t('YupeModule.yupe', 'There is no parameters which you cat change for this module...'); ?></b>
<?php } endif; ?>
