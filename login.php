<?php
session_start();
?>
<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <?php
            /*if (isset($_SESSION['status'])) {
                echo "<h4 class='alert alert-success'>" . $_SESSION['status'] . "</h4>";
                unset($_SESSION['status']);
            }*/
            ?>
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Login Form</h4>
                </div>
                <div class="card-body">
                    <form action="logincode.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="login_now_btn" class="btn btn-primary">Login Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->

<?php
echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">';
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>';
echo '</head>';
echo '<body>';
echo '';
echo '<div class="container">';
echo '<div class="row justify-content-center">';
echo '<div class="col-md-4">';
/*if (isset($_SESSION['status'])) {
    echo "<h4 class='alert alert-success'>" . $_SESSION['status'] . "</h4>";
    unset($_SESSION['status']);
}*/
echo '<div class="card mt-4">';
echo '<div class="card-header">';
echo '<h4>Login Form</h4>';
echo '</div>';
echo '<div class="card-body">';
echo '<form action="logincode.php" method="POST">';
echo '<div class="form-group mb-3">';
echo '<label for="">Email Address</label>';
echo '<input type="email" name="email" class="form-control">';
echo '</div>';
echo '<div class="form-group mb-3">';
echo '<label for="">Password</label>';
echo '<input type="password" name="pass" class="form-control">';
echo '</div>';
echo '<div class="form-group mb-3">';
echo '<button type="submit" name="login_now_btn" class="btn btn-primary">Login Now</button>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '';
echo '</body>';
echo '</html>';
?>