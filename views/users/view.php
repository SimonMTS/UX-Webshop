<div class="container users">
	<div class="row">
		<div class="col-md-4 user-profile">
			<div class="profile-picture" style="background-image: url(<?=$GLOBALS['config']['base_url'].$user->pic ?>);"></div>
			<h3><?=$user->name ?></h3>
			<?=User::Role($user->role) ?>
			<a href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$user->id ?>" class="btn btn-default pull-right">edit</a>
			<hr>
			<dl class="dl-horizontal">
				<dt>First name</dt>
				<dd><?=$user->voornaam ?></dd>
				<dt>Last name</dt>
				<dd><?=$user->achternaam ?></dd>
				<dt>Gender</dt>
				<dd><?=($user->geslacht == 'm') ? 'Male' : 'Female' ?></dd>
				<dt>Age</dt>
				<dd><?php
					$datetime1 = new DateTime();
					$datetime2 = DateTime::createFromFormat('d/m/Y:H:i:s', $user->geboorte_datum);
					$interval = $datetime1->diff($datetime2);
					echo $interval->format('%y');
				?> y/o</dd>
				<dt>Address</dt>
				<dd>
					<?=explode(',', $user->adres)[0] ?>
					<?=explode(',', $user->adres)[1] ?>, <br>
					<?=explode(',', $user->adres)[2] ?>, 
					<?=explode(',', $user->adres)[3] ?>, 
					<?=explode(',', $user->adres)[4] ?>
				</dd>
				<dt>Registration date</dt>
				<dd>~20/05/2017</dd>
			</dl>
			
			<hr>
			<label>Registration date: </label>~20/05/2017<br>
			<label>Aantal aankopen: </label><?= sizeof($orders) ?><br><br>
		</div>
		<div class="col-md-8 order-list <?php if (sizeof($orders) == 0) : ?>hidden-sm hidden-xs<?php endif; ?>">
			<div style="display: none;" class="">
				<?php if (sizeof($orders) == 0) : ?>
					<span class="no-p">Nog geen aankopen</span>
				<?php endif; ?>
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