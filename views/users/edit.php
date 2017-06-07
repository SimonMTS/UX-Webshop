<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 createpage">
            <form action="" method="post" enctype="multipart/form-data">
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
            </form>
        </div>
	</div>
</div>
