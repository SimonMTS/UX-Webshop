<div class="container-fluid">
	<div class="row hidden-xs">
		<div class="col-md-12 hp-col" style="background-image: url(<?=$GLOBALS['config']['base_url'] ?>assets/banner-rep.png);"></div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="pop-prod">Populaire producten</h1>
		</div>
		<?php foreach ($games as $game) : ?>
			<div class="col-md-3 col-sm-12 center-games">
				<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game['cover'] ?>);">
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
</div>