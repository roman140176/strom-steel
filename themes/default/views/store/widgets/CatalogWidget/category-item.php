<?php if ($category) : ?>
    <div class="main-categories-menu" style="">
        <?php foreach ($category as $key => $data) : ?>
               <div class="categories-menu__item">
                   <a href="<?= $data->getCategoryUrl()?>" class="menu__item-link">
                       <?= $data->name?>
                   </a>
                    <div class="menu__item-right" style="">
                       <div class="menu-child-wrapp">
                        <?php if (!empty($data->children)): ?>
                                <ul class="children-menu-list">
                                     <?php foreach ($data->children as $i => $value): ?>
                                        <li>
                                            <a href="<?= $value->getCategoryUrl()?>"><?= $value->name?></a>
                                        </li>
                                      <?php endforeach ?>
                                </ul>
                                <a href="<?= $data->getCategoryUrl()?>" class="current-category-link">
                                    Смотреть все категории
                                </a>
                        <?php endif ?>

                       </div>
                   </div>
               </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


