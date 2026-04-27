<?php
/** @var array $error */

$code = isset($error['code']) ? (int)$error['code'] : 500;
$isNotFound = $code === 404;

$this->title = $isNotFound
    ? 'Страница не найдена — СТРОМ ТРЕЙД'
    : 'Ошибка ' . $code . ' — СТРОМ ТРЕЙД';

if ($isNotFound) {
    $heading = 'Эта страница ещё не сварена';
    $text    = 'Искомый элемент конструкции не найден. Возможно, адрес указан неверно или страница уехала на монтаж.';
} else {
    $heading = 'Что-то пошло не так';
    $text    = !empty($error['message']) ? $error['message'] : 'На сервере возникла ошибка. Мы уже в курсе и чиним.';
}
?>
<div class="error-page error-page--<?= $code ?>">
    <div class="error-page__container">
        <div class="error-page__visual" aria-hidden="true">
            <svg viewBox="0 0 680 260" class="error-page__svg" role="img" aria-label="<?= $code ?>">
                <defs>
                    <pattern id="errorMetalHatch" patternUnits="userSpaceOnUse" width="18" height="18" patternTransform="rotate(45)">
                        <rect width="18" height="18" fill="#0e7e50"/>
                        <rect x="0" width="9" height="18" fill="#0b6840"/>
                    </pattern>
                </defs>
                <text x="50%" y="72%" text-anchor="middle"
                      font-family="'Arial Black', 'Impact', sans-serif"
                      font-size="240" font-weight="900"
                      fill="url(#errorMetalHatch)"
                      stroke="#0a5635" stroke-width="2"
                      style="letter-spacing:-6px">
                    <?= $code ?>
                </text>
            </svg>
            <div class="error-page__rivets">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
        <h1 class="error-page__title"><?= CHtml::encode($heading) ?></h1>
        <p class="error-page__text"><?= CHtml::encode($text) ?></p>
        <div class="error-page__actions">
            <a href="/" class="error-page__btn error-page__btn--primary">На главную</a>
            <a href="/store" class="error-page__btn error-page__btn--secondary">К каталогу</a>
        </div>
    </div>
</div>
