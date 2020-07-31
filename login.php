<?php
include 'system/content.php';
if(isset($_SESSION['username'])) {
    header('Location: profile');
}
?>
    <?=html_header()?>
        <div class="main-container" id="main">
            <section class="space-lg">
                <div class="container align-self-start">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8 col-lg-7">
                            <div class="card card-lg text-center">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h1 class="h2 mb-2">Login</h1>
                                        <span>Enter your credentials below to continue</span>
                                    </div>
                                    <div class="row no-gutters justify-content-center">
                                    <?php
                                    if(isset($_POST['go'])) {
                                    $username = mysqli_real_escape_string($db, $_POST['username']);
                                    $password = mysqli_real_escape_string($db, $_POST['password']);
                                    $csrf = mysqli_real_escape_string($db, $_POST['csrf']);
                                    if($csrf !== sha1(md5($_SERVER['HTTP_USER_AGENT'].getIp()))) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Bad CSRF TOKEN, try reload page.
                                        </div></div>';
                                    }
                                    if(empty($username) || empty($password)) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Please fill in all fields.
                                        </div></div>';
                                    }
                                    if(strlen($password) < 8) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Password must be at least 8 characters.
                                        </div></div>';  
                                    }
                                    $query = mysqli_query($db, "SELECT * FROM `users` WHERE `username` = '".$username."'");
                                    if(mysqli_num_rows($query) > 0) {
                                        $row = mysqli_fetch_assoc($query);
                                        if (!password_verify($password, $row['password'])) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Invalid password.
                                        </div></div>';     
                                        }                                         
                                    } else {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Invalid username.
                                        </div></div>';       
                                    }
                                    if(isset($error)) {
                                        echo $error;
                                    } else {
                                        $_SESSION['username'] = $username;
                                        echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-success" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Success!</strong> You authorised.
                                        </div></div>';
                                        echo '<meta http-equiv="refresh" content="3; url=index">';
                                    }
                                    }
                                    ?>
                                        <form class="text-left col-lg-8" id="login" method="post">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input class="form-control form-control-lg " type="text" name="username" placeholder="Username" required autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <a class="float-right" href="forgot"><span class="text-small">Forgot password?</span></a>
                                                <input class="form-control form-control-lg " type="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="text-center mt-2">
                                                <input name="csrf" type="hidden" value="<?=sha1(md5($_SERVER['HTTP_USER_AGENT'].getIp()))?>" required>
                                                <button class="btn btn-success btn-lg shadow" type="submit" name="go">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <span class="text-small">Don't have an account yet? <a href="register">Create one</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?=footer()?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.nav-container').css('min-height', '64px');
                        $('[data-toggle="tooltip"]').tooltip();
                        var scroll = new SmoothScroll('a[href*="#"]');
                    });
                </script>
                </body>
</html>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e2738d7daaca76c6fcf2b59/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->