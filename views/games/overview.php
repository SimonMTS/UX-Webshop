<?php if ($_SESSION['user']['role'] == 777) : ?>
<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/user.png' ?>);">
    <a href="<?= $GLOBALS['config']['base_url'] ?>games/create" class="btn">add game</a>
</div>
<?php endif; ?>

<?php foreach ($Cvar['games'] as $game) : ?>
    <div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game['cover'] ?>);">
        <span><?=$game['name'] ?></span>
        <span><?=$game['price'] ?></span>
        <a href="<?= $GLOBALS['config']['base_url'] ?>games/edit/<?=$game['id'] ?>" class="btn">edit</a>
        <a href="<?= $GLOBALS['config']['base_url'] ?>games/delete/<?=$game['id'] ?>" class="del">x</a>
    </div>
<?php endforeach; ?>
