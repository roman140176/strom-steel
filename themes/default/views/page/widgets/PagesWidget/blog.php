
    <?php $this->widget('bootstrap.widgets.TbListView', [
        'itemView' => '_blog-item',
        'dataProvider' => $pages,
        'summaryText' => "Статьи {start}-{end} из {count} ",
        'itemsCssClass' => 'blog-items',
        'id' => 'blog-box',
        'template'=>'
                {items}
                <div class="blog-nav">
                    {pager}
                </div>
            ',
    ]) ?>

