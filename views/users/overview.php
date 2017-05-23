<div class="container users">
	<div class="row">
		<div class="col-md-3 col-sm-6">
			<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/user.png' ?>);">
				<a href="<?= $GLOBALS['config']['base_url'] ?>users/create" class="btn">add user</a>
			</div>
		</div>
			<?php foreach ($Cvar['users'] as $user) : 
				if ($user['id'] != $_SESSION['user']['id']) : ?>
				<div class="col-md-3 col-sm-6">
					<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/noPicture.png' ?>);">
						<span><?=$user['name'] ?></span>
						<span><?=user::role($user['role']) ?></span>
						<a href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$user['id'] ?>" class="btn">edit</a>
						<a href="<?= $GLOBALS['config']['base_url'] ?>users/delete/<?=$user['id'] ?>" class="del">x</a>
					</div>
				</div>
			<?php endif;
			 endforeach; ?>
