# Expert Role Skills Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Создать 3 manual-only project-level Claude-скилла (`/frontend-expert`, `/backend-expert`, `/tech-architect`) в `.claude/skills/`, прошитых конвенциями stromsteel.ru.

**Architecture:** Каждый скилл — директория с `SKILL.md` (точка входа, ≤ 200 строк) и подпапкой `references/` (детальные выжимки). Frontmatter YAML с `name`/`description` — стандартный формат Claude Code skills. Никакого кода — это инструкции для ассистента.

**Tech Stack:** Markdown + YAML frontmatter. Никаких билд-инструментов, никаких тестов в коде. Verification = smoke-вызовы в новой сессии Claude Code.

**Spec:** [docs/superpowers/specs/2026-05-22-expert-role-skills-design.md](../specs/2026-05-22-expert-role-skills-design.md) (status: draft → awaiting implementation plan).

**Структура итогового результата:**

```
.claude/skills/
├── frontend-expert/
│   ├── SKILL.md
│   └── references/
│       ├── overlay-assets.md
│       └── swiper-patterns.md
├── backend-expert/
│   ├── SKILL.md
│   └── references/
│       ├── yupe-conventions.md
│       └── mail-and-forms.md
└── tech-architect/
    ├── SKILL.md
    └── references/
        ├── yagni-checklist.md
        └── hardcode-vs-cms.md
```

**Отклонение от спеки:** объединили 8 reference-файлов в 6 (DRY). `image-upload.md` слит в `mail-and-forms.md` (упоминание нюанса), `assets-pipeline.md` слит в `overlay-assets.md`. Если по факту использования какой-то reference вырастет > 150 строк — отколется обратно.

---

## Task 1: Создать структуру директорий

**Files:**
- Create: `.claude/skills/frontend-expert/references/.gitkeep`
- Create: `.claude/skills/backend-expert/references/.gitkeep`
- Create: `.claude/skills/tech-architect/references/.gitkeep`

- [ ] **Step 1: Создать директории**

```bash
mkdir -p .claude/skills/frontend-expert/references
mkdir -p .claude/skills/backend-expert/references
mkdir -p .claude/skills/tech-architect/references
```

- [ ] **Step 2: Verify**

```bash
find .claude/skills -type d
```

Expected output:
```
.claude/skills
.claude/skills/frontend-expert
.claude/skills/frontend-expert/references
.claude/skills/backend-expert
.claude/skills/backend-expert/references
.claude/skills/tech-architect
.claude/skills/tech-architect/references
```

---

## Task 2: Frontend-expert SKILL.md

**Files:**
- Create: `.claude/skills/frontend-expert/SKILL.md`

- [ ] **Step 1: Написать SKILL.md**

Создать файл `.claude/skills/frontend-expert/SKILL.md` с точно таким содержимым:

````markdown
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

1. Прочитать, где определён базовый стиль (в `style.min.css` / `about.css` / `uslugi.css` / `main.css`). Если переопределяешь — добавляешь в `custom.css`, при коллизии специфичности используешь `!important` (типичный случай — модалки Bootstrap, `style.min.css` грузится первее с той же специфичностью).
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
- [ ] Брендовый цвет — `#0e7e50`, не bywidth-синий.
- [ ] Mobile-проверка: media `@media (max-width: 900px)` и `@media (max-width: 600px)`.
- [ ] Если UI-задача — пройди `/superpowers:verification-before-completion` (открой страницу в браузере, проверь мобилу).

## Ссылки на детали

- `references/overlay-assets.md` — паттерн overlay-ассетов, полный список CSS-префиксов с примерами, конвенции картинок/шрифтов/видео.
- `references/swiper-patterns.md` — унифицированные стрелки Swiper, breakpoints, типовые карусели проекта.
````

- [ ] **Step 2: Verify frontmatter и структура**

```bash
head -4 .claude/skills/frontend-expert/SKILL.md
grep -c "^## " .claude/skills/frontend-expert/SKILL.md
wc -l .claude/skills/frontend-expert/SKILL.md
```

Expected:
- frontmatter с `name: frontend-expert` и `description:` в одну строку.
- Минимум 6 `## ` секций.
- Файл < 200 строк.

---

## Task 3: Frontend reference — overlay-assets.md

**Files:**
- Create: `.claude/skills/frontend-expert/references/overlay-assets.md`

- [ ] **Step 1: Написать файл**

Создать `.claude/skills/frontend-expert/references/overlay-assets.md`:

````markdown
# Overlay assets: pattern, prefixes, pipeline

## Паттерн overlay-ассетов

`themes/default/web/css/custom.css` и `themes/default/web/js/custom.js` — единственные «живые» ассеты, в которые мы пишем. Подключены в `themes/default/views/layouts/main.php:117-118` **последними** — переопределяют базу без необходимости править артефакты.

**Все новые стили / JS** идут сюда. Создание дополнительных CSS-файлов оправдано только если стилей очень много И они изолированы по странице (пример: `about.css` для `/o-kompanii` — регистрируется через `clientScript->registerCssFile()` в самой view).

## Каталог CSS-префиксов

| Префикс | Раздел | Файлы |
|---|---|---|
| `.svc-*` | Service-страницы (5 шт.) | `themes/default/views/page/page/{slug}.php` |
| `.nws-*` | Новости (виджет на главной + страница списка) | `themes/default/views/news/widgets/LastNewsWidget/lastnewswidget.php`, `themes/default/views/news/news/{index,_item}.php` |
| `.ab-*` | Страница «О компании» (`/o-kompanii`) | `themes/default/views/page/page/o-kompanii.php` + `web/css/about.css` |
| `.aboutus-*` | Блок «Несколько слов о нас» на главной | `themes/default/views/homepage/hp/page.php` |
| `.cf-*` | CTA «Остались вопросы?» на главной | `themes/default/views/homepage/hp/page.php` |
| `.ssw-*` | Карусель реализованных объектов | `themes/default/views/page/page/works.php` (или хомпейдж секция) |
| `.reviews-*` | Карусель отзывов на главной | `themes/default/views/review/widgets/ReviewCarouselWidget/carousel.php` |

**Правило:** новый блок — новый префикс. Не пересекать (например, `.ab-card` и `.svc-card` — две разные реальности).

## Брендинг

- Зелёный: `#0e7e50` / `rgba(14, 126, 80, 1)`. Также синонимы в коде: `var(--hdr-accent)`, `var(--svc-green)`.
- Светлый зелёный с прозрачностью (для фонов hover): `rgba(14, 126, 80, 0.08)` или `0.14`.
- Тёмный зелёный (для CTA-фона на «О компании»): `#0a5e3b` (`--ab-green-deep`).
- Серый icon-bg в шапке: `var(--hdr-icon-bg)` (≈ `#f2f4f8`).

