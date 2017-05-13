<form action="" method="post">
    <div class="login-form">
        <input class="form " type="text" placeholder="Gebruikersnaam" name="user[name]" autofocus required>
        <br>
        <input class="form" type="password" placeholder="Wachtwoord" name="user[password]" required>
        <br>
        <input class="form" type="password" placeholder="Wachtwoord herhalen" name="user[passwordrep]" required>
        <br>
        <select class="form" name="user[role]" required>
            <option disabled selected>User type</option>
            <option value="parent">Ouder</option>
            <option value="student">Student</option>
            <?php if ($_SESSION['user']['role'] == 777) : ?>
                <option value="teacher">Leeraar</option>
                <option value="admin">Admin</option>
        <?php endif; ?>
        </select>
        <br>
        <input class="form" type="text" placeholder="Firstname" name="user[firstname]" required>
        <br>
        <input class="form" type="text" placeholder="Lastname" name="user[lastname]" required>
        <br>
        <input class="form" type="number" placeholder="Age" name="user[age]" required>
        <br>
        <select class="form" name="user[gender]" required>
            <option disabled selected>Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <br>
        <input class="form" type="text" placeholder="Class code (student and teacher only)" name="user[class_code]">
        <br>
        <select class="form" name="user[child_id]">
            <option disabled selected>Child (parent only)</option>
            <?php foreach ($students as $student) { ?>
                <option value="<?=$student['_id'] ?>"><?=$student['name'] ?></option>
            <?php } ?>
        </select>
        <br>
        <input class="btn" type="submit" value="Register">
    </div>
</form>
