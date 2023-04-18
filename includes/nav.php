<div class="row">
    <div class="col-md text-center mt-5">
        <nav>

            <?php

            if ($_SESSION['user']) {
                $user = $_SESSION['user']; ?>

                <div class="mb-3">
                    <h2>Welcome <?= $user->name; ?></h2>
                </div>

                <a href="/auth/logout.php" class="btn btn-sm btn-secondary">Logout</a>
                <a href="../users/profile.php" class="btn btn-sm btn-danger">Profile</a>

            <?php } else { ?>

                <div class="mb-3">
                    <h2>Login Here</h2>
                </div>

                <a href="/auth/login.php" class="btn btn-sm btn-secondary">Login</a>
                <a href="/auth/sign_up.php" class="btn btn-sm btn-success">Sign Up</a>

            <?php }

            ?>

        </nav>
    </div>
</div>