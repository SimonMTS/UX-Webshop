<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].'assets/noPicture.png' ?>);">
    <span><?=$_SESSION['user']['name'] ?></span>
    <span><?=user::role($_SESSION['user']['role']) ?></span>
    <a href="<?= $GLOBALS['config']['base_url'] ?>users/edit/<?=$_SESSION['user']['_id'] ?>" class="btn">edit</a>
</div>

<?php if ($_SESSION['user']['role'] == 2) : ?>
    <div class="overview-item">
        <a href="<?= $GLOBALS['config']['base_url'] ?>docs/create" class="btn">add document</a>
    </div>
<?php endif; ?>

<?php foreach ($docs as $doc) :?>
    <div class="overview-item">
        <span><?=$doc['name'] ?></span>
        <a href="<?= $GLOBALS['config']['base_url'] . $doc['path'] ?>" class="btn" target="_blank">view</a>
        <a href="<?= $GLOBALS['config']['base_url'] ?>docs/delete/<?=$doc['_id'] ?>" class="del">x</a>
    </div>

<?php endforeach; ?>
