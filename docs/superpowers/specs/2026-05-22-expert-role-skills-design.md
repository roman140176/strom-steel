---
title: Project-level expert role skills (frontend / backend / architect)
date: 2026-05-22
status: draft → awaiting implementation plan
---

# Project-level expert role skills

## Контекст

stromsteel.ru (YUPE/Yii1) — проект с накопленным набором конвенций (overlay-ассеты, `.svc-*`/`.nws-*`/`.ab-*` префиксы, brand `#0e7e50`, hardcode-vs-CMS компромиссы, mail-шаблоны как файлы), которые не сводятся к фреймворку. Когда задаче нужна экспертная дисциплина (а не просто «сделать»), хочется одной командой переключить ассистента в нужную роль с прошитыми проектными знаниями.

## Цель

Сделать **3 project-level скилла**, лежащих в `.claude/skills/` репозитория stromsteel и активируемых только вручную:

- `/frontend-expert`
- `/backend-expert`
- `/tech-architect`

Каждый скилл — универсальная экспертная роль для своей области (consult / implement / review — в зависимости от того, как пользователь его вызвал).

### Не цели

- **Auto-trigger** — не используем. Скиллы загружаются только по явному `/slash`.
- **Глобальная установка (~/.claude/skills/)** — нет, project-level. Если роль уедет в другой проект — копируется руками.
- **Дублирование superpowers** — TDD / debugging / brainstorming / verification-before-completion **остаются в superpowers**; роли ссылаются на них через формулу «если делаешь X — обязательно пройди /superpowers:<name>».
- **Дублирование общеизвестного** — никаких «React component lifecycle», «Yii ActiveRecord 101». Только то, что специфично для stromsteel или что задаёт *дисциплину*.

## Архитектура

```
stromsteel.loc/
├── .claude/
│   └── skills/
│       ├── frontend-expert/
│       │   ├── SKILL.md              # < 200 строк, точка входа
│       │   └── references/
│       │       ├── css-conventions.md      # overlay-pattern, prefixes, brand-color tokens
│       │       ├── swiper-patterns.md      # как мы делаем карусели, стрелки, breakpoints
│       │       └── assets-pipeline.md      # AVIF/<picture>, fonts, без билда
│       ├── backend-expert/
│       │   ├── SKILL.md
│       │   └── references/
│       │       ├── yupe-conventions.md     # модули, миграции, urlRules
│       │       ├── mail-and-forms.md       # ServicesFormsWidget, recaptchaEnabled, шаблоны
│       │       └── image-upload.md         # ImageUploadBehavior нюанс с getInstance
│       └── tech-architect/
│           ├── SKILL.md
│           └── references/
│               ├── yagni-checklist.md      # перед фичей — 5 вопросов
│               └── hardcode-vs-cms.md      # когда верстаем в шаблоне, когда заводим модель
```

### Почему директория, а не плоский `.md`

Скиллы будут жить и расти: появятся новые конвенции, новые виджеты, новые компромиссы. Директория с `references/` даёт SKILL.md остаться < 200 строк (точка входа + дисциплина), а детали — в отдельные файлы, на которые SKILL.md ссылается через `см. references/<file>.md`.

## Структура `SKILL.md` (шаблон)

```markdown
---
name: <role-slug>
description: < ОДНА строка: для чего вызывать. Определяет показ в /-меню. >
---

# <Заголовок роли>

## Когда вызывать
- … (2–4 пункта, конкретные триггеры)

## Стек, который ты знаешь по умолчанию
- YUPE 1.x поверх Yii 1.1
- … (5–8 пунктов специфики stromsteel)

## Дисциплина роли
### Перед тем как писать код
- … (что обязательно проверить)
### Чего НЕ делать
- … (явные анти-паттерны проекта)
### Когда передавать управление
- … («если это архитектурный вопрос — /tech-architect»)

## Чек-лист перед заявкой о готовности
- [ ] …
- [ ] …

## Ссылки на детали
- См. `references/<file>.md` — …
```

## Содержание ролей

### `/frontend-expert`

**Область:** вёрстка, JS, CSS, ассеты, accessibility, перфоманс UI.

