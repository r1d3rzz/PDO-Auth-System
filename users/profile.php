<?php

require "../init.php";

if (!$_SESSION['user']) {
    return redirect();
} else {
    $user = $_SESSION['user'];
?>

    <?php require "../includes/header.php"; ?>

    <div class="row">
        <div class="col-md-4 mb-3 mx-auto mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="fs-3">Profile</div>
                    <div><a href="/" class="btn btn-sm btn-primary">Home</a></div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="../images/<?= $user->profile; ?>" alt="Admin" class="rounded" width="150">
                        <div class="mt-3">
                            <h4><?= $user->name; ?></h4>
                            <p class="text-secondary mb-1"><?= $user->email; ?></p>
                            <a href="/users/edit.php?username=<?= $user->username; ?>" class="btn btn-primary">Edit</a>
                            <a onclick="return confirm('Are you sure delete your account!')" href="/users/delete.php?username=<?= $user->username; ?>" class="btn btn-outline-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require "../includes/footer.php"; ?>


<?php } ?>