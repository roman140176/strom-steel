<?php if ($model->images) : ?>
  <div class="our-anonses">
    <?php foreach ($model->images as $key => $item) : ?>
      <div class="our-anonses__item" style="background:<?= $item->percent ? $item->percent : '#1520ed' ?>">
        <div class="anonses__item-image">
          <?= CHtml::image($item->getImageUrl(), '', ['loading'=>'lazy']) ?>
        </div>
        <div class="anonses-flexbox">
          <div class="anonses__item-main">
            <div class="atm__name">
              <?= $item->name ?>
            </div>
            <div class="atm__desc">
              <?= $item->alt ?>
            </div>
          </div>
          <?php if (!empty($item->description)) : ?>
            <div class="anonses__item-price">
              <?= $item->description ?>
            </div>
          <?php endif ?>
        </div>
      </div>
    <?php endforeach ?>

  </div>
<?php endif; ?>