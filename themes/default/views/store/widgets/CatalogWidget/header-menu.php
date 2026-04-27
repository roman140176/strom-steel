<?php if($category): ?>
	<ul class="header-catalog fl fl-al-it-c">
		<?php foreach ($category as $key => $service) : ?>
        	<li>
        		<a class="fl fl-al-it-c" href="<?= $service->getCategoryUrl(); ?>"><?= $service->name; ?></a>
        	</li>
    	<?php endforeach; ?>
    </ul>
<?php endif; ?>