<?php
/* @var $model Page */
/* @var $this PageController */

if ($model->layout) {
    $this->layout = "//layouts/{$model->layout}";
}

$this->title = $model->meta_title ?: $model->title;
$this->breadcrumbs = $this->getBreadCrumbs();
$this->description = $model->meta_description ?: Yii::app()->getModule('yupe')->siteDescription;
$this->keywords = $model->meta_keywords ?: Yii::app()->getModule('yupe')->siteKeyWords;

/** @var array<string, array{title:string, items:array<int, array{q:string,a:string}>}> $faq */
$faq = require __DIR__ . '/_faq_data.php';
$sectionKeys = array_keys($faq);
$firstKey = $sectionKeys[0] ?? '';

if (!function_exists('stromsteel_faq_answer_text')) {
    function stromsteel_faq_answer_text(string $html): string
    {
        $text = preg_replace('#</(p|li|ul|ol|div)>#u', "$0 ", $html);
        $text = strip_tags((string)$text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);
        return trim((string)$text);
    }
}

$schemaItems = [];
foreach ($faq as $section) {
    foreach ($section['items'] as $item) {
        $schemaItems[] = [
            '@type' => 'Question',
            'name' => $item['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => stromsteel_faq_answer_text($item['a']),
            ],
        ];
    }
}
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $schemaItems,
];
?>
<div class="pageMainContent">
    <div class="container breadcrumbs-container">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', [
            'links' => $this->breadcrumbs,
        ]); ?>
    </div>
    <div class="container">
        <h1 class="page_title"><?= CHtml::encode($model->title); ?></h1>

        <nav class="faq-tabs" role="tablist" aria-label="Разделы вопросов">
            <?php foreach ($faq as $key => $section): ?>
                <a href="#<?= CHtml::encode($key) ?>"
                   class="faq-tab<?= $key === $firstKey ? ' is-active' : '' ?>"
                   data-target="<?= CHtml::encode($key) ?>"
                   role="tab"
                   aria-selected="<?= $key === $firstKey ? 'true' : 'false' ?>"
                   aria-controls="faq-panel-<?= CHtml::encode($key) ?>">
                    <span class="faq-tab__title"><?= CHtml::encode($section['title']) ?></span>
                </a>
            <?php endforeach; ?>
        </nav>

        <div class="faq-panels">
            <?php foreach ($faq as $key => $section): ?>
                <section class="faq-panel<?= $key === $firstKey ? ' is-active' : '' ?>"
                         id="faq-panel-<?= CHtml::encode($key) ?>"
                         data-section="<?= CHtml::encode($key) ?>"
                         role="tabpanel"
                         aria-label="<?= CHtml::encode($section['title']) ?>">
                    <?php foreach ($section['items'] as $i => $item): ?>
                        <details class="faq-item">
                            <summary class="faq-item__summary">
                                <span class="faq-item__question"><?= CHtml::encode($item['q']) ?></span>
                                <svg class="faq-item__chevron" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                                    <path d="M3 6l5 5 5-5" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </summary>
                            <div class="faq-item__answer"><?= $item['a'] ?></div>
                        </details>
                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($model->body)): ?>
            <div class="faq-extra"><?= $model->body ?></div>
        <?php endif; ?>
    </div>
</div>
<script type="application/ld+json">
<?= json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>
