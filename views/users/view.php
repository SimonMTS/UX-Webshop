<div class="container users">
	<div class="row">
		<div class="col-md-4 user-profile">
			<div class="profile-picture" style="background-image: url(<?=$GLOBALS['config']['base_url'].$user->pic ?>);"></div>
			<h3><?=$user->name ?></h3>
			<?=User::Role($user->role) ?>
			<a href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$user->id ?>" class="btn btn-default pull-right">edit</a>
			<hr>
			<label>Firstname: </label>Simon<br>
			<label>Lastname: </label>Striekwold<br>
			<label>Gender: </label>Male<br>
			<label>Age: </label>18 y/o<br>
			<label>Adress: </label>Teugenaarsstraat 86, oss<br>
			<label>Registration date: </label>20/05/2017<br>
			<hr>
			<label>Number of purchases: </label><?= sizeof($orders) ?><br>

		</div>
		<div class="col-md-8 order-list">
			<div style="display: none;">
				<?php foreach ($orders as $order) : ?>
					<div>
						<a class="left" href="<?=$GLOBALS['config']['base_url'].'orders/view/'.$order['id'] ?>">
							<span class="full-w-left"><?= $order['method'] ?> - See full order</span>
							<span class="paid"><?= $order['status'] ?></span>
						</a>
						<a class="right" href="<?=$GLOBALS['config']['base_url'].'games/view/'.$order['game_id'] ?>">
							<span class="pull-right"><?= date('d/m/Y', strtotime($order['paidDatetime']) ) ?></span><br>
							<span class="pull-right full-w"><?= $order['game_name'] ?></span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>