**Анти-брендовые цвета** (остались с легаси, не использовать в новом коде):
- `#1b4e9b` — старый «корпоративный синий».
- `#1f34f2` — старый «акцентный синий».

## Шрифты

- **PLR** — базовый темовский, файлы в `themes/default/web/css/fonts/`. Подключён через `font-face` где-то в `style.min.css`. Используется как `font-family: 'PLR', sans-serif` или через base.
- **Inter** — Google Fonts, подключён в `main.php:116`:
  ```php
  Yii::app()->getClientScript()->registerCssFile('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
  ```
  Используется на service-страницах (`.svc-page` родительский селектор задаёт `font-family: 'Inter'`).

**Не подключай новые шрифты без необходимости.** Уже есть два — обычно хватает.

## Картинки

- **Формат:** AVIF + fallback. Паттерн:
  ```html
  <picture>
    <source srcset="image.avif" type="image/avif">
    <img src="image.png" alt="...">
  </picture>
  ```
- **Расположение:** `themes/default/web/images/` (общетемовские), `public_html/uploads/` (загружаемые админом), `themes/default/web/images/page/about/` (страничные иллюстрации).
- **Адаптив:** mobile-варианты — отдельный `<source media="(max-width: 900px)" srcset="hero-mob.jpg">`. На `/dostavka` пример: `hero.webp` (desktop) + `hero.png` (fallback) + `hero-mob.jpg` (mobile).

## Видео

- Расположение: `public_html/uploads/video/{N}.mp4`, постеры — `public_html/uploads/video/posters/{N}.webp`.
- **Сжатие портретных вертикалок:** ffmpeg до 720×1280 CRF 26 (`-vf "scale=720:1280"  -crf 26 -preset slow`).
- На главной 5 вертикальных видео в Swiper-карусели + лайтбокс (виджет «Производство в видео»).
- **Видеофон на главной** (`themes/default/views/homepage/hp/page.php`) — тоже ужат до этих параметров.

## Accessibility

- Скрытый `<h1 class="sr-only">` на главной — `homepage/hp/page.php`. Класс `.sr-only` определён в `custom.css`. **Не** `display: none` — Google занижает.
- `alt`-атрибуты обязательны для всех `<img>` (задача в backlog: пройтись по магазинному каталогу, см. memory `project_stromsteel_tasks`).
- `aria-label` для иконочных кнопок (магнифер, корзина, избранное).

## Модалки

5 ID-скоупов с унифицированными крестиками (`themes/default/web/css/custom.css`):
`#CallbackEmail`, `#CallbackFormEmail`, `#CallbackProduct`, `#callbackModal`, `#reviewZayavkaModal`.

Стиль `.close`: круг 36×36, фон `#f2f4f8` → hover `#0e7e50` с белой иконкой. **С `!important`**, т.к. `style.min.css` грузится первее с той же специфичностью.

Новую модалку с тем же стилем — просто допиши ID в групповой селектор в `custom.css`.

## Cookie-баннер

Реализован в `custom.js` (инжектит HTML в `<body>`) + стили в `custom.css`. Управление через `localStorage`. Ссылки на «Политику» — `/politika-konfidencialnosti` (новая вкладка).
````

- [ ] **Step 2: Verify**

```bash
wc -l .claude/skills/frontend-expert/references/overlay-assets.md
grep -c "^## " .claude/skills/frontend-expert/references/overlay-assets.md
```

Expected: ~100-130 строк, ≥ 8 секций.

---

## Task 4: Frontend reference — swiper-patterns.md

**Files:**
- Create: `.claude/skills/frontend-expert/references/swiper-patterns.md`

- [ ] **Step 1: Написать файл**

````markdown
# Swiper patterns

Swiper.js — единственный карусельный движок в проекте. Подключён глобально (CSS + JS) в `main.php`.

## Унифицированные стрелки

Все стрелки навигации в проекте — единый стиль через `::before` с `mask-image`.

**Эталон:** `.objects-carousel`. Применяется к стрелкам:
- `.home-banner-swiper-prev/-next` (баннер на главной).
- `.home-videos-swiper-prev/-next` (карусель видео).
- `.reviews-swiper__prev/__next` (отзывы).
- `.ssw-swiper-prev/-next` (объекты).
- `.svc-*` карусели на service-страницах.

**CSS-паттерн** (упрощённо, см. `custom.css`):

```css
.home-banner-swiper-prev,
.home-banner-swiper-next,
.reviews-swiper__prev,
.reviews-swiper__next,
.objects-carousel .swiper-button-prev,
.objects-carousel .swiper-button-next {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: #fff;
  border: 1px solid #d9dde8;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all .2s ease;
}

.<...>-prev::before,
.<...>-next::before {
  content: '';
  width: 16px;
  height: 16px;
  background: #212121;
  mask-image: url('../images/arrow.svg');
  mask-repeat: no-repeat;
  mask-position: center;
}

.<...>-prev:hover,
.<...>-next:hover {
  background: #0e7e50;
}

.<...>-prev:hover::before,
.<...>-next:hover::before {
  background: #fff;
}
```

**Добавляешь новую карусель** → дописываешь её селекторы в групповой блок «стрелки» в `custom.css`, не пиши параллельный стиль.

## Breakpoints (slidesPerView)

Типовой паттерн для карточек (см. карусель отзывов):

```js
new Swiper('.reviews-swiper', {
  slidesPerView: 1.1,
  spaceBetween: 16,
  breakpoints: {
    576:  { slidesPerView: 1.6 },
    768:  { slidesPerView: 2.2 },
    992:  { slidesPerView: 3.2 },
    1200: { slidesPerView: 3.5 },
    1440: { slidesPerView: 4.5 },
  },
  navigation: {
    nextEl: '.reviews-swiper__next',
    prevEl: '.reviews-swiper__prev',
  },
});
```

Дробные `slidesPerView` — намеренно: показывает «обрезанную» следующую карточку, намекая на скролл.

## Скрытие стрелок на узких

На ≤1100px стрелки обычно скрываются (карусель свайпается пальцем):

```css
@media (max-width: 1100px) {
  .reviews-swiper__prev,
  .reviews-swiper__next { display: none; }
}
```

## Типовые карусели в проекте

| Карусель | Контейнер | Виджет / шаблон |
|---|---|---|
| Баннер на главной | `.home-banner-swiper` | `themes/default/views/homepage/hp/page.php` (inline) |
| Видео на главной | `.home-videos-swiper` | `themes/default/views/homepage/hp/page.php` |
| Реализованные объекты | `.ssw-swiper` | `themes/default/views/page/page/works.php` |
| Отзывы | `.reviews-swiper` | `themes/default/views/review/widgets/ReviewCarouselWidget/carousel.php` |
| `.objects-carousel` | разные | служебный legacy |

