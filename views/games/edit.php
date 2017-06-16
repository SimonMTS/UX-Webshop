<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 createpage">
            <form action="" method="post" enctype="multipart/form-data">
                Name: 
                <input class="form-control" type="text" placeholder="name" name="game[name]" value="<?=$game->name ?>">
                <br>
                Price: 
                <input class="form-control" type="text" placeholder="price" name="game[price]" value="<?=$game->price ?>">
                <br>
                Description: 
                <input class="form-control" type="text" placeholder="description" name="game[descr]" value="<?=$game->descr ?>">
                <br>
                Cover: 
                <input class="form-control" type="file" placeholder="Cover" name="cover">
                <br>
                <input class="btn" type="submit" value="Edit">
                <br>
            </form>
        </div>
	</div>
</div>
