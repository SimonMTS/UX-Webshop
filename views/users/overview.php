<div class="container portrait">
	<div class="row">
		<div class="col-md-3 col-xs-8">
			<form method="POST">
				<div class="input-group search">
					<input name="var2" value="<?php if (isset ($var[3])) { echo $var[3]; } ?>" type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Go!</button>
					</span>
				</div>
			</form>
		</div>
		<div class="col-md-9 col-xs-4">
			<a href="<?= $GLOBALS['config']['base_url'] ?>users/create" class="btn btn-default pull-right">add user</a>
		</div>
	</div>
	<div class="row">
		<hr class="hr-mar">
	</div>
	<div class="row">
		<?php foreach ($users as $key => $user) : ?>
			<div class="col-md-5 <?php if (!(floor($key/2) == ($key/2))) : ?>col-md-offset-2<?php endif; ?> user-list-item">
				<a class="view" href="<?=$GLOBALS['config']['base_url'].'users/view/'.$user['id'] ?>">
					<div style="background-image: url(<?=$GLOBALS['config']['base_url'].$user['pic'] ?>);" class="img"></div>
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
		<div class="col-md-2 col-md-offset-5">
			<a href="<?=$GLOBALS['config']['base_url'].'users/overview/'.($page-1).$searchpar ?>" class="<?php if ($page == 1) : ?>disabled<?php endif; ?>">previous</a>
			<a href="<?=$GLOBALS['config']['base_url'].'users/overview/'.($page+1).$searchpar ?>" class="pull-right">next</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<br>
		</div>
	</div>
</div>
			