## Лайтбокс

Для карусели видео и галерей service-страниц — **fancybox** (легаси). Подключён глобально. Атрибут `data-fancybox="<group>"` на ссылках.
````

- [ ] **Step 2: Verify**

```bash
wc -l .claude/skills/frontend-expert/references/swiper-patterns.md
```

Expected: ~80-110 строк.

---

## Task 5: Commit frontend-expert

- [ ] **Step 1: Stage и commit**

```bash
git add .claude/skills/frontend-expert/
git commit -m "$(cat <<'EOF'
feat(skills): /frontend-expert project role

SKILL.md + 2 references (overlay-assets, swiper-patterns).
Manual-only активация, без auto-trigger.

Co-Authored-By: Claude Opus 4.7 (1M context) <noreply@anthropic.com>
EOF
)"
```

- [ ] **Step 2: Verify**

```bash
git log -1 --stat
```

Expected: коммит с 3 файлами в `.claude/skills/frontend-expert/`.

---

## Task 6: Backend-expert SKILL.md

**Files:**
- Create: `.claude/skills/backend-expert/SKILL.md`

- [ ] **Step 1: Написать SKILL.md**

````markdown
---
name: backend-expert
description: Project-level backend role for stromsteel.ru — YUPE/Yii1, модели, миграции, контроллеры, виджеты, mail, кэш, urlRules. Вызывать вручную для серверных задач, требующих знания YUPE-специфики и проектных нюансов.
---

# Backend Expert (stromsteel.ru)

## Когда вызывать

- Изменения моделей / миграций / контроллеров YUPE-модулей.
- Добавление виджетов, mail-шаблонов, форм с reCAPTCHA.
- Работа с поведениями (`ImageUploadBehavior`, `CustomFieldBehavior`, `DCategoryTreeBehavior`).
- Правка `urlRules`, конфигов, настроек модулей.
- Кэш, очистка, performance backend.

## Стек, который знаешь по умолчанию

- **YUPE 1.x** поверх **Yii 1.1**. PHP 7.4/8.x.
- **Структура модуля:** `protected/modules/<name>/` → `models/`, `controllers/`, `views/`, `widgets/`, `install/migrations/`, `WebModule.php`.
- **Активные модули:** `news`, `page`, `mail`, `feedback`, `review`, `store`, `category`, `image`, `gallery`, `homepage`, `contentblock`, `blog`, `comment`, `menu`, `user`, `yupe` (core), `payment`, `order`, `delivery`, `coupon`, `cart`, `callback`, `favorite`, `notify`, `dictionary`, `queue`, `rbac`, `payler`, `robokassa`, `amocrm`, `offer`, `_order` (legacy).
- **Конфиги:**
  - `protected/config/main.php` — Yii main + **`urlRules`** живут здесь.
  - `protected/config/params.php` — глобальные параметры: `recaptchaEnabled => !YII_DEBUG`.
  - `protected/config/modules/<name>.php` — оверрайды модулей.
  - `protected/config/db.php` — БД.
- **Миграции:** имя `m{YYMMDD}_{HHMMSS}_{name}.php` или `m{6chars}_{name}.php` (легаси). Лежат в `protected/modules/<name>/install/migrations/`. Запуск:
  ```bash
  php protected/yiic.php migrate --module=<name>
  ```
- **Mail-шаблоны:** **файловые** (`themes/default/views/mail/mail/_*.php`). НЕ через `raiseMailEvent` с админ-событием — по решению user'а (хотя БД-событие `forma-v-uslugah` id=4 существует, оно не подключено). Существующие шаблоны: `_main.php`, `_calc-price.php`, `_laser-calc.php`, `_send-drawing.php`, `_email.php`, `_email-order.php`.
- **Mail flow:** From `info@stromsteel.ru` (хардкод в виджетах), To `info@strom-trade.ru` (из БД `yupe_yupe_settings.param_name='email'`). Разные домены — норма (сайт vs корпоративная почта юрлица).
- **Behaviors-нюансы:**
  - `ImageUploadBehavior` (extends `FileUploadBehavior`): в backend-контроллере отдельная обработка не нужна — сам цепляет `CUploadedFile::getInstance($model, 'image')` в `beforeValidate` и обрабатывает чекбокс `delete-file`. **НО** в виджетах форм (`ServicesFormsWidget`, `CalcPriceWidget`) — пришлось руками вызывать `getInstance($model, 'file')` (см. `references/mail-and-forms.md`).
  - `CustomFieldBehavior` подключён к `News` (порт из autoclass). Сериализует `MyCustomField` POST в колонку `data` (longtext). Подробнее — memory `project_stromsteel_custom_fields`.
- **Админка:** `http://stromsteel.loc/backend/login`, логин `admin`, пароль `adminadmin`.
- **БД:** локальная — user `stromtrade_stil` / `mkbDt9&l`, dbname `stromtrade_stil`. Таблица настроек — `yupe_yupe_settings` (НЕ `yupe_settings`).
- **Кэш:** `protected/runtime/cache/*.bin` (~120+ файлов), `protected/runtime/views/` (скомпилированные view), `public_html/assets/{hash}/` (CAssetManager).

## Дисциплина роли

### Перед тем как писать код

1. **Перед миграцией** — проверить `protected/modules/<name>/install/migrations/` на дубль или ранее применённую похожую миграцию.
2. **Перед моделью** — `grep -n "behaviors" protected/modules/<name>/models/<Model>.php` чтобы знать, какие behaviors уже навешаны.
3. **Перед mail-шаблоном** — посмотреть существующие `_main.php` / `_calc-price.php` / `_laser-calc.php` и взять структуру оттуда.
4. **Перед urlRule** — править `protected/config/main.php`, не модуль. Обращай внимание на whitelist для backend-actions (типичный паттерн `/backend/<action:(AjaxUpload...|ElFinder...|...)>`).
5. **Перед формой** — обернуть в `if (Yii::app()->params['recaptchaEnabled']) { ... }` любую reCAPTCHA-логику.

### Чего НЕ делать

- Не плодить `raiseMailEvent` если рядом уже есть файловый шаблон в `themes/default/views/mail/mail/`.
- Не использовать `findBySql($_GET[...])` без parameter binding — это SQL-инъекция.
- Не хранить хардкодные пароли / API-ключи в php-файлах в репо (только `.env.*` / `params-local.php`, которые в `.gitignore`).
- Не «исправлять» расхождение mail-доменов `stromsteel.ru` vs `strom-trade.ru` — это намеренно.
- Не править `style.min.css` или другие фронтовые артефакты из backend-задачи — переключайся на `/frontend-expert`.
- Не запускать `migrate` на проде без `--dry-run`-проверки локально + ручного бэкапа.

