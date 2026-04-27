<div class="childs-pages-links">
    <?php foreach ($pages as $key => $page): ?>
        <div class="item__cp d-flex">
            <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->slug]) ?>" class="item__cp-link">
                <?= $page->title_short?>
            </a>
        </div>
    <?php endforeach ?>
</div>