<?php

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

/* @var $category StoreCategory */

$this->title = Yii::app()->getModule('store')->metaTitle ?: Yii::t('StoreModule.store', 'Catalog');
$this->description = Yii::app()->getModule('store')->metaDescription;
$this->keywords = Yii::app()->getModule('store')->metaKeyWords;
$this->meta_robots = "noindex, nofollow";
  
$this->breadcrumbs = [Yii::t("StoreModule.store", "Catalog")];?>


                                    <div class="container">
                                <?php
                                    $this->widget(
                                        'application.components.MyListView',
                                        [
                                        'dataProvider' => $dataProvider,
                                        'id' => 'product-box',
                                        'itemView' => '//store/product/'.$this->storeItem,
                                        'emptyText'=>'Нет результатов.',
                                        'summaryText'=>"{count} тов.",
                                        'template'=>
                                        '{controls}
                                            {items}
                                            <div class="product-nav">
                                                {pager}

                                            </div>
                                        ',
                                        'sorterDropDown' => [
                                        'name' => 'По названию',
                                        'price_result' => 'Дешевле',
                                        'price_result.desc' => 'Дороже',
                                    ],
                                        'sorterClassUl' => 'sort-box__list',
                                        'sorterHeader' => 'Сортировка',
                                        'itemsCssClass' => Yii::app()->getController('front')->storeItem == "_item-list" ? "product-list horisontal" : "product-list",
                                        'htmlOptions' => [
                                            // 'class' => 'product-box'
                                        ],
                                        'ajaxUpdate'=>true,
                                        'enableHistory' => false,
                                        'pagerCssClass' => 'pagination-box',
                                        'pager' => [
                                        'header' => '',
                                        'lastPageLabel' => '<i class="icon-double_arrow-right" aria-hidden="true"></i>',
                                        'firstPageLabel' => '<i class="icon-double_arrow-left" aria-hidden="true"></i>',
                                        'prevPageLabel' => '<i aria-hidden="true"></i>',
                                        'nextPageLabel' => '<i aria-hidden="true"></i>',
                                        'maxButtonCount' => 5,
                                        'htmlOptions' => [
                                            'class' => 'pagination'
                                        ],
                                    ]
                                        ]
                                    ); ?>
                                    </div>