### Когда передавать управление

- UI / стили / JS — `/frontend-expert`.
- «Нужно ли вообще делать / завести модель vs хардкод» — `/tech-architect`.

## Чек-лист перед заявкой о готовности

- [ ] Миграция имеет рабочий `down()` (откат не падает).
- [ ] Все SQL-параметры через binding или `Yii::app()->db->createCommand()->bindValue()`.
- [ ] reCAPTCHA-логика в формах обёрнута во флаг.
- [ ] Если правил `urlRules` — почистил кэш роутера: `rm protected/runtime/cache/*.bin` (или через `yiic.php cache flush`).
- [ ] Если SQL-изменения — пройди `/superpowers:verification-before-completion` (миграция вверх и вниз, идемпотентность данных).

## Ссылки на детали

- `references/yupe-conventions.md` — миграции, urlRules, структура модулей, behaviors, кэш.
- `references/mail-and-forms.md` — mail flow, шаблоны, виджеты форм, ImageUpload gotcha в виджетах, reCAPTCHA-флаг.
````

- [ ] **Step 2: Verify**

```bash
head -4 .claude/skills/backend-expert/SKILL.md
wc -l .claude/skills/backend-expert/SKILL.md
```

Expected: валидный frontmatter, < 200 строк.

---

## Task 7: Backend reference — yupe-conventions.md

**Files:**
- Create: `.claude/skills/backend-expert/references/yupe-conventions.md`

- [ ] **Step 1: Написать файл**

````markdown
# YUPE / Yii 1.1 conventions for stromsteel.ru

## Структура модуля

```
protected/modules/<name>/
├── <Name>Module.php или WebModule.php   # init модуля
├── components/                          # хелперы модуля
├── controllers/
│   ├── <Name>Controller.php             # фронт
│   └── <Name>BackendController.php      # админка
├── models/
│   └── <Name>.php                       # AR-модель
├── views/
│   ├── <name>/                          # фронт-views
│   ├── <name>Backend/                   # backend-views
│   └── widgets/
├── widgets/
│   └── <Name>Widget.php
├── install/
│   └── migrations/
│       └── m{YYMMDD}_{HHMMSS}_{name}.php
└── messages/                            # переводы
```

## Миграции

**Имя файла:** `m{YYMMDD}_{HHMMSS}_{name}.php` (новый стиль) или `m{6chars}_{name}.php` (легаси).

Пример: `m461218_120000_review_add_preview_text.php`.

**Класс:**

```php
class m461218_120000_review_add_preview_text extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{review}}', 'preview_text', 'TEXT NULL AFTER text');
    }

    public function safeDown()
    {
        $this->dropColumn('{{review}}', 'preview_text');
    }
}
```

**Запуск:**

```bash
php protected/yiic.php migrate --module=<name>           # все непримененные модуля
php protected/yiic.php migrate up 1 --module=<name>       # на 1 вперёд
php protected/yiic.php migrate down 1 --module=<name>     # откат 1
php protected/yiic.php migrate mark <migrationName>       # пометить применённой без выполнения
```

**Префикс таблиц:** `{{table}}` — Yii разворачивает в `yupe_table` (или другой префикс из `db.php`).

## urlRules

**Где:** `protected/config/main.php` секция `components → urlManager → rules`.

```php
'urlManager' => [
    'urlFormat' => 'path',
    'showScriptName' => false,
    'rules' => [
        '/' => 'homepage/hp/index',
        '/news' => 'news/news/index',
        '/news/<slug:[a-z0-9\-]+>' => 'news/news/view',
        // backend whitelist для AJAX-экшенов
        '/backend/<action:(AjaxUploadTinyMCE5|ElFinderConnection)>' => 'yupe/backend/<action>',
        // ...
    ],
],
```

**Whitelist для backend:** custom backend-actions (типа `AjaxUploadTinyMCE5`, `ElFinderConnection`) **должны быть прописаны явно** иначе 404.

**После изменения urlRules** — очистить кэш роутера:
```bash
rm protected/runtime/cache/*.bin
```

## Behaviors

Подключаются в `behaviors()` модели:

```php
public function behaviors()
{
    return [
        'imageUpload' => [
            'class' => 'yupe\components\behaviors\ImageUploadBehavior',
            'attributeName' => 'image',
            'uploadPath' => Yii::app()->getModule('news')->uploadPath . '/preview',
            'imageNameCallback' => function() { return md5(microtime() . uniqid()); },
        ],
        'customField' => [
            'class' => 'yupe\components\behaviors\CustomFieldBehavior',
            'attributeName' => 'data',
        ],
    ];
}
```

**Важно:** `ImageUploadBehavior` (и его родитель `FileUploadBehavior`) сами цепляют `CUploadedFile::getInstance($model, 'image')` в `beforeValidate`. В обычных backend-controller-ах ничего дополнительно делать не надо. **Исключение** — виджеты форм, где модель не из обычного admin-цикла (см. `mail-and-forms.md`).

## Custom Fields (порт из autoclass)

Подключён behavior `CustomFieldBehavior` к `News`. Колонка `data` longtext в таблице, рендер партиала в админ-форме:

```php
<?php $this->renderPartial('application.modules.yupe.views.customFieldBehavior._my-custom-field', ['model' => $model]); ?>
```

Форма обязательно `enctype='multipart/form-data'`.

**API на фронте:**
- `$model->getAttributesGroup($groupId)` — массив полей одной группы
- `$model->getAttributesValue($code)` — одно поле по code
- `$model->getFieldImageUrl($w, $h, $crop, $name)` — thumbnailer URL
- `$model->geFieldImageWebp(...)` — конвертация в webp on-the-fly (опечатка `ge` оставлена — так в autoclass).

## TinyMCE5 + elFinder

- Виджет: `protected/modules/yupe/widgets/editors/TinyMCE5.php`.
- Зарегистрирован в `WebModule::$visualEditors` как `tinymce5` рядом с `redactor`.
- **Дефолт:** `redactor`. Переключение per-module через `yupe_yupe_settings.param_name='editor'` в БД или UI «Настройки модуля».
- Actions в `BackendController`: `AjaxUploadTinyMCE5`, `ElFinderConnection`. Whitelist в `urlRules`.

## Кэш

