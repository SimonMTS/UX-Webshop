<div class="container-fluid game-view">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-6">
                	<div class="img" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game->cover ?>);"></div>
                </div>
                <div class="col-md-6">
                    <h1><?=$game->name ?></h1>
                    <h4><?=$game->descr ?></h4>
                    <h2><?=$game->price ?>,-</h2>
                    <hr>
                    <a class="btn btn-default btn-lg" href="<?= $GLOBALS['config']['base_url'] ?>payment/setup/<?=$game->id ?>">Buy</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>