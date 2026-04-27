<div class="slide-carousel">
	<?php foreach ($models as $key => $slide): ?>
	    <div class="slide__box">
			<div class="slide__img">
	    		<?= CHtml::image($slide->getImageUrl(), $slide->title, ['tilte' => $slide->title]); ?>
			</div>
	    </div>
	<?php endforeach ?>
</div>
<script>
	$('.slide-carousel').slick({
        fade: true,
		infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
		autoplaySpeed: 5000,
		dots: true,
        arrows: true,
		responsive: [
            {
                breakpoint: 640,
                settings: {
                   arrows: false,
                   dots: true,
                }
            },
        ]
	});
</script>