- `protected/runtime/cache/*.bin` — Yii cache + роутер.
- `protected/runtime/views/` — скомпилированные view.
- `public_html/assets/{hash}/` — CAssetManager (ассеты модулей и виджетов).
- Чистить: `rm protected/runtime/cache/*.bin && rm -rf protected/runtime/views/*` (при правке urlRules / конфигов).
- При смене темовских ассетов — может понадобиться `rm -rf public_html/assets/*` чтобы Yii перегенерил кэшированные пути.

## Доступы локально

- Админка: `/backend/login` → admin / adminadmin
- БД: `stromtrade_stil` / `mkbDt9&l` / db `stromtrade_stil`
- Таблица настроек: **`yupe_yupe_settings`** (двойной `yupe`, частая ошибка).
````

- [ ] **Step 2: Verify**

```bash
wc -l .claude/skills/backend-expert/references/yupe-conventions.md
```

Expected: ~140-180 строк.

---

## Task 8: Backend reference — mail-and-forms.md

**Files:**
- Create: `.claude/skills/backend-expert/references/mail-and-forms.md`

- [ ] **Step 1: Написать файл**

````markdown
# Mail flow и формы (виджеты)

## Mail flow

- **From:** `info@stromsteel.ru` — захардкожен в виджетах:
  - `protected/modules/mail/widgets/ServicesFormsWidget.php:21`
  - `protected/modules/mail/widgets/CalcPriceWidget.php:18`
- **To:** `info@strom-trade.ru` — берётся из `Yii::app()->getModule('yupe')->email`. Хранится в `yupe_yupe_settings` (`param_name='email'`), редактируется в админке: YUPE → Настройки → Admin Email.

**Why:** домены разные намеренно. Сайт + SMTP-отправитель — `stromsteel.ru`, корпоративная почта юрлица «ООО СТРОМ ТРЕЙД» — `strom-trade.ru`. **Не «исправлять» расхождение** без явной просьбы user'а.

## Файловые шаблоны (не raiseMailEvent)

Все mail-шаблоны — обычные `.php`-файлы в `themes/default/views/mail/mail/`:

| Файл | Используется |
|---|---|
| `_main.php` | `ServicesFormsWidget` — формы «Напишите нам» на 3 service-страницах |
| `_calc-price.php` | `CalcPriceWidget` — стандартный калькулятор-форма |
| `_laser-calc.php` | Inline AJAX-калькулятор на `lazernaya-rezka.php`. Опциональные строки фильтруются через `array_filter` |
| `_send-drawing.php` | Модалка «Прислать чертёж» на главной |
| `_email.php`, `_email-order.php` | Базовые YUPE-mail'ы |

**Решение по архитектуре** (зафиксировано): админ-событие `forma-v-uslugah` (id=4) в БД с шаблоном `services-napisat-nam` **существует, но не используется**. Виджеты шлют через файловые шаблоны напрямую. Не переключай на `raiseMailEvent` без явной просьбы.

## Виджеты форм — устройство

### `ServicesFormsWidget`

Используется на service-страницах. Подключается через:

```php
$this->widget('application.modules.mail.widgets.ServicesFormsWidget', [
    'subject' => 'Заявка с страницы изготовления металлоконструкций',
    'view' => '_main',
]);
```

Модель — `ServicesFormsModel` (lives in widget). Поля: `name`, `phone`, `email`, `message`, `file`, `agree`, `verifyCode`.

### `CalcPriceWidget`

Аналогично, но шаблон `_calc-price.php` и доп. поля калькулятора.

### AJAX-калькулятор на `lazernaya-rezka.php`

Не виджет — POST-handler в самой view. Сабмит через `fetch` без перезагрузки. Inline-alert (success/error). Использует `_laser-calc.php` как mail-шаблон.

## **Подводный камень: getInstance в виджетах**

`ImageUploadBehavior` в обычных моделях сам цепляет файл. **Но** в моделях виджетов (`ServicesFormsModel`, `CalcPriceModel`) была бага — файл всегда был `null`.

**Исправление** (уже применено):

```php
// в Widget::run() после $model->attributes = $_POST[...]
$file = CUploadedFile::getInstance($model, 'file');
if ($file) {
    $model->file = $file;
    // ...
    $mailer->AddAttachment($file->tempName, $file->name);
}
```

Также `allowEmpty: true` для атрибута `file` в `rules()` модели (раньше был `false` — форма требовала файл, теперь опционально).

**Когда добавляешь новый виджет формы с файлом** — обязательно вызывай `getInstance` вручную.

## reCAPTCHA-флаг

В `protected/config/params.php`:

```php
'recaptchaEnabled' => !(defined('YII_DEBUG') && YII_DEBUG),
```

На локалке (`YII_DEBUG=true`) капча не выводится и не валидируется. На проде — включается автоматически.

**Использование во view / модели:**

```php
if (Yii::app()->params['recaptchaEnabled']) {
    echo $this->widget('CCaptcha', [...], true);
}
```

В `beforeValidate()` модели:

```php
public function beforeValidate()
{
    if (!Yii::app()->params['recaptchaEnabled']) {
        $this->verifyCode = 'skip';
    }
    return parent::beforeValidate();
}
```

Все формы (`ServicesFormsModel`, `CalcPriceModel`, AJAX-handler в `lazernaya-rezka.php`) уже учитывают флаг.

## Lazy-load Google reCAPTCHA

В `custom.js` есть lazy-loader Google reCAPTCHA (загружается по первому фокусу на формы / при scroll до формы). Это снижает LCP на главной. Если добавляешь новую форму с капчей — убедись, что lazy-loader её триггерит (см. селекторы внутри `custom.js`).
````

- [ ] **Step 2: Verify**

```bash
wc -l .claude/skills/backend-expert/references/mail-and-forms.md
```

Expected: ~100-140 строк.

---

## Task 9: Commit backend-expert

- [ ] **Step 1: Stage и commit**

```bash
git add .claude/skills/backend-expert/
git commit -m "$(cat <<'EOF'
feat(skills): /backend-expert project role

SKILL.md + 2 references (yupe-conventions, mail-and-forms).
Прошиты mail flow domains, ImageUploadBehavior gotcha в виджетах,
recaptchaEnabled-флаг, дефолт editor=redactor.

Co-Authored-By: Claude Opus 4.7 (1M context) <noreply@anthropic.com>
EOF
)"
```

- [ ] **Step 2: Verify**

```bash
git log -1 --stat
```

Expected: коммит с 3 файлами в `.claude/skills/backend-expert/`.

---

## Task 10: Tech-architect SKILL.md

**Files:**
- Create: `.claude/skills/tech-architect/SKILL.md`

- [ ] **Step 1: Написать SKILL.md**

