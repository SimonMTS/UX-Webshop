<div class="container portrait">
    <div class="row">
        <div class="col-md-3 col-xs-8">
            <form method="POST">
                <div class="input-group search">
                    <input name="var2" value="<?php if (isset ($_POST['search'])) { echo $_POST['search']; } ?>" type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
	<div class="row">
		<?php foreach ($orders as $order) : ?>
            <?php echo $order['game_name']; ?><br>
		<?php endforeach; ?>
	</div>
	<div class="row">
		<div class="col-md-2 col-md-offset-5">
			<a href="< ?=$GLOBALS['config']['base_url'].'games/overview/'.($page-1).$searchpar ?>" class="< ?php if ($page == 1) : ?>disabled< ?php endif; ?>">previous</a>
			<a href="< ?=$GLOBALS['config']['base_url'].'games/overview/'.($page+1).$searchpar ?>" class="pull-right">next</a>
		</div>
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<br>
		</div>
	</div>
</div>
