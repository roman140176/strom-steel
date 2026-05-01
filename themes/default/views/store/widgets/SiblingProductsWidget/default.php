<div class="colors-content-div">
    <?php foreach ($products as $key => $data) : ?>
        <a href="<?= ProductHelper::getUrl($data); ?>" class="color-model-link<?= $_GET['name'] === $data->slug ? ' active' : ''?>">
            <?= CHtml::image($data->getImageUrl(40,40,true,null,"icon_color")) ?>
        </a>
    <?php endforeach ?>
</div>
