
<form action="" method="post">
    Name: 
    <input class="form" type="text" placeholder="name" name="game[name]" value="<?=$game->name ?>">
    <br>
    Price: 
    <input class="form" type="text" placeholder="price" name="game[price]" value="<?=$game->price ?>">
    <br>
    Description: 
    <input class="form" type="text" placeholder="description" name="game[descr]" value="<?=$game->descr ?>">
    <br>
    Cover: 
    <input class="form" type="text" placeholder="cover" name="game[cover]" value="<?=$game->cover ?>">
    <br>
    <input class="btn" type="submit" value="Edit">
    <br>
    <br>
</form>
