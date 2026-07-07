<?php
/**
 * Выезжающее двухпанельное меню каталога (off-canvas).
 * Слева — список топ-категорий (иконка + название), справа — превью подкатегорий,
 * меняется при наведении/фокусе/клике на категорию. Данные — $tree из CategoryWidget::getMenuList().
 *
 * @var array $tree
 */

/**
 * Сохраняем прежнюю логику внешних ссылок на strom-trade.ru:
 * категория 17 и её подкатегории (кроме 20) живут на strom-trade.ru.
 */
if (!function_exists('steelCatDrawerLink')) {
    function steelCatDrawerLink(array $item, $parentId = null)
    {
        $ext = ((int)$item['id'] === 17) || ((int)$parentId === 17 && (int)$item['id'] !== 20);
        return [
            'url'    => $ext ? 'https://strom-trade.ru' . $item['url'] : $item['url'],
            'target' => $ext ? '_blank' : '_self',
        ];
    }
}

if (!function_exists('steelCatDrawerIcon')) {
    function steelCatDrawerIcon(array $item)
    {
        // Приоритет — инлайн-SVG (те же иконки, что на главной в «Каталог продукции»)
        if (!empty($item['svg_code'])) {
            return $item['svg_code']; // доверенный инлайн-SVG из админки
        }
        // фолбэк — картинка категории
        if (!empty($item['icon'])) {
            $alt = !empty($item['icon_alt']) ? $item['icon_alt'] : $item['label'];
            return CHtml::image($item['icon'], CHtml::encode($alt), ['loading' => 'lazy']);
        }
        // дефолтная иконка-заглушка
        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>';
    }
}
?>
<div class="cat-drawer" id="catalog-drawer" hidden>
    <div class="cat-drawer__overlay" data-cat-close></div>

    <aside class="cat-drawer__panel" role="dialog" aria-modal="true" aria-label="Каталог товаров">
        <div class="cat-drawer__head">
            <span class="cat-drawer__title">Каталог</span>
            <button type="button" class="cat-drawer__close" data-cat-close aria-label="Закрыть меню">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>

        <div class="cat-drawer__body">
            <ul class="cat-drawer__cats" role="tablist" aria-label="Категории каталога">
                <?php $i = 0; foreach ($tree as $cat): $active = $i === 0; $link = steelCatDrawerLink($cat); ?>
                    <li class="cat-drawer__cat<?= $active ? ' is-active' : '' ?>" data-cat="<?= (int)$cat['id'] ?>">
                        <a class="cat-drawer__cat-link" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"
                           role="tab" aria-selected="<?= $active ? 'true' : 'false' ?>" aria-controls="cat-sub-<?= (int)$cat['id'] ?>">
                            <span class="cat-drawer__cat-icon" aria-hidden="true"><?= steelCatDrawerIcon($cat) ?></span>
                            <span class="cat-drawer__cat-name"><?= CHtml::encode($cat['label']) ?></span>
                            <span class="cat-drawer__cat-arrow" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
                            </span>
                        </a>
                    </li>
                    <?php $i++; endforeach; ?>
            </ul>

            <div class="cat-drawer__preview">
                <button type="button" class="cat-drawer__back" data-cat-back>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 6l-6 6 6 6"/></svg>
                    Назад к категориям
                </button>
                <?php $i = 0; foreach ($tree as $cat): $active = $i === 0; $link = steelCatDrawerLink($cat); ?>
                    <div class="cat-drawer__sub<?= $active ? ' is-active' : '' ?>" id="cat-sub-<?= (int)$cat['id'] ?>" data-cat="<?= (int)$cat['id'] ?>" role="tabpanel">
                        <a class="cat-drawer__sub-head" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>">
                            <span><?= CHtml::encode($cat['label']) ?></span>
                            <span class="cat-drawer__sub-all" aria-label="Все товары раздела">→</span>
                        </a>
                        <?php if (!empty($cat['items'])): ?>
                            <ul class="cat-drawer__sub-list">
                                <?php foreach ($cat['items'] as $sub): $sl = steelCatDrawerLink($sub, $cat['id']); ?>
                                    <li><a href="<?= $sl['url'] ?>" target="<?= $sl['target'] ?>"><?= CHtml::encode($sub['label']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="cat-drawer__sub-empty">Перейти в раздел «<?= CHtml::encode($cat['label']) ?>»</p>
                        <?php endif; ?>
                    </div>
                    <?php $i++; endforeach; ?>
            </div>
        </div>
    </aside>
</div>
