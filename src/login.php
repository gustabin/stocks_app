<?php
if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
    setcookie('email', $_POST['email'], time() + (30 * 24 * 60 * 60));
    setcookie('password', $_POST['password'], time() + (30 * 24 * 60 * 60));
} else {
    setcookie('email', '', time() - 3600);
    setcookie('password', '', time() - 3600);
}
?>
<?php include __DIR__ . '/header.php';  ?>
    <body>
        <?php include __DIR__ . '/nav.php';  ?>
        <div class="container my-5">
        <h1>Login</h1>
            <section class="content" id="login">
                <div class="card">
                    <div class="card-body login-card-body">
                    <p class="login-box-msg">Enter the data to start your session</p>
                    <form class="form-horizontal" id="formDefault">
                        <div class="input-group mb-3">
                        <input type="email" class="form-control redondeado" placeholder="Email" name="email" id="email" required="" value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control redondeado" placeholder="Password" name="password" id="password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            <input type="checkbox" id="remember" <?php echo isset($_COOKIE['email']) ? 'checked' : ''; ?>>
                            <label for="remember">
                                Remember my data
                            </label>
                            </div>
                        </div>
                        </div>
                        <div class="row" style="padding-top: 10px">
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block" onclick="SearchUser()">Login</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </section>
        </div>
        <?php include __DIR__ . '/footer.php';  ?>
    </body>
</html>
<!-- This file is a login page that allows users to enter their email and password 
to log into the system. It also includes functionality to remember the user's email 
and password through cookies if the user selects the "Remember my data" checkbox. 
If the user logs in successfully, the system will redirect them to another page, 
and if they fail, an error message will be displayed. -->