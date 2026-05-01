<?php if($model->images) : ?>
	<div class="home-slider posrel">
		<?php foreach ($model->images(['order' => 'position ASC']) as $key => $item): ?>
			<div class="home-slider__item">
				 <img loading="lazy" class="asyncImage"  data-src="<?= $item->getImageUrl()?>" alt="<?= Yii::app()->getModule('yupe')->siteName?>">
				 <div class="black-line abs" style="<?= $item->id == 1173 ? 'display: none;' : ''; ?>">
				 	<?= $item->name?>
				 </div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif; ?>

