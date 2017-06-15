<div class="container portrait">
	<div class="row">
		<div class="col-lg-3">
			<form method="POST">
				<div class="input-group search">
					<input name="var2" value="<?php if (isset ($_GET['var2'])) { echo $_GET['var2']; } ?>" type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Go!</button>
					</span>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<?php if ( isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777 ) : ?>
			<div class="col-md-3 col-sm-6">
				<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/user.png' ?>);">
					<a href="<?= $GLOBALS['config']['base_url'] ?>games/create" class="btn">add game</a>
				</div>
			</div>
		<?php endif; ?>
		<?php foreach ($games as $game) : ?>
			<div class="col-md-3 col-sm-6">
				<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game['cover'] ?>);">
					<span><?=$game['name'] ?> - <a href="<?=$GLOBALS['config']['base_url'].'games/view/'.$game['id'] ?>">view</a></span>
					<span><?=$game['price'] ?>,-</span>
					<?php if ( isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777 ) : ?>
						<a href="<?= $GLOBALS['config']['base_url'] ?>games/edit/<?=$game['id'] ?>" class="btn">edit</a>
						<a href="<?= $GLOBALS['config']['base_url'] ?>games/delete/<?=$game['id'] ?>" class="del">x</a>
					<?php endif; ?>
				</div>
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