<h2 class="title">
	<span>
		<?= $pages->title_short; ?>
	</span>
</h2>

<?php if($pages->childPages) : ?>
	<div class="services-menu">
		<?php foreach ($pages->childPages(['condition' => 'status=1', 'limit' => 8]) as $key => $item) : ?>
			<div class="services-menu__item">
				<div class="services-menu__name">
					<a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => $item->slug]); ?>">
						<svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 9 17" enable-background="new 0 0 9 17" xml:space="preserve">
							<path fill="#FFFFFF" d="M0.997,16.822c-0.116,0.117-0.261,0.177-0.421,0.177c-0.159,0-0.304-0.06-0.42-0.177
								c-0.232-0.234-0.232-0.615,0-0.85L7.551,8.49L0.156,1.008c-0.232-0.235-0.232-0.616,0-0.851c0.232-0.235,0.609-0.235,0.841,0
								l7.815,7.907c0.232,0.235,0.232,0.616,0,0.851L0.997,16.822z"/>
						</svg>
						<span>
							<?= $item->title_short; ?>
						</span>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<div class="services-box__but">
	<a class="but but-yellow" href="<?= Yii::app()->createUrl('page/page/view', ['slug' => $pages->slug]); ?>">
		<?= $butname; ?>
	</a>
</div>