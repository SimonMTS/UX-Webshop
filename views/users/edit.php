<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 createpage">
            <form action="" method="post" enctype="multipart/form-data">
				<div class="login-form">
					<?php if (isset($var[4]) && !empty($var[3]) && isset($var[3]) && $var[3] == 'warn') : ?>
						<div class=" alert alert-warning">
							<b>Warning!</b> <?=str_replace('%20', ' ', $var[4]) ?>
						</div>
					<?php endif; ?>
					<input class="form-control" type="text" placeholder="Gebruikersnaam" name="user[name]" value="<?=$user->name ?>" required>
					<br>
					<input class="form-control" type="password" placeholder="Wachtwoord" name="user[password]">
					<br>
					<input class="form-control" type="password" placeholder="Wachtwoord herhalen" name="user[passwordrep]">
					<br>
					<input class="form-control" type="file" placeholder="Profile picture" name="pic">
					<hr>
					<input class="form-control" type="text" placeholder="Voornaam" name="user[voornaam]" value="<?=$user->voornaam ?>" required>
					<br>
					<input class="form-control" type="text" placeholder="Achternaam" name="user[achternaam]" value="<?=$user->achternaam ?>" required>
					<br>
					<select class="form-control" name="user[geslacht]" required>
						<option selected disabled>Geslacht</option>
						<option <?php if ( $user->geslacht == 'm') : ?>selected<?php endif; ?> value="m">Man</option>
						<option <?php if ( $user->geslacht == 'f') : ?>selected<?php endif; ?> value="f">Vrouw</option>
					</select>
					<br>
					<div class="form-group">
					<div class="col-sm-4 form">
						<select class="form-control birth" name="user[geboorte_datum][0]" required>
							<?php for ($i=1; $i < 32; $i++) : ?>
								<option <?php if (explode('/', $user->geboorte_datum)[0] == $i) : ?>selected<?php endif; ?> value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-sm-4 form">
						<select class="form-control birth" name="user[geboorte_datum][1]" required>
							<?php for ($i=1; $i < 13; $i++) : ?>
								<option <?php if (explode('/', $user->geboorte_datum)[1] == $i) : ?>selected<?php endif; ?> value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-sm-4 form">
						<select class="form-control birth" name="user[geboorte_datum][2]" required>
							<?php for ($i=2017; $i > 1899; $i = $i - 1) : ?>
								<option <?php if (explode('/', $user->geboorte_datum)[2] == $i) : ?>selected<?php endif; ?> value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					</div>
					<br>
					<br>	
					<div class="form-group">
						<div class="col-sm-8 form">
							<input class="form-control" type="text" placeholder="Straatnaam" name="user[adres][0]" value="<?=explode(', ', $user->adres)[0] ?>" required>
						</div>
						<div class="col-sm-4 form">
							<input class="form-control" type="text" placeholder="Huisnummer" name="user[adres][1]" value="<?=explode(', ', $user->adres)[1] ?>" required>
						</div>
					</div>
					<br>
					<br>
					<div class="form-group">
						<div class="col-sm-8 form">
							<input class="form-control" type="text" placeholder="Plaats" name="user[adres][2]" value="<?=explode(', ', $user->adres)[2] ?>" required>
						</div>
						<div class="col-sm-4 form">
							<input class="form-control" type="text" placeholder="Postcode" name="user[adres][3]" value="<?=explode(', ', $user->adres)[3] ?>" required>
						</div>
					</div>
					<br>
					<br>
					<input class="btn btn-default" type="submit" value="Edit">
				</div>
			</form>
        </div>
	</div>
</div>
