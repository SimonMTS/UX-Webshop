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
                    <form action="" method="post" name="rating">
                        <input class="form-control" type="hidden" placeholder="Rating" name="game[rating]" required>
                    </form>
                </div>
                <span class="stars">
                    <?php for ($i=0;$i<5;$i++) : ?>
                        <i class="fa fa-star star<?=$i ?> <?php if ($i < round($rating)) : ?>active<?php endif; ?>" aria-hidden="true"></i>
                    <?php endfor; ?>
                </span>
            </div>
        </div>
    </div>
</div>