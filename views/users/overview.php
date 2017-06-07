<div class="container portrait">
	<div class="row">
		<div class="col-md-3">
			<form method="POST">
				<div class="input-group search">
					<input name="search" value="<?php if (isset ($_POST['search'])) { echo $_POST['search']; } ?>" type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Go!</button>
					</span>
				</div>
			</form>
		</div>
		<div class="col-md-9">
			<a href="<?= $GLOBALS['config']['base_url'] ?>users/create" class="btn btn-default pull-right">add user</a>
		</div>
	</div>
	<div class="row">
		<hr>
	</div>
	<div class="row">
		<?php foreach ($users as $user) : ?>
			<div class="col-md-6 user-list-item">
				<a class="view" href="<?=$GLOBALS['config']['base_url'].'users/view/'.$user['id'] ?>">
					<img class="img-responsive" src="<?=$GLOBALS['config']['base_url'].'assets/user.png' ?>">
					<span class="name"><?=$user['name'] ?></span>
					<span class="role"><?=user::role($user['role']) ?></span>
				</a>
				<a class="edit" href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$user['id'] ?>" class="btn">edit</a>
				<a class="del" href="<?= $GLOBALS['config']['base_url'] ?>users/delete/<?=$user['id'] ?>" class="del">x</a>
				<hr>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<a href="<?=$GLOBALS['config']['base_url'].'games/overview/'.($page-1).$searchpar ?>">prev</a>
			<a href="<?=$GLOBALS['config']['base_url'].'games/overview/'.($page+1).$searchpar ?>">next</a>
		</div>
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<br>
		</div>
	</div>
</div>
			
