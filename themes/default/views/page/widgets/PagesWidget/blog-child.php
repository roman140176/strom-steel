
    <?php $this->widget('bootstrap.widgets.TbListView', [
        'itemView' => '_child',
        'dataProvider' => $pages,
        'summaryText' => "Статьи {start}-{end} из {count} ",
        'itemsCssClass' => 'child-items',
        'id' => 'child-box',
        'template'=>'
                {items}
                <div class="blog-nav">
                    {pager}
                </div>
            ',
    ]) ?>