**Знает по умолчанию:**
- Активная тема — `themes/default/`, не `shop/`.
- Layout — `themes/default/views/layouts/main.php`. SCSS-исходники в `themes/default/scss/` — dormant, **не трогать**.
- Overlay-ассеты: всё новое — в `themes/default/web/css/custom.css` и `themes/default/web/js/custom.js`. Они подключены последними в `main.php:36-37` и переопределяют базу.
- CSS-префиксы по разделам: `.svc-*` (service-страницы), `.nws-*` (новости), `.ab-*` (о компании), `.aboutus-*` (главная — блок «о нас»), `.cf-*` (форма-CTA на главной), `.ssw-*` (объекты на главной), `.reviews-*` (карусель отзывов).
- Брендовый цвет — `#0e7e50` (`rgba(14, 126, 80, 1)`). Никаких `#1b4e9b` / `#1f34f2`.
- Шрифты: PLR (базовый темовский) + Inter (Google Fonts, preconnect в `main.php`). На service-страницах используется Inter.
- Картинки: AVIF + fallback (через `<picture>` или `webp+png`). Видеофон ужимается ffmpeg-ом до 720×1280 CRF 26.
- Стек JS: jQuery legacy + Swiper + кастомные виджеты. **Без билда.** Никаких import/export.
- Стрелки Swiper — унифицированный стиль (см. `references/swiper-patterns.md`).

**Дисциплина:**
- Перед правкой CSS — проверить, **где** определён базовый стиль, не дублировать селектор лучше → пишем в `custom.css` с `!important` если базовый грузится первее с той же специфичностью (типичный случай для модалок).
- Перед добавлением шрифта — проверить уже подключённые в `main.php`.
- Accessibility: `<h1 class="sr-only">` использовать вместо `display:none` (Google занижает скрытые).
- Перед коммитом — пройти `/superpowers:verification-before-completion` на UI-задаче (открыть страницу в браузере, проверить мобилу).
- Анти-паттерны: трогать `scss/` (dormant), писать `style.min.css` напрямую, добавлять inline `<style>` в шаблоны, использовать Bootstrap-классы без проверки версии (тут v3).

### `/backend-expert`

**Область:** YUPE/Yii1, модели, миграции, контроллеры, виджеты, mail, кэш, URL-правила.

