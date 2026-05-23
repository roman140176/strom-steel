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
