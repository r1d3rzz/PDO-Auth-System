<?php

require "../init.php";

if (!$_SESSION['user']) {
    return redirect("/auth/sign_up.php");
} else {

    $user = $_SESSION['user'];

    $img = $_FILES['img'];
    $name = $_REQUEST['name'];
    $username = $_REQUEST['username'];
    $img_name = $img['name'];


    if (isset($_POST['update'])) {
        inputEmpty($name, "Name");
        inputEmpty($username, "User");

        if ($user->username != $username) {
            $existsUsername = getOne("select * from users where username=?", [$username]);
        }

        if ($existsUsername) {
            setError("Your username is Already Exists.");
        } else {
            if (!hasError()) {
                if (empty($img_name)) {
                    $img_name = $user->profile;
                } else {
                    $img_name = slug($img_name);
                    $path = "../images/" . $img_name;
                    $tmp = $img['tmp_name'];
                    move_uploaded_file($tmp, $path);
                }

                query("update users set name=?,username=?,profile=? where username='$user->username'", [
                    $name,
                    $username,
                    $img_name,
                ]);

                $updateUser = getOne("select * from users where email=?", [$user->email]);

                $_SESSION['user'] = $updateUser;

                echo "<script>alert('Update Successful')</script>";
                echo "<script>location='/users/profile.php'</script>";
                die();
            }
        }
    }

?>

    <?php require "../includes/header.php"; ?>

    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-4">
                            Edit Profile
                        </div>
                        <div>
                            <small class="text-muted">logged as <?= $user->email ?></small>
                        </div>
                    </div>
                    <div><a href="/" class="btn btn-sm btn-danger">Home</a></div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="<?= $user->name; ?>" id="name" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?= $user->username; ?>" id="username" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="img">Profile</label>
                            <input type="file" name="img" id="img" class="form-control">

                            <div class="mt-2">
                                <img src="../images/<?= $user->profile; ?>" class="border rounded" width="200" alt="">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div><input type="submit" value="Update Profile" name="update" class="btn btn-primary"></div>
                            <div><input type="reset" value="Cancel" class="btn btn-danger ms-1"></div>
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

    <?php require "../includes/header.php"; ?>

<?php } ?>