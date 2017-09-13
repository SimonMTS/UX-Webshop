<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 createpage">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="login-form">
					<?php if (isset($var[2]) && $var[2] == 'wrongadres') : ?>
						<div class=" alert alert-warning">
							<b>Warning!</b> U heeft uw adres niet correct ingevoerd
						</div>
					<?php endif; ?>
					<input class="form-control" type="text" placeholder="Gebruikersnaam" name="User[name]" autofocus required>
					<br>
					<input class="form-control" type="password" placeholder="Wachtwoord" name="User[password]" required>
					<br>
					<input class="form-control" type="password" placeholder="Wachtwoord herhalen" name="User[password_rep]" required>
					<br>
					<input class="form-control" type="file" placeholder="Profile picture" name="pic">
					<hr>
					<input class="form-control" type="text" placeholder="Voornaam" name="User[voornaam]" required>
					<br>
					<input class="form-control" type="text" placeholder="Achternaam" name="User[achternaam]" required>
					<br>
					<select class="form-control" name="User[geslacht]" required>
						<option selected disabled>Geslacht</option>
						<option value="m">Man</option>
						<option value="f">Vrouw</option>
					</select>
					<br>
					<div class="form-group">
					<div class="col-sm-4 form">
						<select class="form-control birth" name="User[geboorte_datum][0]" required>
							<?php for ($i=1; $i < 32; $i++) : ?>
								<option value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-sm-4 form">
						<select class="form-control birth" name="User[geboorte_datum][1]" required>
							<?php for ($i=1; $i < 13; $i++) : ?>
								<option value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-sm-4 form">
						<select class="form-control birth" name="User[geboorte_datum][2]" required>
							<?php for ($i=2017; $i > 1899; $i = $i - 1) : ?>
								<option value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					</div>
					<br>
					<br>	
					<div class="form-group">
						<div class="col-sm-8 form">
							<input class="form-control" type="text" placeholder="Straatnaam" name="User[adres][0]" required>
						</div>
						<div class="col-sm-4 form">
							<input class="form-control" type="text" placeholder="Huisnummer" name="User[adres][1]" required>
						</div>
					</div>
					<br>
					<br>
					<div class="form-group">
						<div class="col-sm-8 form">
							<input class="form-control" type="text" placeholder="Plaats" name="User[adres][2]" required>
						</div>
						<div class="col-sm-4 form">
							<input class="form-control" type="text" placeholder="Postcode" name="User[adres][3]" required>
						</div>
					</div>
					<br>
					<br>
					<input class="btn btn-default" type="submit" value="Register">
				</div>
			</form>
		</div>
	</div>
</div>
