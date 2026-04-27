<div class="slide-box slide-box-carousel">
	<?php foreach ($models as $key => $slide): ?>
	    <div class="slide-box__item">
			<div class="slide-box__img">
	    		<img class="slide_md_img" src="" data-lazy="<?= $slide->getImageUrl(0,0,true,null,'image'); ?>" alt="">
	    		<img class="slide_xs_img" src="" data-lazy="<?= $slide->getImageXsUrl(0,0,true,null,'image_xs'); ?>" alt="">
			</div>
			<div class="slide-box__text">
				<div class="slide-box__name">
					<?= $slide->name_short; ?>
				</div>
				<div class="slide-box__desc">
					<?= $slide->description_short; ?>
				</div>
				<?php if($slide->button_name): ?>
					<div class="slide-box__button">
						<a class="slide-box__link but but-black" href="<?= $slide->button_link; ?>">
							<?= $slide->button_name; ?>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</a>
					</div>
				<?php endif; ?>
			</div>
	    </div>
	<?php endforeach ?>
</div>
