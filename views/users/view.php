<div class="container users">
	<div class="row">
		<div class="col-md-12">
			<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/noPicture.png' ?>);">
				<span><?=$user->name ?></span>
				<span><?=User::Role($user->role) ?></span>
				<a href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$user->id ?>" class="btn">edit</a>
			</div>
		</div>
	</div>
	<div class="row">
		<?php foreach ($orders as $order) : ?>
		<div class="col-md-3 col-sm-6">
			<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$order['cover'] ?>);">
				<span><?=$order['method'] ?> - <a href="<?=$GLOBALS['config']['base_url'].'orders/view/'.$order['id'] ?>">view</a></span>
				<span><?=$order['descr'] ?>: <?=$order['amount'] ?>,-</span>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>