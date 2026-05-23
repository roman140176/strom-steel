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
