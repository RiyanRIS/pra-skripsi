<?php if (! empty($messages)) : ?>
	<div class="alert alert-danger" role="alert">
		<ul>
		<?php foreach ($messages as $message) : ?>
			<li><?= esc($message) ?></li>
		<?php endforeach ?>
		</ul>
	</div>
<?php endif ?>
