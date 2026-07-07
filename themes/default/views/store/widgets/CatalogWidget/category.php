<?php if ($category): ?>
    <div class="tabs-links" id="tabs-div">
        <?php foreach ($category as $data) : ?>
            <?php if ($data->getCountInHit() > 0): ?>
                <div class="tabs-links_item" data-href="/tabstore/<?= $data->id; ?>">
                    <span><?= $data->name; ?></span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
