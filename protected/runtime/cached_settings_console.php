<?php return array (
  'basePath' => '/home/roman/sites/www/stromsteel.loc/protected',
  'name' => 'Cron',
  'preload' => 
  array (
    0 => 'log',
    1 => 'log',
  ),
  'commandMap' => 
  array (
    'migrate' => 
    array (
      'class' => 'vendor.yiiext.migrate-command.EMigrateCommand',
      'migrationPath' => 'application.modules.yupe.install.migrations',
      'migrationTable' => '{{migrations}}',
      'applicationModuleName' => 'yupe',
      'migrationSubPath' => 'install.migrations',
      'connectionID' => 'db',
      'templateFile' => 'application.modules.yupe.migrations.migration-template',
    ),
    'comments-migrate-to-ns' => 
    array (
      'class' => 'application.modules.comment.commands.MigrateToNestedSets',
    ),
    'yupe' => 
    array (
      'class' => 'application.modules.yupe.commands.YupeCommand',
    ),
    'testenv' => 
    array (
      'class' => 'application.modules.yupe.commands.TestEnvCommand',
    ),
  ),
  'import' => 
  array (
    0 => 'application.commands.*',
    1 => 'application.components.*',
    2 => 'application.models.*',
    3 => 'application.modules.callback.CallbackModule',
    4 => 'application.modules.callback.listeners.CallbackTemplateListener',
    5 => 'application.modules.cart.components.shopping-cart.*',
    6 => 'application.modules.cart.events.*',
    7 => 'application.modules.cart.models.CartProduct',
    8 => 'application.modules.category.models.*',
    9 => 'application.modules.category.events.*',
    10 => 'application.modules.category.listeners.*',
    11 => 'application.modules.category.helpers.*',
    12 => 'application.modules.category.components.*',
    13 => 'application.modules.comment.models.*',
    14 => 'application.modules.comment.events.*',
    15 => 'application.modules.comment.listeners.*',
    16 => 'application.modules.blog.models.*',
    17 => 'vendor.yiiext.nested-set-behavior.NestedSetBehavior',
    18 => 'application.modules.coupon.models.*',
    19 => 'application.modules.coupon.helpers.*',
    20 => 'application.modules.delivery.models.*',
    21 => 'application.modules.favorite.components.FavoriteService',
    22 => 'application.modules.favorite.listeners.TemplateListener',
    23 => 'application.modules.favorite.events.*',
    24 => 'application.modules.image.models.*',
    25 => 'application.modules.amocrm.models.*',
    26 => 'application.modules.page.models.Page',
    27 => 'application.modules.news.events.*',
    28 => 'application.modules.news.listeners.*',
    29 => 'application.modules.news.helpers.*',
    30 => 'application.modules.notify.listeners.*',
    31 => 'application.modules.order.models.*',
    32 => 'application.modules.order.helpers.*',
    33 => 'application.modules.page.events.*',
    34 => 'application.modules.page.listeners.*',
    35 => 'application.modules.page.models.*',
    36 => 'application.modules.page.components.*',
    37 => 'application.modules.store.models.*',
    38 => 'application.modules.payment.models.*',
    39 => 'application.modules.payment.components.*',
    40 => 'application.modules.rbac.listeners.AccessControlListener',
    41 => 'application.modules.blog.listeners.SitemapGeneratorListener',
    42 => 'application.modules.news.listeners.NewsSitemapGeneratorListener',
    43 => 'application.modules.page.listeners.PageSitemapGeneratorListener',
    44 => 'application.modules.store.listeners.StoreSitemapGeneratorListener',
    45 => 'application.modules.stocks.models.*',
    46 => 'application.modules.stocks.components.*',
    47 => 'application.modules.stocks.StocksModule',
    48 => 'application.modules.store.models.*',
    49 => 'application.modules.store.events.*',
    50 => 'application.modules.store.listeners.*',
    51 => 'application.modules.store.components.helpers.*',
    52 => 'application.modules.user.UserModule',
    53 => 'application.modules.user.models.*',
    54 => 'application.modules.user.forms.*',
    55 => 'application.modules.user.components.*',
    56 => 'application.modules.yupe.components.validators.*',
    57 => 'application.modules.yupe.components.exceptions.*',
    58 => 'application.modules.yupe.extensions.tagcache.*',
    59 => 'application.modules.yupe.helpers.*',
    60 => 'application.modules.yupe.models.*',
    61 => 'application.modules.yupe.widgets.*',
    62 => 'application.modules.yupe.controllers.*',
    63 => 'application.modules.yupe.components.*',
    64 => 'application.modules.zendsearch.models.*',
  ),
  'aliases' => 
  array (
    'webroot' => '/home/roman/sites/www/stromsteel.loc/public',
  ),
  'components' => 
  array (
    'uploadManager' => 
    array (
      'class' => 'yupe\\components\\UploadManager',
    ),
    'moduleManager' => 
    array (
      'class' => 'application.modules.rbac.components.ModuleManager',
    ),
    'configManager' => 
    array (
      'class' => 'yupe\\components\\ConfigManager',
    ),
    'migrator' => 
    array (
      'class' => 'yupe\\components\\Migrator',
    ),
    'themeManager' => 
    array (
      'class' => 'CThemeManager',
      'basePath' => '/home/roman/sites/www/stromsteel.loc/protected/../themes',
      'themeClass' => 'yupe\\components\\Theme',
    ),
    'request' => 
    array (
      'class' => 'yupe\\components\\HttpRequest',
      'enableCsrfValidation' => true,
      'csrfCookie' => 
      array (
        'httpOnly' => true,
      ),
      'csrfTokenName' => 'YUPE_TOKEN',
      'enableCookieValidation' => true,
      'noCsrfValidationRoutes' => 
      array (
        0 => '/payment/payment/process',
      ),
    ),
    'mail' => 
    array (
      'class' => 'yupe\\components\\Mail',
    ),
    'log' => 
    array (
      'class' => 'CLogRouter',
      'routes' => 
      array (
        0 => 
        array (
          'class' => 'CFileLogRoute',
          'logFile' => 'cron.log',
          'levels' => 'error, warning, info',
        ),
        1 => 
        array (
          'class' => 'CFileLogRoute',
          'logFile' => 'cron_trace.log',
          'levels' => 'trace',
        ),
      ),
    ),
    'cache' => 
    array (
      'class' => 'CFileCache',
      'behaviors' => 
      array (
        'clear' => 
        array (
          'class' => 'application.modules.yupe.extensions.tagcache.TaggingCacheBehavior',
        ),
      ),
    ),
    'db' => 
    array (
      'class' => 'CDbConnection',
      'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=stromtrade_stil',
      'username' => 'stromtrade_stil',
      'password' => 'mkbDt9&l',
      'emulatePrepare' => true,
      'charset' => 'utf8',
      'enableParamLogging' => 0,
      'enableProfiling' => 0,
      'schemaCachingDuration' => 108000,
      'tablePrefix' => 'yupe_',
      'pdoClass' => 'yupe\\extensions\\NestedPDO',
    ),
    'postManager' => 
    array (
      'class' => 'application.modules.blog.components.PostManager',
    ),
    'eventManager' => 
    array (
      'class' => 'yupe\\components\\EventManager',
      'events' => 
      array (
        'sitemap.before.generate' => 
        array (
          0 => 
          array (
            0 => 'SitemapGeneratorListener',
            1 => 'onGenerate',
          ),
          1 => 
          array (
            0 => '\\NewsSitemapGeneratorListener',
            1 => 'onGenerate',
          ),
          2 => 
          array (
            0 => '\\PageSitemapGeneratorListener',
            1 => 'onGenerate',
          ),
          3 => 
          array (
            0 => '\\StoreSitemapGeneratorListener',
            1 => 'onGenerate',
          ),
        ),
        'comment.add.success' => 
        array (
          0 => 
          array (
            0 => 'BlogPostCommentListener',
            1 => 'onNewComment',
          ),
          1 => 
          array (
            0 => 'NewCommentListener',
            1 => 'onSuccessAddComment',
          ),
        ),
        'template.head.end' => 
        array (
          0 => 
          array (
            0 => 'CallbackTemplateListener',
            1 => 'js',
          ),
        ),
        'category.after.save' => 
        array (
          0 => 
          array (
            0 => '\\CategoryListener',
            1 => 'onAfterSave',
          ),
          1 => 
          array (
            0 => '\\StoreCategoryListener',
            1 => 'onAfterSave',
          ),
        ),
        'category.after.delete' => 
        array (
          0 => 
          array (
            0 => '\\CategoryListener',
            1 => 'onAfterDelete',
          ),
          1 => 
          array (
            0 => '\\StoreCategoryListener',
            1 => 'onAfterDelete',
          ),
        ),
        'comment.before.add' => 
        array (
          0 => 
          array (
            0 => 'NewCommentListener',
            1 => 'onBeforeAddComment',
          ),
        ),
        'comment.after.save' => 
        array (
          0 => 
          array (
            0 => 'NewCommentListener',
            1 => 'onAfterSaveComment',
          ),
        ),
        'comment.after.delete' => 
        array (
          0 => 
          array (
            0 => 'NewCommentListener',
            1 => 'onAfterDeleteComment',
          ),
        ),
        'template.head.start' => 
        array (
          0 => 
          array (
            0 => 'TemplateListener',
            1 => 'js',
          ),
        ),
        'news.after.save' => 
        array (
          0 => 
          array (
            0 => '\\NewsListener',
            1 => 'onAfterSave',
          ),
        ),
        'news.after.delete' => 
        array (
          0 => 
          array (
            0 => '\\NewsListener',
            1 => 'onAfterDelete',
          ),
        ),
        'order.pay.success' => 
        array (
          0 => 
          array (
            0 => 'PayOrderListener',
            1 => 'onSuccessPay',
          ),
        ),
        'http.order.created' => 
        array (
          0 => 
          array (
            0 => 'OrderListener',
            1 => 'onCreate',
          ),
        ),
        'http.order.updated' => 
        array (
          0 => 
          array (
            0 => 'OrderListener',
            1 => 'onUpdate',
          ),
        ),
        'page.after.save' => 
        array (
          0 => 
          array (
            0 => '\\PageListener',
            1 => 'onAfterSave',
          ),
        ),
        'yupe.backend.controller.init' => 
        array (
          0 => 
          array (
            0 => 'AccessControlListener',
            1 => 'onBackendControllerInit',
          ),
        ),
        'user.success.registration' => 
        array (
          0 => 
          array (
            0 => 'UserManagerListener',
            1 => 'onUserRegistration',
          ),
        ),
        'user.success.registration.need.activation' => 
        array (
          0 => 
          array (
            0 => 'UserManagerListener',
            1 => 'onUserRegistrationNeedActivation',
          ),
        ),
        'user.success.password.recovery' => 
        array (
          0 => 
          array (
            0 => 'UserManagerListener',
            1 => 'onPasswordRecovery',
          ),
        ),
        'user.success.activate.password' => 
        array (
          0 => 
          array (
            0 => 'UserManagerListener',
            1 => 'onSuccessActivatePassword',
          ),
        ),
        'user.success.activate.account' => 
        array (
          0 => 
          array (
            0 => 'UserManagerListener',
            1 => 'onSuccessActivateAccount',
          ),
        ),
        'user.success.email.confirm' => 
        array (
          0 => 
          array (
            0 => 'UserManagerListener',
            1 => 'onSuccessEmailConfirm',
          ),
        ),
        'user.success.email.change' => 
        array (
          0 => 
          array (
            0 => 'UserManagerListener',
            1 => 'onSuccessEmailChange',
          ),
        ),
      ),
    ),
    'callbackManager' => 
    array (
      'class' => 'application.modules.callback.components.CallbackManager',
    ),
    'cart' => 
    array (
      'class' => 'application.modules.cart.components.shopping-cart.EShoppingCart',
    ),
    'categoriesRepository' => 
    array (
      'class' => 'application.modules.category.components.CategoryRepository',
    ),
    'commentManager' => 
    array (
      'class' => 'application.modules.comment.components.CommentManager',
    ),
    'couponManager' => 
    array (
      'class' => 'application.modules.coupon.components.CouponManager',
    ),
    'favorite' => 
    array (
      'class' => 'application.modules.favorite.components.FavoriteService',
    ),
    'mailMessage' => 
    array (
      'class' => 'application.modules.mail.components.YMailMessage',
    ),
    'menu' => 
    array (
      'class' => 'application.modules.menu.components.MenuComponent',
      'modules' => 
      array (
        'page' => 
        array (
          'entities' => 
          array (
            'page' => 
            array (
              'label' => 'Страницы',
              'model' => 'application.modules.page.models.Page',
              'modelAttributeName' => 'title',
              'url' => 
              array (
                'route' => '/page/page/view',
                'params' => 
                array (
                  'slug' => 'slug',
                ),
              ),
            ),
          ),
        ),
        'store' => 
        array (
          'entities' => 
          array (
            'category' => 
            array (
              'label' => 'Категории магазина',
              'model' => 'application.modules.store.models.StoreCategory',
              'modelAttributeName' => 'name',
              'url' => 
              array (
                'route' => '/store/category/view',
                'params' => 
                array (
                  'path' => 'slug',
                ),
              ),
            ),
          ),
        ),
        'news' => 
        array (
          'entities' => 
          array (
            'category' => 
            array (
              'label' => 'Категории новостей',
              'model' => 'application.modules.category.models.Category',
              'modelAttributeName' => 'name',
              'url' => 
              array (
                'route' => '/news/newsCategory/view',
                'params' => 
                array (
                  'slug' => 'slug',
                ),
              ),
            ),
            'news' => 
            array (
              'label' => 'Новости',
              'model' => 'application.modules.news.models.News',
              'modelAttributeName' => 'title',
              'url' => 
              array (
                'route' => 'news/news/view',
                'params' => 
                array (
                  'slug' => 'slug',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'notify' => 
    array (
      'class' => 'notify\\components\\Notify',
      'mail' => 
      array (
        'class' => 'yupe\\components\\Mail',
      ),
    ),
    'orderNotifyService' => 
    array (
      'class' => 'application.modules.order.components.OrderNotifyService',
      'mail' => 'mail',
    ),
    'paymentManager' => 
    array (
      'paymentSystems' => 
      array (
        'payler' => 
        array (
          'class' => 'application.modules.payler.components.payments.PaylerPaymentSystem',
        ),
        'manual' => 
        array (
          'class' => 'application.modules.payment.components.ManualPaymentSystem',
        ),
      ),
      'class' => 'application.modules.payment.components.PaymentManager',
    ),
    'authManager' => 
    array (
      'class' => 'CDbAuthManager',
      'connectionID' => 'db',
      'assignmentTable' => '{{user_user_auth_assignment}}',
      'itemChildTable' => '{{user_user_auth_item_child}}',
      'itemTable' => '{{user_user_auth_item}}',
    ),
    'ReviewManager' => 
    array (
      'class' => 'application.modules.review.components.ReviewManager',
    ),
    'sitemapGenerator' => 
    array (
      'class' => 'application.modules.sitemap.components.SitemapGenerator',
    ),
    'money' => 
    array (
      'class' => 'application.modules.store.components.Money',
    ),
    'productRepository' => 
    array (
      'class' => 'application.modules.store.components.repository.ProductRepository',
    ),
    'producerRepository' => 
    array (
      'class' => 'application.modules.store.components.repository.ProducerRepository',
    ),
    'categoryRepository' => 
    array (
      'class' => 'application.modules.store.components.repository.StoreCategoryRepository',
    ),
    'attributesFilter' => 
    array (
      'class' => 'application.modules.store.components.AttributeFilter',
    ),
    'session' => 
    array (
      'class' => 'CHttpSession',
      'timeout' => 86400,
      'cookieParams' => 
      array (
        'httponly' => true,
      ),
    ),
    'user' => 
    array (
      'class' => 'application.modules.user.components.YWebUser',
      'loginUrl' => 
      array (
        0 => '/user/account/login',
      ),
      'identityCookie' => 
      array (
        'httpOnly' => true,
      ),
    ),
    'userManager' => 
    array (
      'class' => 'application.modules.user.components.UserManager',
      'hasher' => 
      array (
        'class' => 'application.modules.user.components.Hasher',
      ),
      'tokenStorage' => 
      array (
        'class' => 'application.modules.user.components.TokenStorage',
      ),
    ),
    'authenticationManager' => 
    array (
      'class' => 'application.modules.user.components.AuthenticationManager',
    ),
    'thumbnailer' => 
    array (
      'class' => 'yupe\\components\\image\\Thumbnailer',
      'options' => 
      array (
        'jpeg_quality' => 90,
        'png_compression_level' => 8,
      ),
    ),
    'ajax' => 
    array (
      'class' => 'yupe\\components\\AsyncResponse',
    ),
  ),
  'modules' => 
  array (
    'yupe' => 
    array (
      'class' => 'application.modules.yupe.YupeModule',
      'cache' => true,
      'components' => 
      array (
        'bootstrap' => 
        array (
          'class' => 'vendor.clevertech.yii-booster.src.components.Booster',
          'coreCss' => true,
          'responsiveCss' => true,
          'yiiCss' => true,
          'jqueryCss' => true,
          'enableJS' => true,
          'fontAwesomeCss' => true,
          'enableNotifierJS' => false,
        ),
      ),
      'visualEditors' => 
      array (
        'redactor' => 
        array (
          'class' => 'yupe\\widgets\\editors\\Redactor',
        ),
        'ckeditor' => 
        array (
          'class' => 'yupe\\widgets\\editors\\CKEditor',
        ),
        'textarea' => 
        array (
          'class' => 'yupe\\widgets\\editors\\Textarea',
        ),
      ),
    ),
    'blog' => 
    array (
      'class' => 'application.modules.blog.BlogModule',
      'panelWidgets' => 
      array (
        'application.modules.blog.widgets.PanelStatWidget' => 
        array (
          'limit' => 5,
        ),
      ),
    ),
    'callback' => 
    array (
      'class' => 'application.modules.callback.CallbackModule',
    ),
    'cart' => 
    array (
      'class' => 'application.modules.cart.CartModule',
    ),
    'category' => 
    array (
      'class' => 'application.modules.category.CategoryModule',
    ),
    'comment' => 
    array (
      'class' => 'application.modules.comment.CommentModule',
      'panelWidgets' => 
      array (
        'application.modules.comment.widgets.PanelCommentStatWidget' => 
        array (
          'limit' => 5,
        ),
      ),
      'visualEditors' => 
      array (
        'redactor' => 
        array (
          'class' => 'comment\\widgets\\editors\\CommentRedactor',
        ),
        'textarea' => 
        array (
          'class' => 'yupe\\widgets\\editors\\Textarea',
        ),
      ),
    ),
    'contentblock' => 
    array (
      'class' => 'application.modules.contentblock.ContentBlockModule',
    ),
    'coupon' => 
    array (
      'class' => 'application.modules.coupon.CouponModule',
    ),
    'delivery' => 
    array (
      'class' => 'application.modules.delivery.DeliveryModule',
    ),
    'favorite' => 
    array (
      'class' => 'application.modules.favorite.FavoriteModule',
    ),
    'gallery' => 
    array (
      'class' => 'application.modules.gallery.GalleryModule',
    ),
    'homepage' => 
    array (
      'class' => 'application.modules.homepage.HomepageModule',
    ),
    'image' => 
    array (
      'class' => 'application.modules.image.ImageModule',
    ),
    'mail' => 
    array (
      'class' => 'application.modules.mail.MailModule',
    ),
    'menu' => 
    array (
      'class' => 'application.modules.menu.MenuModule',
    ),
    'news' => 
    array (
      'class' => 'application.modules.news.NewsModule',
    ),
    'notify' => 
    array (
      'class' => 'application.modules.notify.NotifyModule',
    ),
    'order' => 
    array (
      'class' => 'application.modules.order.OrderModule',
      'panelWidgets' => 
      array (
        'application.modules.order.widgets.PanelOrderStatWidget' => 
        array (
          'limit' => 5,
        ),
      ),
    ),
    'page' => 
    array (
      'class' => 'application.modules.page.PageModule',
    ),
    'payler' => 
    array (
      'class' => 'application.modules.payler.PaylerModule',
    ),
    'payment' => 
    array (
      'class' => 'application.modules.payment.PaymentModule',
    ),
    'rbac' => 
    array (
      'class' => 'application.modules.rbac.RbacModule',
    ),
    'review' => 
    array (
      'class' => 'application.modules.review.ReviewModule',
    ),
    'sitemap' => 
    array (
      'class' => 'application.modules.sitemap.SitemapModule',
    ),
    'slider' => 
    array (
      'class' => 'application.modules.slider.SliderModule',
    ),
    'stocks' => 
    array (
      'class' => 'application.modules.stocks.StocksModule',
    ),
    'store' => 
    array (
      'class' => 'application.modules.store.StoreModule',
    ),
    'user' => 
    array (
      'class' => 'application.modules.user.UserModule',
      'panelWidgets' => 
      array (
        'application.modules.user.widgets.PanelUserStatWidget' => 
        array (
          'limit' => 5,
        ),
      ),
      'documentRoot' => '',
      'avatarsDir' => 'avatars',
      'notifyEmailFrom' => 'test@test.ru',
    ),
    'zendsearch' => 
    array (
      'class' => 'application.modules.zendsearch.ZendSearchModule',
      'searchModels' => 
      array (
        'News' => 
        array (
          'path' => 'application.modules.news.models.News',
          'module' => 'news',
          'titleColumn' => 'title',
          'linkColumn' => 'slug',
          'linkPattern' => '/news/news/view?slug={slug}',
          'textColumns' => 'full_text,short_text,meta_keywords,meta_description,slug',
          'criteria' => 
          array (
            'condition' => 'status = :status',
            'params' => 
            array (
              ':status' => 1,
            ),
          ),
        ),
        'Page' => 
        array (
          'path' => 'application.modules.page.models.Page',
          'module' => 'page',
          'titleColumn' => 'title',
          'linkColumn' => 'slug',
          'linkPattern' => '/page/page/view?slug={slug}',
          'textColumns' => 'body,title_short,meta_keywords,meta_description,slug',
          'criteria' => 
          array (
            'condition' => 'status = :status',
            'params' => 
            array (
              ':status' => 1,
            ),
          ),
        ),
        'Blog' => 
        array (
          'path' => 'application.modules.blog.models.Blog',
          'module' => 'blog',
          'titleColumn' => 'name',
          'linkColumn' => 'slug',
          'linkPattern' => '/blog/blog/view?slug={slug}',
          'textColumns' => 'name,description,slug',
          'criteria' => 
          array (
            'condition' => 'status = :status',
            'params' => 
            array (
              ':status' => 1,
            ),
          ),
        ),
        'Post' => 
        array (
          'path' => 'application.modules.blog.models.Post',
          'module' => 'blog',
          'titleColumn' => 'title',
          'linkColumn' => 'slug',
          'linkPattern' => '/blog/post/view?slug={slug}',
          'textColumns' => 'title,quote,content,slug',
          'criteria' => 
          array (
            'condition' => 'status = :status',
            'params' => 
            array (
              ':status' => 1,
            ),
          ),
        ),
        'Product' => 
        array (
          'path' => 'application.modules.store.models.Product',
          'module' => 'store',
          'titleColumn' => 'name',
          'linkColumn' => 'link',
          'linkPattern' => '{link}',
          'textColumns' => 'name,sku,slug,description,meta_title,meta_description,meta_keywords',
          'criteria' => 
          array (
            'condition' => 'status = :status',
            'params' => 
            array (
              ':status' => 1,
            ),
          ),
        ),
        'StoreCategory' => 
        array (
          'path' => 'application.modules.store.models.StoreCategory',
          'module' => 'store',
          'titleColumn' => 'name',
          'linkColumn' => 'slug',
          'linkPattern' => '{slug}',
          'textColumns' => 'name,name_short,description,meta_title,meta_description,meta_keywords',
          'criteria' => 
          array (
            'condition' => 'status = :status',
            'params' => 
            array (
              ':status' => 1,
            ),
          ),
        ),
      ),
    ),
  ),
  'behaviors' => 
  array (
  ),
);