<div class="container portrait">
	<div class="row">
		<div class="col-md-3 col-xs-8">
			<form method="POST">
				<div class="input-group search">
					<input name="var2" value="<?php if (isset ($var[3])) { echo $var[3]; } ?>" type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Go!</button>
					</span>
				</div>
			</form>
		</div>
		<div class="col-md-9 col-xs-4">
			<a href="<?= $GLOBALS['config']['base_url'] ?>games/create" class="btn btn-default pull-right">add game</a>
		</div>
	</div>
	<div class="row">
		<?php foreach ($games as $game) : ?>
			<div class="col-md-4 col-sm-12 center-games">
				<div class="overview-item" style="background-image: url(<?=$GLOBALS['config']['base_url'].$game['cover'] ?>);">
					<?php if ( isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777 ) : ?>
						<a href="<?= $GLOBALS['config']['base_url'] ?>games/edit/<?=$game['id'] ?>" class="btn edit-btn"><img src="<?= $GLOBALS['config']['base_url'] ?>assets/edit.png"></a>
						<a href="<?= $GLOBALS['config']['base_url'] ?>games/delete/<?=$game['id'] ?>" class="del">x</a>
					<?php endif; ?>
					<div class="game-info">
						<span><?=$game['name'] ?></span>
						<span><?=$game['price'] ?>,-</span>
						<a class="btn btn-default view-btn" href="<?=$GLOBALS['config']['base_url'].'games/view/'.$game['id'] ?>">view</a>
						<div></div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="row">
		<div class="col-md-2 col-md-offset-5">
			<a href="<?=$GLOBALS['config']['base_url'].'games/overview/'.($page-1).$searchpar ?>" class="<?php if ($page == 1) : ?>disabled<?php endif; ?>">previous</a>
			<a href="<?=$GLOBALS['config']['base_url'].'games/overview/'.($page+1).$searchpar ?>" class="pull-right">next</a>
		</div>
		<div class="col-md-12">
			<br>
			<br>
			<br>
			<br>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure about that?</h4>
      </div>
      <div class="modal-body">
        <video  width="100%" id="myVideo">
  			<source src="<?=$GLOBALS['config']['base_url'] ?>/assets/3NuuOAn.mp4" type="video/mp4">>
		</video>
		<audio id="myAudio">
  			<source src="<?=$GLOBALS['config']['base_url'] ?>/assets/areyousure.mp3" type="audio/mp4">>
		</audio>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="window.location.href='<?=$GLOBALS['config']['base_url'] ?>'">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>