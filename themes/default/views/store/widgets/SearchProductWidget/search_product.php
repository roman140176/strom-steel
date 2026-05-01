                <?php $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        'action' => ['/store'],
                        'method' => 'GET',
                        'htmlOptions' => [
                            'class' => 'sp-form',
                            ]
                    ]
                ) ?>
                    <div class="input-group">
                        <?= CHtml::textField(
                            AttributeFilter::MAIN_SEARCH_QUERY_NAME,
                            CHtml::encode(Yii::app()->getRequest()->getQuery(AttributeFilter::MAIN_SEARCH_QUERY_NAME)),
                            ['class' => 'form-control', 'placeholder' => 'Я хочу купить...', 'autocomplete' =>'off']
                        ); ?>


                            <button type="submit" class="btn-search">
                                <?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/icon/magnifer.svg') ?>
                            </button>

                    </div>
                <?php $this->endWidget(); ?>
