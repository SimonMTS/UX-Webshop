<?php if ($_SESSION['user']['role'] == 777) : ?>
<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/user.png' ?>);">
    <a href="<?= $GLOBALS['config']['base_url'] ?>/users/create" class="btn">add user</a>
</div>
<?php endif; ?>

<?php foreach ($Cvar['users'] as $user) : 
    if ($user['id'] != $_SESSION['user']['id']) : ?>
    <div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/noPicture.png' ?>);">
        <span><?=$user['name'] ?></span>
        <span><?=user::role($user['role']) ?></span>
        <?php if ($_SESSION['user']['role'] == 777) : ?>
            <a href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$user['id'] ?>" class="btn">edit</a>
            <a href="<?= $GLOBALS['config']['base_url'] ?>users/delete/<?=$user['id'] ?>" class="del">x</a>
        <?php endif; ?>
    </div>
<?php endif;
 endforeach; ?>
