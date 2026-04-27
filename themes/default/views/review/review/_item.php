<div class="review-box__item">
	<div class="review-box__date">
		<?= date("d.m.Y", strtotime($data->date_created)); ?>
	</div>
	<div class="review-box__name">
			<span><?= CHtml::encode( $data->username); ?></span>
		</div>
	<div class="review-box__raiting review-raiting">
		<div class="raiting-list">
            <div class="raiting-list__list ">
                <?php
                    $this->widget('CStarRating', [
                        'name' => "review-input-rating[{$data->id}]",
                        'minRating' => 1,
                        'maxRating' => 5,
                        'value' => $data->rating, // mark 1...5
                        'starWidth'=> 16,
                        'readOnly'=> true,
                        'ratingStepSize' => 1
                    ]);
                    ?>
            </div>
            <div class="raiting-list__text">
            	Оценка: <?= $data->rating; ?>.0
            </div>
        </div>
	</div>
	<?php $strLength = 430; ?>
    <?php if ($strLength < strlen(strip_tags($data->text))) : ?>
		<div class="review-box__description">
			<div class="review-box__description_short">
            	<?= mb_substr(strip_tags($data->text), 0, 430, 'UTF-8') . "..."; ?>
			</div>
            <div class="review-box__description_full hidden">
            	<?= $data->text; ?>
            </div>
        </div>
		<div class="review-box__bottom">
			<a class="review-box__link but-link" data-texthidden="Свернуть отзыв" data-textvisible="Читать весь отзыв" href="#">Читать весь отзыв</a>
		</div>
    <?php else : ?>
        <?= $data->text; ?>
    <?php endif; ?>
</div>
