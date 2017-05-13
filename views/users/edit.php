
<form action="" method="post">
    Username: <input class="form" type="text" name="user[name]" value="<?=$user->name ?>">
    <br>
    <input class="form" type="text" placeholder="Password" name="user[password]">
    <br>
    <input class="form" type="text" placeholder="Repeat password" name="user[passwordrep]">
    <br>
    Firstname:
    <input class="form" type="text" placeholder="Firstname" name="user[firstname]" value="<?=$user->firstname ?>">
    <br>
    Lastname:
    <input class="form" type="text" placeholder="Lastname" name="user[lastname]" value="<?=$user->lastname ?>">
    <br>
    Age:
    <input class="form" type="number" placeholder="Age" name="user[age]" value="<?=$user->age ?>">
    <br>
    Gender:
    <select class="form" name="user[gender]">
        <option <?php if ($user->gender == 'm') echo 'selected'; ?> value="male">Male</option>
        <option <?php if ($user->gender == 'f') echo 'selected'; ?> value="female">Female</option>
    </select>
    <br>
    <?php if ($user->class_code != false) : ?>
        Class code:
        <input class="form" type="text" placeholder="Class code" name="user[class_code]" value="<?=$user->class_code ?>">
        <br>
    <?php endif; if ($user->child_id != false) : ?>
        Parent of:
        <select class="form" name="user[child_id]">
            <?php foreach ($students as $student) { ?>
                <option <?php if ($student['_id'] == $user->child_id) echo 'selected' ?> value="<?=$student['_id'] ?>"><?=$student['firstname'] ?> - <?=$student['lastname'] ?></option>
            <?php } ?>
        </select>
        <br>
    <?php endif; ?>
    <input class="btn" type="submit" value="Edit">
    <br>
    <br>
</form>
