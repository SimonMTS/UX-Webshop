<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 createpage">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="login-form">
					<input class="form-control" type="text" placeholder="Gebruikersnaam" name="user[name]" autofocus required>
					<br>
					<input class="form-control" type="password" placeholder="Wachtwoord" name="user[password]" required>
					<br>
					<input class="form-control" type="password" placeholder="Wachtwoord herhalen" name="user[passwordrep]" required>
					<br>
					<input class="form-control" type="file" placeholder="Profile picture" name="pic">
					<hr>
					<input class="form-control" type="text" placeholder="Voornaam" name="user[voornaam]" required>
					<br>
					<input class="form-control" type="text" placeholder="Achternaam" name="user[achternaam]" required>
					<br>
					<select class="form-control" name="user[geslacht]" required>
						<option selected disabled>Geslacht</option>
						<option value="m">Man</option>
						<option value="f">Vrouw</option>
					</select>
					<br>
					<div class="form-group">
					<div class="col-sm-4 form">
						<select class="form-control birth" name="user[geboorte_datum][0]" required>
							<?php for ($i=1; $i < 32; $i++) : ?>
								<option value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-sm-4 form">
						<select class="form-control birth" name="user[geboorte_datum][1]" required>
							<?php for ($i=1; $i < 13; $i++) : ?>
								<option value="<?=$i ?>"><?=$i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="col-sm-4 form">
						<select class="form-control birth" name="user[geboorte_datum][2]" required>
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
							<input class="form-control" type="text" placeholder="Straatnaam" name="user[adres][0]" required>
						</div>
						<div class="col-sm-4 form">
							<input class="form-control" type="text" placeholder="Huisnummer" name="user[adres][1]" required>
						</div>
					</div>
					<br>
					<br>
					<div class="form-group">
						<div class="col-sm-8 form">
							<input class="form-control" type="text" placeholder="Plaats" name="user[adres][2]" required>
						</div>
						<div class="col-sm-4 form">
							<input class="form-control" type="text" placeholder="Postcode" name="user[adres][3]" required>
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
