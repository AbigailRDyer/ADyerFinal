<center>
    <?php
    if (isPostRequest()) {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if (isValidPassword($password)) {
            createUser($email, $password);
            if (createUser($email, $password)) {
                ?>
                <h3>User Created</h3><br/>
                <button class="btn btn-default" onClick="location.href = 'index.php'">Sign In</button>
                <?php
            }
        } else {
            echo "Password must be 4 or more";
        }
    }
    ?>
<div class="text-success">
    <h2>Create New User</h2></div><br />
    <form method="post" action="#">    
        <input type="email" name="email" placeholder="Email" value="" required/>
        <br /><br />
        <input type="password" name="password" placeholder="Password" value="" required/>
        <br /><br />
        <input class="btn btn-success" type="submit" value="Create Account" />
    </form><br /><br />
    <button class="btn btn-sm" onClick="location.href = 'index.php'">Back</button>
</center>

