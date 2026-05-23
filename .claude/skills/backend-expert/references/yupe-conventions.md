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
