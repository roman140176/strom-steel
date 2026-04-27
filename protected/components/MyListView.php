<?php
Yii::import('bootstrap.widgets.TbListView');
/**
 * MyListView
 */
class MyListView extends TbListView
{
    public $pager = ['class' => 'booster.widgets.TbPager'];
    public $countProduct = '';

    public $sorterDropDown = [];
    public $sorterClassUl = '';
    public $sorterClassLink = 'sort-box__link';
    public function renderControls()
    {

if ((int)$this->countProduct > 1){
        echo '

            <div class="catalog-controls">
                <div class="catalog-controls__sort"> ';
                    $this->renderSorter();
        echo '
            </div>
                <div class="catalog-controls__res">
                    <div class="template-product">
                        <div data-view="_item" class="template-product__item template-product__grid '.($this->controller->storeItem == "_item" ? "active" : "" ).'">'. file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/store/product-grid.svg') .'
                        </div>
                        <div data-view="_item-list" class="template-product__item template-product__list ' . ($this->controller->storeItem == "_item-list" ? "active" : "" ).'">' . file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/store/product-list.svg') .'
                        </div>
                    </div>
                </div>
            </div>';
    }}

public function renderCountValue()
    {
        echo $this->countValue();
    }

    public function countValue(){


        if((int)$this->controller->storeCountPage > (int)$this->countProduct && (int)$this->countProduct != 0){
            $countPage = $this->countProduct;
        } else {
            $countPage = $this->controller->storeCountPage;
        }

        $valueH = '<div class="catalog-controls__label-pr-count">
            Товаров на странице <strong>1-'.$countPage.' из '.$this->countProduct.'</strong>
        </div>';

        return $valueH;
    }
    public function renderCountPage()
    {
        echo $this->countPage();
    }

    public function countPage()
    {
        $pageList = [12,24,48];
        $pageL = "<div class='countItem-box'>
            <div class='countItem-box__header'>Товары на странице:</div>
            <div class='countItem-box__preview'><span>".(int)$this->controller->storeCountPage."</span></div>
            <span class='carets'>"
            .file_get_contents('.'. Yii::app()->getTheme()->getAssetsUrl() . '/images/store/caret.svg').
            "</span>
            <div class='countItem-box__body countItem-wrapper'>";

        foreach ($pageList as $key => $data) {
            $pageL .= "<div class='countItem-wrapper__link " . (($data == $this->controller->storeCountPage) ? 'active' : '') . "' data-count='{$data}'>{$data}</div>";
        }
        $pageL .= "</div></div>";

        return $pageL;

    }


    /**
     * Формирование структуры сортировки по названию, цене
     */
   public function renderSorter()
    {
        $id = $this->htmlOptions['id'];
        $defaultSort = Yii::app()->getModule('store')->getDefaultSort('');
        $defaultSort = trim(preg_replace('/[^a-zA-Z](DESC|ASC|)/', ' ', $defaultSort));

        echo CHtml::openTag('div', ['class'=>$this->sorterCssClass])."\n";
            echo $this->sorterHeader===null ? Yii::t('zii','Sort by: ') : $this->sorterHeader;
            echo CHtml::openTag('ul', ['class' => $this->sorterClassUl])."\n";
            foreach ($this->sorterDropDown as $key => $item) {
                if($defaultSort == trim(preg_replace('/[^a-zA-Z](desc|asc|)/', ' ', $key))){
                    echo CHtml::openTag('li', ['class' => $this->sorterClassLink . ' active', 'data-href' => '?sort='.$key]);
                } else {
                    echo CHtml::openTag('li', ['class' => $this->sorterClassLink, 'data-href' => '?sort='.$key]);
                }
                    echo $item;
                echo CHtml::closeTag('li');
            }
            echo CHtml::closeTag('ul');
            echo $this->countPage();
        echo CHtml::closeTag('div');


    }

}
