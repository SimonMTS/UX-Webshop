<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$Cvar['game']->cover ?>);">
    <span><?=$Cvar['game']->name ?></span>
    <span><?=$Cvar['game']->price ?>,-</span>
    <?php if ( isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777 ) : ?>
        <a href="<?= $GLOBALS['config']['base_url'] ?>games/edit/<?=$Cvar['game']->id ?>" class="btn">edit</a>
    <?php endif; ?>
</div>