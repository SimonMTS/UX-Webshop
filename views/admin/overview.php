<div class="container">
	<div class="row">
        <div class="col-md-6">
            <div class="admin-item">
                <h2>Games</h2>
            </div> 
            <?php foreach ($games as $game) : ?>
                <div class="admin-item">
                    <a href="<?=$GLOBALS['config']['base_url'].'admin/info/'.$game['id'] ?>"><?=$game['name'] ?></a>
                </div>                    
            <?php endforeach; ?>
            <div class="admin-item">
                < 1 2 3 4 5 >
            </div> 
        </div>
        <div class="col-md-6">
            <div class="admin-item">
                <h2>Users</h2>
            </div> 
            <?php foreach ($users as $user) : ?>
                <div class="admin-item">
                    <a href="<?=$GLOBALS['config']['base_url'].'users/view/'.$user['id'] ?>"><?=$user['name'] ?></a>
                </div>                    
            <?php endforeach; ?>
            <div class="admin-item">
                < 1 2 3 4 5 >
            </div> 
        </div>
    </div>
</div>