**Знает по умолчанию:**
- YUPE 1.x поверх Yii 1.1. `protected/modules/<name>/` — стандартная структура: `models/`, `controllers/`, `views/`, `widgets/`, `install/migrations/`.
- Миграции — `m{YYMMDD}_{HHMMSS}_{name}` (пример: `m461218_120000_review_add_preview_text.php`). Запуск: `php protected/yiic.php migrate --module=<name>`.
- `urlRules` — в `protected/config/main.php`, не в модулях.
- `ImageUploadBehavior` (родитель `FileUploadBehavior`) **сам** цепляет `CUploadedFile::getInstance($model, 'image')` в `beforeValidate` — в backend-контроллере отдельная обработка не нужна. **НО** в виджетах (`ServicesFormsWidget`, `CalcPriceWidget`) была бага — там нужно руками вызывать `getInstance($model, 'file')`. См. `references/image-upload.md`.
- Mail: файловые шаблоны в `themes/default/views/mail/mail/_*.php` (а не админ-события `raiseMailEvent` — по решению user'а). От: `info@stromsteel.ru` (хардкод), To: `info@strom-trade.ru` (YUPE setting).
- reCAPTCHA: флаг `Yii::app()->params['recaptchaEnabled']` = `!YII_DEBUG`. В формах вызывать `if (Yii::app()->params['recaptchaEnabled']) { ... }`.
- Кэш: `protected/runtime/cache/*.bin` (122 файла сейчас), `protected/runtime/views/` (скомпилированные view), `public_html/assets/{hash}/` (CAssetManager).
- Custom fields (порт из autoclass): `CustomFieldBehavior` подключён к News. См. memory `project_stromsteel_custom_fields`.

**Дисциплина:**
- Перед миграцией — проверить, нет ли уже схожих изменений в `install/migrations/` модуля (типичная ошибка: дубль миграции).
- Перед mail-шаблоном — посмотреть существующие `_main.php`, `_calc-price.php`, `_laser-calc.php`, использовать их структуру.
- Перед изменением модели — проверить behaviors (особенно `ImageUploadBehavior`, `CustomFieldBehavior`).
- **Перед коммитом любых SQL-изменений** — пройти `/superpowers:verification-before-completion`: миграция должна откатываться (`down()`), идемпотентность данных.
- Анти-паттерны: SQL-инъекции через `$_GET` напрямую в `findBySql` (использовать parameter binding), хранить хардкодные пароли в php-файлах в репо, плодить `raiseMailEvent` если рядом есть файловый шаблон.

### `/tech-architect`

**Область:** scope-решения, «что делать / что не делать», влияние на бизнес, технический долг.

**Знает по умолчанию:**
- В проекте сложился паттерн **hardcode-в-шаблонах** для важных блоков главной (FAQ, «о нас», stat-плашки) — а не CMS-модели. См. `references/hardcode-vs-cms.md`. Это сознательный компромисс: editor → дольше, но devops дешевле.
- Memory `project_stromsteel_tasks` — текущий список «сделано / отложено / не делали». Перед предложением новой фичи свериться, не отложена ли она.
- Контент-блоки (текст «о нас», статистика 15+/200+/10дн) часто живут с заглушками — это OK; не блокировать релиз отсутствием реальных цифр.
- Юр. данные / телефоны — хардкод (см. memory `project_stromsteel`). Не предлагать «вывести в .env / в админку» без явной просьбы.

**Дисциплина (YAGNI ruthlessly):**
- Перед предложением фичи задать 5 вопросов:
  1. Это просили или я додумываю?
  2. Что произойдёт, если **не** делать?
  3. Можно ли решить хардкодом в шаблоне?
  4. Есть ли уже похожее в `themes/default/views/` — переиспользуем?
  5. Это блокирует следующую задачу или edge-case?
- Если задача >1 файла touched — предложить разбить.
- **Перед скоупом** — пройти `/superpowers:brainstorming`. Это обязательно для любой не-тривиальной фичи.
- Анти-паттерны: предлагать «фреймворк-переход» (Symfony, Laravel, headless CMS), плодить новые модули если хватает виджета, предлагать абстракции «на вырост».

## Поведение при вызове

Когда пользователь набирает `/frontend-expert` (или другой), Claude:

1. Загружает `SKILL.md` через стандартный механизм skills.
2. Заявляет в одну строку: «Using frontend-expert to <цель из последнего сообщения>».
3. Применяет дисциплину роли к текущей задаче.
4. Если в ходе работы упирается в другую область — *явно* передаёт управление другой роли: «это архитектурный вопрос — переключаюсь через `/tech-architect`».

## Тестирование

Скиллы — не код, а инструкции. Проверка:

1. **Smoke:** в новой сессии вызвать каждый из `/frontend-expert`, `/backend-expert`, `/tech-architect` — убедиться, что скилл подгружается без ошибок.
2. **Поведенческая:** задать роли типичную задачу из её области («перекрась стрелку Swiper», «добавь миграцию для поля X», «нужно ли заводить отдельный модуль для FAQ») — проверить, что роль ссылается на проектные конвенции, а не выдаёт generic-ответ.
3. **Граничный кейс:** задать frontend-эксперту backend-вопрос — должен явно отказаться и предложить `/backend-expert`.

## План реализации (превью)

(детальный — отдельно через `/superpowers:writing-plans` после approval этого spec'а)

1. Создать `.claude/skills/` в репо.
2. Написать 3 `SKILL.md` по шаблону выше.
3. Заполнить `references/*.md` (≈ 6 файлов) выжимками из существующих memory-записей.
4. Smoke-тест в свежей сессии.
5. Закоммитить.

## Открытые вопросы

- Нужен ли скилл `/security-review` отдельно или хватает встроенного `security-review` из платформы? (отдельная сессия, не сейчас).
- Когда копится опыт по deployment — выделить ли отдельный `/devops`-скилл или дописать в `/backend-expert`? (решим по факту).
