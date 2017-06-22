<div class="container portrait">
	<div class="row">
		<div class="col-md-3 col-xs-8">
			<form method="POST">
				<div class="input-group search">
					<input name="var2" value="<?php if (isset ($_POST['search'])) { echo $_POST['search']; } ?>" type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Go!</button>
					</span>
				</div>
			</form>
		</div>
		<div class="col-md-9 col-xs-4">
			<a href="<?= $GLOBALS['config']['base_url'] ?>games/create" class="btn btn-default pull-right">add game</a>
		</div>
	</div>
	<div class="row">
		<?php foreach ($games as $game) : ?>
			<div class="col-md-4 col-sm-12 center-games">
				<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game['cover'] ?>);">
					<?php if ( isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777 ) : ?>
						<a href="<?= $GLOBALS['config']['base_url'] ?>games/edit/<?=$game['id'] ?>" class="btn edit-btn"><img src="<?= $GLOBALS['config']['base_url'] ?>assets/edit.png"></a>
						<a href="<?= $GLOBALS['config']['base_url'] ?>games/delete/<?=$game['id'] ?>" class="del">x</a>
					<?php endif; ?>
					<div class="game-info">
						<span><?=$game['name'] ?></span>
						<span><?=$game['price'] ?>,-</span>
						<a class="btn btn-default view-btn" href="<?=$GLOBALS['config']['base_url'].'games/view/'.$game['id'] ?>">view</a>
						<div></div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="row">
		<div class="col-md-2 col-md-offset-5">
			<a href="<?=$GLOBALS['config']['base_url'].'games/overview/'.($page-1).$searchpar ?>" class="<?php if ($page == 1) : ?>disabled<?php endif; ?>">previous</a>
			<a href="<?=$GLOBALS['config']['base_url'].'games/overview/'.($page+1).$searchpar ?>" class="pull-right">next</a>
		</div>
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<br>
		</div>
	</div>
</div>
