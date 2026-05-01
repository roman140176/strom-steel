<?php $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        'action' => ['/store/product/search'],
                        'method' => 'GET',
                        'htmlOptions' => [
                            'class'  => 'sp-form form',
                            'id' => 'yw1'
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
                                <img src="<?= Yii::app()->getTheme()->getAssetsUrl().'/images/icon/magnifer.svg'?>" alt="">
                        </button>

                </div>
<?php $this->endWidget(); ?>