````markdown
---
name: tech-architect
description: Project-level architect role for stromsteel.ru — scope-решения, YAGNI, влияние на бизнес, технический долг. Вызывать вручную перед решениями «что делать / что не делать» и при оценке нетривиальной фичи.
---

# Tech Architect (stromsteel.ru)

## Когда вызывать

- Прежде чем браться за новую фичу — оценить, нужно ли её вообще делать.
- Решение «хардкод в шаблоне vs CMS-модель».
- Технический долг — куда вкладываться, что отложить.
- Скоупинг задачи: > 1 файла — стоит ли разбивать.
- Когда есть несколько способов решения и непонятно, какой выбрать.

## Стек / контекст, который знаешь по умолчанию

- **Проект:** YUPE 1.x на Yii 1.1, продакшен (stromsteel.ru), один разработчик + редактор-нерегулярный.
- **Сложившийся паттерн** — **hardcode-в-шаблонах** для важных структурированных блоков главной (FAQ, «о нас», stat-плашки, реализованные объекты). НЕ CMS-модели. Это сознательный компромисс: editor — дольше, devops — дешевле. См. `references/hardcode-vs-cms.md`.
- **Юр. данные, телефоны, графики работы** — захардкожены в шаблонах. Не предлагать вынос в админку / .env без явной просьбы.
- **Контент-заглушки** (статистика «15+/200+/10дн», тексты «о нас» с lorem-вкраплениями) — нормально для релиза. Не блокировать выкатку отсутствием реальных цифр.
- **Memory** (`/home/roman/.claude/projects/-home-roman-sites-www-stromsteel-loc/memory/`):
  - `project_stromsteel_tasks` — текущий список «сделано / отложено / не делали».
  - `project_stromsteel` — общий контекст.
  - `project_svc_pages` — сервисные страницы.
  - `project_stromsteel_custom_fields` — custom fields + news constructor.
  - `project_stromsteel_mail` — mail flow.
  - **Перед предложением фичи** — свериться с `project_stromsteel_tasks`, не отложена ли она user'ом.

## Дисциплина роли (YAGNI ruthlessly)

### 5 вопросов перед новой фичей

1. **Это просили или я додумываю?** Если додумываю — стоп, спросить.
2. **Что произойдёт, если НЕ делать?** Если ничего критичного — отложить.
3. **Можно ли решить хардкодом в шаблоне?** Часто — да. См. `references/hardcode-vs-cms.md`.
4. **Есть ли уже похожее** в `themes/default/views/`, `themes/default/web/css/custom.css`, `protected/modules/`? — переиспользуем, не плодим.
5. **Это блокирует следующую задачу, или edge-case?** Edge-case → бэклог.

### Чего НЕ делать

- **Не предлагать «фреймворк-переход»** (Symfony / Laravel / headless CMS). Бизнес работает, переход — это месяцы, оплачивает себя на 5+ лет горизонте, которого у проекта может не быть.
- **Не плодить новые модули YUPE**, если хватает виджета или partial. Модуль = таблица + контроллер + миграции + админ-UI + i18n. Виджет — это `.php`-файл.
- **Не предлагать абстракции «на вырост»** — если сейчас один сценарий, делаем под него. Второй сценарий — рефакторим.
- **Не предлагать вынос телефонов / юрданных в админку** — user уже отказался от этого осознанно.
- **Не предлагать "переехать на новый Bootstrap / Yii 2 / PHP 8.x strict types"** — большой риск, низкий ROI.

### Обязательная связка с superpowers

- **Перед предложением скоупа фичи** → `/superpowers:brainstorming`. Это обязательно для любой не-тривиальной фичи (≥ 2 файла touched).
- **Перед декомпозицией большой задачи на план** → `/superpowers:writing-plans`.
- **При оценке готовности фичи** → `/superpowers:verification-before-completion`.

### Когда передавать управление

- Конкретная реализация вёрстки — `/frontend-expert`.
- Конкретная реализация миграции / виджета — `/backend-expert`.
- Архитект остаётся в режиме «что и почему», не «как».

## Типовые рекомендации

| Запрос | Дефолтная реакция |
|---|---|
| «Заведи отдельный модуль для FAQ» | Сначала спросить: хватит ли виджета с хардкод-данными? |
| «Вынеси юр.данные в админку» | Уже решено НЕТ. Уточнить, есть ли новые основания. |
| «Перепиши на Vue / React фронт» | Нет билда в проекте — это большой переход. Сначала обосновать ROI. |
| «Сделай ещё один кэш-слой» | Чем не устраивает существующий runtime/cache? Замерить. |
| «Добавь TypeScript» | Билд-системы нет. Не предлагать без явной просьбы. |
| «Добавь тесты на …» | Нет тестового харнесса для PHP в проекте. Стоит ли поднимать ради 1 фичи? |

## Чек-лист перед заявкой о готовности (декомпозиция / scoping)

- [ ] Прошёл `/superpowers:brainstorming` для фичи.
- [ ] Проверил `project_stromsteel_tasks` — нет ли отложенной похожей.
- [ ] Ответил на 5 YAGNI-вопросов.
- [ ] Если задача > 1 файла — предложил разбить.
- [ ] Указал, что НЕ входит в скоуп (явно).

## Ссылки на детали

- `references/yagni-checklist.md` — расширенный чек-лист, типичные анти-паттерны проекта.
- `references/hardcode-vs-cms.md` — когда верстаем в шаблоне, когда заводим модель.
````

- [ ] **Step 2: Verify**

```bash
head -4 .claude/skills/tech-architect/SKILL.md
wc -l .claude/skills/tech-architect/SKILL.md
```

Expected: валидный frontmatter, < 200 строк.

---

## Task 11: Tech-architect reference — yagni-checklist.md

**Files:**
- Create: `.claude/skills/tech-architect/references/yagni-checklist.md`

- [ ] **Step 1: Написать файл**

````markdown
# YAGNI checklist — stromsteel.ru

## Полный лист 5 вопросов

Перед тем как сказать «давайте сделаем X» — пройти все 5:

### 1. Это просили или я додумываю?

