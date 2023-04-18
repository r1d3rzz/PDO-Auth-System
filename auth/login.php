<?php

require "../init.php";

if ($_SESSION['user']) {
    return redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    if (empty($email)) {
        setError("Please Enter Email");
    }

    if (empty($password)) {
        setError("Please Enter Password");
    }

    if (!hasError()) {
        $user = getOne("select * from users where email=?", [$email]);

        if ($user) {
            $var = password_verify($password, $user->password);

            if ($var) {
                $_SESSION['user'] = $user;
                return redirect('/users/profile.php');
            } else {
                setError('Password is Wrong');
            }
        } else {
            setError('Email not Found');
        }
    }
}

?>

<?php require "../includes/header.php"; ?>

<div class="row">
    <div class="col-md-6 mx-auto mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="fs-3"> Login</div>
                <div><a href="/" class="btn btn-sm btn-danger">Home</a></div>
            </div>
            <div class="card-body">

                <?php
                if ($_SESSION['errors']) {
                    echo showError();
                }
                ?>

                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div><input type="submit" value="Login" class="btn btn-primary"></div>
                        <div class="text-muted">If you have not account <a href="/auth/sign_up.php">sign up</a> Here</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../includes/footer.php"; ?>