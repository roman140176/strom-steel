<?php if($pages->childPages) : ?>
	<div class="services-page">
		<?php foreach ($pages->childPages(['condition' => 'status=1', 'order' => 'childPages.order DESC']) as $key => $data) : ?>
			<div class="services-page__item">
				<a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => $data->slug]); ?>">
					<h3>
						<?= $data->title_short; ?>
					</h3>
				</a>
				<?php if($data->childPages) : ?>
					<ul>
						<?php foreach ($data->childPages(['condition' => 'status=1', 'order' => 'childPages.order ASC']) as $key => $item) : ?>
							<li>
								<a href="<?= Yii::app()->createUrl('page/page/view', ['slug' => $item->slug]); ?>">
									<?= $item->title_short; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>