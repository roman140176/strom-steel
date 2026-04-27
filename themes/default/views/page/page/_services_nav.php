<?php
/**
 * Горизонтальная навигация по 5 страницам услуг (тёмный тон, иконки).
 *
 * @var $current string  slug текущей страницы — для подсветки активного таба
 */

$tabs = [
    [
        'slug' => 'izgotovlenie-metallokonstrukciy',
        'label' => 'Изготовление<br>металлоконструкций',
        'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21"/></svg>',
    ],
    [
        'slug' => 'razrabotka-chertezhey-i-kmd',
        'label' => 'Разработка<br>чертежей и КМД',
        'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>',
    ],
    [
        'slug' => 'montazh-i-shef-montazh',
        'label' => 'Монтаж<br>и шеф-монтаж',
        'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437"/></svg>',
    ],
    [
        'slug' => 'lazernaya-rezka',
        'label' => 'Лазерная<br>резка',
        'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>',
    ],
    [
        'slug' => 'dostavka',
        'label' => 'Доставка',
        'icon' => '<svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>',
    ],
];
?>
<nav class="svc-nav" aria-label="Услуги">
    <div class="svc-nav__inner">
        <?php foreach ($tabs as $tab) :
            $isActive = !empty($current) && $current === $tab['slug'];
            $url = Yii::app()->createUrl('page/page/view', ['slug' => $tab['slug']]);
            ?>
            <a href="<?= $url ?>" class="svc-nav__tab<?= $isActive ? ' is-active' : '' ?>"<?= $isActive ? ' aria-current="page"' : '' ?>>
                <span class="svc-nav__ico"><?= $tab['icon'] ?></span>
                <span class="svc-nav__label"><?= $tab['label'] ?></span>
            </a>
        <?php endforeach ?>
    </div>
</nav>