- Если **просили явно** (текст user'а содержит) — продолжаем.
- Если **подразумевается из контекста** — спросить уточнение. Не реализовывать «по умолчанию».
- Если **я додумал по аналогии** — стоп. Скорее всего лишнее.

### 2. Что произойдёт, если НЕ делать?

- **Сайт сломается / форма не работает** → делаем срочно.
- **Хуже SEO / UX, но работает** → планируем, не блокируем релиз.
- **Эстетика / «на вырост»** → бэклог. Спросить, важно ли сейчас.
- **Никто не заметит** → не делаем.

### 3. Можно ли решить хардкодом в шаблоне?

В этом проекте — часто **да**. См. `hardcode-vs-cms.md`. Главное правило:

- Контент **не меняется чаще раза в квартал** → хардкод.
- Контент **меняется реже раза в месяц** → партиал + комментарий «менять здесь».
- Контент **меняется регулярно или несколькими людьми** → CMS-модель / админ-форма.

### 4. Есть ли уже похожее?

Прежде чем создавать новое — `grep`:

```bash
grep -rn "<keyword>" themes/default/views/ themes/default/web/css/custom.css protected/modules/ 2>/dev/null | head -20
```

Если нашёл — переиспользуй (с поправкой на специфику), не дублируй.

### 5. Это блокирует следующую задачу, или edge-case?

- **Блокирует** → приоритет высокий.
- **Edge-case** (0.1% пользователей) → бэклог.
- **Improvement без блокировки** → планируем после блокеров.

## Типовые анти-паттерны в этом проекте

### Anti-pattern 1: «Заведём отдельный модуль под X»

Часто хватает:
- **Виджета** — `protected/modules/<existing>/widgets/<Name>Widget.php`.
- **Partial** — `themes/default/views/<area>/_<name>.php`.
- **Хардкода в шаблоне** — если X на 1 странице.

Модуль = миграции + контроллер + админка + i18n. Создавай ТОЛЬКО если X:
- имеет свою БД-сущность,
- редактируется через админку,
- используется на нескольких страницах,
- имеет свои URL.

### Anti-pattern 2: «Вынесем в .env / параметры»

Юрданные, телефоны, графики — уже хардкод по решению user'а. Не предлагай инверсию без явной просьбы.

Что **оправдано** в `params.php`:
- Флаги среды (`recaptchaEnabled`, `YII_DEBUG`).
- API-ключи / секреты (в `params-local.php`, который в `.gitignore`).
- Технические лимиты (max upload, timeouts).

### Anti-pattern 3: «Абстракция на вырост»

«Сейчас у нас один FAQ-блок на главной, но если потом понадобится 5 — давай заведём модель `FaqItem`».

Сейчас **один** → делаем хардкод. Понадобится **5** → за 30 минут вынесем в модель. До этого момента не тратим время.

### Anti-pattern 4: «Перепишем на свежий framework»

Yii 1.1 EOL, но:
- Сайт работает.
- Yii 2 — другой framework, не upgrade.
- Symfony / Laravel — полный переписан, месяцы.
- ROI отрицательный на горизонте < 5 лет.

Не предлагать без явной просьбы business case.

### Anti-pattern 5: «Добавим тесты»

Тестового харнесса для PHP в проекте нет. Поднимать PHPUnit ради 1 фичи — overkill.

Что **оправдано** при поднятии тестов:
- Появилась критическая бизнес-логика (расчёт цен / скидок / интеграция с банком).
- Регрессии стали частыми.
- Есть несколько разработчиков.

Сейчас — нет.

## Когда переключаться на specialist'ов

- Frontend (вёрстка, CSS, JS, ассеты) → `/frontend-expert`.
- Backend (миграции, виджеты, mail, urlRules) → `/backend-expert`.
- Skill ремаппит сам себя только если запрос ушёл за пределы scope'а — иначе work in role.
````

- [ ] **Step 2: Verify**

```bash
wc -l .claude/skills/tech-architect/references/yagni-checklist.md
```

Expected: ~100-130 строк.

---

## Task 12: Tech-architect reference — hardcode-vs-cms.md

**Files:**
- Create: `.claude/skills/tech-architect/references/hardcode-vs-cms.md`

- [ ] **Step 1: Написать файл**

````markdown
# Hardcode vs CMS — когда что выбирать

## Контекст

В проекте сложилось решение: важные структурированные блоки **верстаются прямо в `.php`-шаблонах**, а не подтягиваются из CMS-моделей. Это **сознательный** компромисс — редактор пишет дольше (нужен dev), но devops и архитектура — дешевле (нет лишних моделей, миграций, админ-форм).

## Правило выбора

| Условие | Решение |
|---|---|
| Контент меняется **< 1 раза в квартал** | Хардкод в шаблоне |
| Контент меняется **раз в 1-3 месяца** | Хардкод + комментарий `<!-- меняется здесь: ... -->` |
| Контент меняется **раз в месяц** или чаще | Хардкод + структура (массив в начале view) |
| Контент **редактируется не-разработчиком** регулярно | CMS-модель или Page + RTE |
| Контент **уникален для каждого экземпляра** (новость, объект) | CMS-модель |
| Контент **повторяется на нескольких страницах** + редактор хочет менять | `ContentBlock` модуль |

## Что в проекте — хардкод

- **«Несколько слов о нас»** на главной (`themes/default/views/homepage/hp/page.php`) — раньше тянулось из `Page::model()->findByPk(4)['short_content']` + jQuery «Читать весь текст / Скрыть». **Отказались** — стат-блоки, эйбрау, заголовок, абзацы, 4 feature-карточки — всё в шаблоне. Если просят менять текст — ищем в `page.php`, не в админке.
- **Stat-плашки на главной** («15+ лет», «200+ объектов», «10 дн») — хардкод. Заглушки реальных цифр user уточнит позже, но это не блокер релиза.
- **FAQ-блок (планируется)** — будет хардкод в шаблоне + FAQPage schema.org. Q&A user даёт списком.
- **«Реализованные объекты»** на главной — Swiper-карусель из БД `Page` с `parent_id=3`, но текст карточки рендерится с парсингом полей (см. `project_stromsteel.md` про неконсистентные поля `year`/`previewtext`/`promo`). Гибрид: модель есть, но без админ-формы под структуру — редактор пишет в существующие поля.
- **Юрданные / телефоны / адрес** — хардкод во всех точках:
  - `themes/default/views/layouts/_header.php`
  - `themes/default/views/layouts/_header-mobile.php`
  - `themes/default/views/layouts/_footer.php`
  - `themes/default/views/page/page/contacts.php`
- **Schema.org JSON-LD** — `LocalBusiness` глобально в `main.php`, `Product`+`Breadcrumb` в `store/product/view.php`. Часы работы хардкод (Пн-Пт 09:00-18:00).
- **Cookie-баннер** — HTML инжектится из `custom.js`, ссылки на политику — `href="#"` (страница ещё не создана, заменить позже).

## Что в проекте — CMS

- **Новости** (модуль `news`) — модель + админ-форма. **Плюс** custom fields (порт из autoclass) — для конструктора лонгрид/галерея/cards.
- **Отзывы** (модуль `review`) — модель с `preview_text` (краткий для карусели) + `text` (полный для модалки) + `image` (аватар).
- **Каталог товаров** (`store`/`category`) — стандартная CMS, миграции добавили `svg_code` для inline-SVG иконок категорий.
- **Страницы** (`page`) — для контактов, политики, договоров оферты. Контент через RTE.
- **Custom fields** (порт из autoclass) — подключены к News, переиспользуемы для любой модели.

## Гибриды (намеренные)

### Page-как-данные, шаблон-как-структура

«Реализованные объекты» используют `Page` с `parent_id=3`, но шаблон `works.php` сам решает, что показывать в каком чипе. Поля используются не по семантическому имени:
- `year` = описание поставки.
- `previewtext` = регион.
- `promo` = тип продукции (иногда HTML).
- `short_content` = пусто.

**Это нормально для текущего сценария** — редактор пишет «куда влезет», шаблон причёсывает. Если объём редактирования вырастет — будем заводить `ProjectModel`.

### Раньше CMS, потом hardcode

Иногда обратное движение: было `Page::findByPk(4)`, стало хардкод. Причина — редактор не пользовался админкой, разработчик правил БД руками. Дешевле просто хардкодить.

## Когда сворачивать на CMS

Если за неделю user 2+ раза просит поменять текст одного и того же блока — **признак того, что блок пора в CMS**. Спросить: «Этот блок будете часто менять? Может, вынести в админку?»

Не выносить **превентивно**.

## Связь с другими решениями

- **Контент-блоки** (`contentblock` модуль) — пока не активно используется, но доступен. Если редактор хочет менять текст в нескольких местах сразу — это инструмент.
- **i18n / переводы** — проект моноязычный (RU). Не заводи переводы превентивно.
````

- [ ] **Step 2: Verify**

```bash
wc -l .claude/skills/tech-architect/references/hardcode-vs-cms.md
```

Expected: ~100-130 строк.

---

## Task 13: Smoke-тест в новой сессии

Этот шаг — **ручной**. Skills загружаются Claude Code'ом при старте сессии, поэтому проверка требует свежей сессии.

- [ ] **Step 1: Открыть новую сессию Claude Code в этом проекте**

В терминале — `claude` (или новое окно IDE). Должна загрузиться текущая директория `stromsteel.loc`.

- [ ] **Step 2: Проверить, что скиллы видны в `/`-меню**

В новой сессии напечатать `/` (без Enter) — должны появиться:
- `frontend-expert`
- `backend-expert`
- `tech-architect`

С описаниями из frontmatter.

**Expected fail-mode:** если скилла нет в списке — frontmatter некорректен или путь не подхвачен. Проверь:
```bash
head -5 .claude/skills/<name>/SKILL.md
```
YAML frontmatter должен быть на самых первых строках без BOM/пробелов.

- [ ] **Step 3: Поведенческий тест каждой роли**

В новой сессии:

1. **Frontend:** «Используя /frontend-expert, как мне добавить новую карусель отзывов аналогичную текущей, но для блока партнёров?»
   - **Ожидание:** скилл ссылается на `.reviews-*` префикс, `swiper-patterns.md`, унифицированные стрелки, breakpoints. НЕ предлагает import-export или билд.

2. **Backend:** «Используя /backend-expert, мне нужно добавить миграцию для нового поля в модели News.»
   - **Ожидание:** называет правильное имя файла `m{YYMMDD}_{HHMMSS}_news_*.php`, путь `protected/modules/news/install/migrations/`, упоминает `safeUp/safeDown` и `{{news}}` префикс таблицы. Напоминает про `php protected/yiic.php migrate --module=news`.

3. **Tech-architect:** «Используя /tech-architect, надо ли заводить отдельный модуль для FAQ на главной?»
   - **Ожидание:** проходит 5-вопросный чек-лист, рекомендует хардкод в шаблоне (по правилу из `hardcode-vs-cms.md`), упоминает FAQPage schema.

- [ ] **Step 4: Граничный кейс**

В новой сессии: «Используя /frontend-expert, добавь миграцию для поля `image` в таблице `review`».

**Ожидание:** скилл явно отказывается («это backend-задача») и предлагает переключиться на `/backend-expert`.

- [ ] **Step 5: Записать результаты**

Если что-то пошло не так — править соответствующий `SKILL.md`. Если всё ок — Task 14.

---

## Task 14: Final commit + обновление спеки

- [ ] **Step 1: Stage tech-architect**

```bash
git add .claude/skills/tech-architect/
git commit -m "$(cat <<'EOF'
feat(skills): /tech-architect project role

SKILL.md + 2 references (yagni-checklist, hardcode-vs-cms).
YAGNI-фокус, паттерн hardcode-в-шаблонах как сознательный
компромисс. Связка с superpowers:brainstorming/writing-plans
обязательна для нетривиальных фич.

Co-Authored-By: Claude Opus 4.7 (1M context) <noreply@anthropic.com>
EOF
)"
```

- [ ] **Step 2: Обновить статус в спеке**

Изменить frontmatter в `docs/superpowers/specs/2026-05-22-expert-role-skills-design.md`:

```yaml
status: draft → awaiting implementation plan
```

на:

```yaml
status: implemented (2026-05-23)
```

Использовать Edit tool с точным old_string/new_string на 4-й строке файла.

- [ ] **Step 3: Commit обновление статуса**

```bash
git add docs/superpowers/specs/2026-05-22-expert-role-skills-design.md
git commit -m "$(cat <<'EOF'
docs(spec): mark expert-role-skills as implemented

Status: draft → implemented (2026-05-23).
Skills live in .claude/skills/{frontend,backend,tech-architect}-expert/.

Co-Authored-By: Claude Opus 4.7 (1M context) <noreply@anthropic.com>
EOF
)"
```

- [ ] **Step 4: Финальная проверка**

```bash
git log --oneline -5
find .claude/skills -type f -name "*.md" | sort
```

Expected:
- 4 коммита: frontend, backend, tech-architect, spec-status.
- 9 файлов: 3 SKILL.md + 6 references.

---

## Открытые вопросы (откладываем)

Из спеки:
- `/security-review` отдельным скиллом — пока хватает встроенного `security-review`. Не делаем.
- `/devops` — когда появится опыт по деплою, либо дописать в `/backend-expert`, либо отдельный скилл. Решим по факту.

## После реализации

- Если в течение 2 недель использования какой-то reference вырастает > 150 строк или становится «помойкой» — отколоть в подфайл (например, `references/yupe-conventions.md` → `migrations.md` + `urlrules.md` + `behaviors.md`).
- Если появится regularly-recurring задача из другой области (например, SEO / контент-SEO) — рассмотреть `/seo-expert` как 4-й project skill.
