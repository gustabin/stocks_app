<?php include __DIR__ . '/header.php';  ?>
    <body> 
        <?php include __DIR__ . '/nav.php';  ?>
        <div class="container my-5">
            <h1>Create user</h1>
            <section class="content" id="login">
                <div class="card">
                    <div class="card-body login-card-body">
                    <p class="login-box-msg">Please complete all the data</p>
                    <form class="form-horizontal" id="formDefault">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control redondeado" placeholder="Name" name="name" id="name" required="" value="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control redondeado" placeholder="Email" name="email" id="email" required="" value="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control redondeado" placeholder="Password" name="password" id="password" value="" required="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 10px">
                            <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block" onclick="CreateUser()">Login</button>    
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
<!-- The file create.php is a PHP file that includes the header, navigation, 
and footer files to create a webpage for creating a new user. It contains a 
form with input fields for name, email, and password, and a button to submit 
the form. When the button is clicked, it calls a JavaScript function named 
"CreateUser()". -->