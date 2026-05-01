<?php if ($category) : ?>
	<div class="main-categories">
		<?php foreach ($category as $key => $data) : ?>

				<div class="categories__item">
					<a class="categories__item-image" href="<?= $data->getCategoryUrl()?>">
						<?php if (empty($data->image)): ?>
	               				<?= CHtml::image(Yii::app()->getTheme()->getAssetsUrl() . '/images/slider.jpg') ?>
	               			<?php else: ?>
							<picture>
				                <source data-webp="<?= $data->getImageUrlWebp(300,300,true)?>"  type="image/webp">
				                <img data-src="<?= $data->getImageUrl(300,300,true)?>" alt="<?= $data->name?>">
	               			</picture>
						<?php endif ?>
					</a>
					<div class="categories__info-box">
						<div class="categories__item-name">
							<a href="<?= $data->getCategoryUrl()?>">
								<?= $data->name?>
							</a>
					    </div>

					</div>
				</div>

		<?php endforeach; ?>
	</div>
<?php endif; ?>