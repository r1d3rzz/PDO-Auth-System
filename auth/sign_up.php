<?php

require "../init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $img = $_FILES['img'];
    $name = $_REQUEST['name'];
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $img_name = $img['name'];

    inputEmpty($name, "Name");
    inputEmpty($username, "Username");
    inputEmpty($email, "Email");
    inputEmpty($password, "Password");
    inputEmpty($img_name, "Choose Profile Image");

    if (!hasError()) {
        $user = getOne("select * from users where email=?", [$email]);
        if ($user) {
            if ($user->email == $email) {
                setError('Your Email is Already Exists');
            }
        } else {
            $user = getOne("select * from users where username=?", [$username]);
            if ($user->username == $username) {
                setError("Your username is Already Exits");
            } else {
                $img_name = slug($img['name']);
                $path = "../images/" . $img_name;
                $tmp = $img['tmp_name'];

                $user = query('insert into users (name,username,email,password,profile) values (?,?,?,?,?)', [
                    $name,
                    $username,
                    $email,
                    password_hash($password, PASSWORD_BCRYPT),
                    $img_name,
                ]);
                move_uploaded_file($tmp, $path);
                echo "<script>alert('Sign Up Successful')</script>";
                echo "<script>location = '/auth/login.php'</script>";
            }
        }
    }
}

?>


<?php require "../includes/header.php"; ?>

<div class="row">
    <div class="col-md-6 mx-auto mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fs-3">Sign Up</div>
                <div><a href="/" class="btn btn-sm btn-danger">Home</a></div>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="img">Profile</label>
                        <input type="file" name="img" id="img" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">If you have already account <a href="/auth/login.php">login</a> here.</div>
                        <div><input type="submit" value="Sign Up" class="btn btn-primary"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Error Messages -->
    <?php

    if (hasError()) { ?>

        <div class="col-md-6 mt-5">
            <?= showError(); ?>
        </div>

    <?php }

    ?>
    <!-- End Error Messages -->
</div>

<?php require "../includes/footer.php"; ?>