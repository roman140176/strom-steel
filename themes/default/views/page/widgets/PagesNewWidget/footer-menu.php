<ul class="menu_footer">
    <?php foreach ($pages as $key => $page): ?>
        <li><a href="<?= Yii::app()->createUrl('/page/page/view', ['slug'=>$page->slug]) ?>">
            <?= $page->title?>
        </a></li>
    <?php endforeach ?>
</ul>
