<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game->cover ?>);">
    <span><?=$game->name ?></span>
    <span><?=$game->price ?>,-</span>
    <?php if ( isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777 ) : ?>
        <a href="<?= $GLOBALS['config']['base_url'] ?>games/edit/<?=$game->id ?>" class="btn">edit</a>
    <?php endif; ?>
</div>

<a href="<?= $GLOBALS['config']['base_url'] ?>payment/setup/<?=$game->id ?>">Buy</a>