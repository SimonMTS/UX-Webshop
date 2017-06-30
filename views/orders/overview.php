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
	<div class="container">
		<div class="row">
			<div class="col-md-12 order-overview">
				<div>
					<?php if (sizeof($orders) == 0) : ?>
						<span class="no-p">Nog geen aankopen</span>
					<?php endif; ?>
					<?php foreach ($orders as $order) : ?>
						<div>
							<a class="left" href="<?=$GLOBALS['config']['base_url'].'orders/view/'.$order['id'] ?>">
								<span class="full-w-left"><?= $order['method'] ?> - See full order</span>
								<span class="paid"><?= $order['status'] ?></span>
								</a>
								<a class="right" href="<?=$GLOBALS['config']['base_url'].'orders/overview/'.$order['game_id'] ?>">
								<span class="pull-right"><?= date('d/m/Y', strtotime($order['paidDatetime']) ) ?></span><br>
								<span class="pull-right full-w"><?= $order['game_name'] ?></span>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div?
	</div>
	<div class="row">
		<div class="col-md-2 col-md-offset-5">
			<a href="< ?=$GLOBALS['config']['base_url'].'orders/overview/'.($page-1).$searchpar ?>" class="< ?php if ($page == 1) : ?>disabled< ?php endif; ?>">previous</a>
			<a href="< ?=$GLOBALS['config']['base_url'].'orders/overview/'.($page+1).$searchpar ?>" class="pull-right">next</a>
		</div>
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<br>
		</div>
	</div>
</div>
