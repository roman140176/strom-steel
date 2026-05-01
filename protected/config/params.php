<?php

return [
    'key'        => '6LdgDM8ZAAAAAF325SYfdwMVlv_IZ7lpFn8XHvoL',
    'secretkey'  => '6LdgDM8ZAAAAAKGll0qji4a-BB5rRXBcD1UhOeg9',
    // reCAPTCHA проверяется только когда флаг = true.
    // По умолчанию: на dev (YII_DEBUG=true) — выключена; на проде — включена.
    'recaptchaEnabled' => !(defined('YII_DEBUG') && YII_DEBUG),
    'runtimeWidgets' => [
        'application.modules.page.widgets.PagesWidget',
        'application.modules.page.widgets.PagesNewWidget',
        'application.modules.contentblock.widgets.ContentBlockWidget',
        'application.modules.gallery.widgets.GalleryWidget',
        'application.modules.gallery.widgets.GalleryNewWidget',
        'application.modules.mail.widgets.ContactFormsWidget',
        'application.modules.mail.widgets.ContactInnerWidget',
    ],
];
