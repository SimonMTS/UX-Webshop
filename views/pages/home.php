<div class="container-fluid">
	<div class="row hidden-xs">
		<div class="col-md-12 hp-col">
			<img class="banner-img .hidden-sm" src="assets/img/banner.png">
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="pop-prod">Populaire producten</h1>
		</div>
		<?php foreach ($games as $game) : ?>
			<div class="col-md-3 col-sm-6">
				<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game['cover'] ?>);">
					<span><?=$game['name'] ?> - <a href="<?=$GLOBALS['config']['base_url'].'games/view/'.$game['id'] ?>">view</a></span>
					<span><?=$game['price'] ?>,-</span>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>