<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/noPicture.png' ?>);">
    <span><?=$_SESSION['user']['name'] ?></span>
    <span><?=user::role($_SESSION['user']['role']) ?></span>
    <a href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$_SESSION['user']['id'] ?>" class="btn">edit</a>
</div>