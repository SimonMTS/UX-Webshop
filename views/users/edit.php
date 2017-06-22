<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 createpage">
            <!--<form action="" method="post" enctype="multipart/form-data">
                <input class="form-control" type="text" name="user[name]" value="<?=$user->name ?>">
                <br>
                <input class="form-control" type="password" placeholder="Password" name="user[password]">
                <br>
                <input class="form-control" type="password" placeholder="Repeat password" name="user[passwordrep]">
                <br>
                <input class="form-control" type="file" placeholder="Profile picture" name="pic">
				<br>
                <input class="btn" type="submit" value="Edit">
                <br>
            </form>-->
            <form action="" method="post" enctype="multipart/form-data">
				<div class="login-form">
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
					<select class="form-control birth" name="user[geboorte_datum][0]" required>
						<?php for ($i=1; $i < 32; $i++) : ?>
							<option <?php if ( explode('/', $user->geboorte_datum)[0] == $i) : ?>selected<?php endif; ?> value="<?=$i ?>"><?=$i ?></option>
						<?php endfor; ?>
					</select>
					<select class="form-control birth" name="user[geboorte_datum][1]" required>
						<?php for ($i=1; $i < 13; $i++) : ?>
							<option <?php if ( explode('/', $user->geboorte_datum)[1] == $i) : ?>selected<?php endif; ?> value="<?=$i ?>"><?=$i ?></option>
						<?php endfor; ?>
					</select>
					<select class="form-control birth" name="user[geboorte_datum][2]" required>
						<?php for ($i=2017; $i > 1899; $i = $i - 1) : ?>
							<option <?php if ( explode('/', $user->geboorte_datum)[2] == $i) : ?>selected<?php endif; ?> value="<?=$i ?>"><?=$i ?></option>
						<?php endfor; ?>
					</select>
					<br>
					<br>					
					<input class="form-control" type="text" placeholder="adres, bv: spoorlaan 12, 1234AB Oss Nederland" name="user[adres]" value="<?=$user->adres ?>" required>
					<br>
					<input class="btn btn-default" type="submit" value="Edit">
				</div>
			</form>
        </div>
	</div>
</div>
