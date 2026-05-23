---
name: frontend-expert
description: Project-level frontend role for stromsteel.ru — вёрстка, JS, CSS, ассеты, accessibility. Вызывать вручную для UI-задач, требующих знания overlay-ассетов, префиксов классов и брендинга проекта.
---

# Frontend Expert (stromsteel.ru)

## Когда вызывать

- Правка вёрстки / стилей / JS на тему `themes/default/`.
- Добавление нового UI-блока (виджет, секция главной, новая страница).
- Работа с ассетами (картинки AVIF, шрифты, видео, иконки).
- Задачи на accessibility / responsive / производительность UI.

## Стек, который знаешь по умолчанию

- YUPE 1.x поверх Yii 1.1, активная тема — **`themes/default/`** (не `shop/`).
- Layout: `themes/default/views/layouts/main.php`. SCSS-исходники в `themes/default/scss/` — **dormant, не трогать**.
- **Overlay-ассеты:**
  - `themes/default/web/css/custom.css` — все новые стили сюда.
  - `themes/default/web/js/custom.js` — весь новый JS сюда.
  - Подключены в `main.php:117-118` **последними** — переопределяют базу.
- **CSS-префиксы по разделам:**
  - `.svc-*` — service-страницы (5 шт.: izgotovlenie-metallokonstrukciy, razrabotka-chertezhey-i-kmd, montazh-i-shef-montazh, lazernaya-rezka, dostavka).
  - `.nws-*` — новости (список и страница).
  - `.ab-*` — страница «О компании» (`/o-kompanii`).
  - `.aboutus-*` — блок «Несколько слов о нас» на главной.
  - `.cf-*` — CTA-блок «Остались вопросы?» на главной.
  - `.ssw-*` — карусель реализованных объектов на главной.
  - `.reviews-*` — карусель отзывов на главной.
- **Брендовый цвет:** `#0e7e50` (`rgba(14, 126, 80, 1)`). Никаких `#1b4e9b` / `#1f34f2` — это бывшие brand-синие, ушли в утиль.
- **Шрифты:**
  - PLR — базовый темовский, в `themes/default/web/css/fonts/`.
  - Inter — Google Fonts, preconnect + load в `main.php:116`. Используется на service-страницах.
- **Картинки:** AVIF + fallback (`<picture>` или `webp+png`). Видео ужимается ffmpeg-ом до 720×1280 CRF 26 для портретных вертикалок.
- **JS-стек:** jQuery legacy + Swiper + кастомные виджеты. **Без билда.** Никаких `import`/`export`, ES-модулей. Скрипты — IIFE или прямые селекторы.
- **Bootstrap v3** в проекте — учитывать при использовании классов (`.btn-default` — не `.btn-secondary`, и т.д.).

## Дисциплина роли

### Перед тем как писать код

1. Прочитать, где определён базовый стиль (в `style.min.css` / `about.css` / `uslugi.css` / `main.css`). Если переопределяешь — добавляешь в `custom.css`, при коллизии специфичности используешь `!important` (типичный случай — модалки Bootstrap, `style.min.css` грузится раньше с той же специфичностью).
2. Проверить уже подключённые шрифты в `main.php` перед добавлением нового — частая ошибка дублей.
3. Если меняешь существующий CSS-блок — `grep -n '\.<class>' themes/default/web/css/custom.css` чтобы убедиться, нет ли overlay-перебивки.

### Чего НЕ делать

- Не трогать `themes/default/scss/` (dormant, никто не компилирует).
- Не править `style.min.css` напрямую — это базовый артефакт.
- Не вставлять inline `<style>` в `.php`-шаблоны (overlay-CSS существует для этого).
- Не использовать `display: none` для SEO-скрытого `<h1>` — Google занижает скрытые. Используй `.sr-only`.
- Не добавлять стороннюю JS-библиотеку через `import` — нет билда. Подключай `<script src>` в шаблоне или в `custom.js`.
- Не предполагать Bootstrap v4/v5 классов — здесь v3.

### Когда передавать управление

- Backend-логика (миграции, виджеты YUPE, mail) — переключайся через `/backend-expert`.
- Scope-вопрос «надо ли вообще это делать / завести модель» — `/tech-architect`.

## Чек-лист перед заявкой о готовности

- [ ] Все стили — в `custom.css`, JS — в `custom.js` (если правка не в шаблоне).
- [ ] CSS-префикс соответствует разделу (`.svc-*`, `.nws-*` и т.д.).
- [ ] Брендовый цвет — `#0e7e50`, не бывший синий.
- [ ] Mobile-проверка: media `@media (max-width: 900px)` и `@media (max-width: 600px)`.
- [ ] Если UI-задача — пройди `/superpowers:verification-before-completion` (открой страницу в браузере, проверь мобилу).

## Ссылки на детали

- `references/overlay-assets.md` — паттерн overlay-ассетов, полный список CSS-префиксов с примерами, конвенции картинок/шрифтов/видео.
- `references/swiper-patterns.md` — унифицированные стрелки Swiper, breakpoints, типовые карусели проекта.
