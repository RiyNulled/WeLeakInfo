<?php
include 'system/content.php';
if(isset($_SESSION['username'])) {
    header('Location: profile');
}
?>
    <?=html_header()?>
        <div class="main-container" id="main">
            <section class="space-lg">
                <div class="container">
                    <div class="row flex-md-row card card-lg">
                        <div class="col-12 col-md-7 card-body bg-secondary">
                            <div class="text-center mb-4">
                                <h1 class="h2 mb-2">Secure yourself today</h1>
                                <span>Know your vulnerabilities before your attackers</span>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-9">
                                    <?php
                                    if(isset($_POST['go'])) {
                                    $username = mysqli_real_escape_string($db, $_POST['username']);
                                    $email = mysqli_real_escape_string($db, $_POST['email']);
                                    $password = mysqli_real_escape_string($db, $_POST['password']);
                                    $rpassword = mysqli_real_escape_string($db, $_POST['rpassword']);
                                    $csrf = mysqli_real_escape_string($db, $_POST['csrf']);
                                    if($csrf !== sha1(md5($_SERVER['HTTP_USER_AGENT'].getIp()))) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Bad CSRF TOKEN, try reload page.
                                        </div></div>';
                                    }
                                    if(empty($username) || empty($email) || empty($password) || empty($rpassword)) {
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
                                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Invalid email.
                                        </div></div>';                                
                                    }
                                    if($password !== $rpassword) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Passwords do not match.
                                        </div></div>';                                          
                                    }
                                    if(mysqli_num_rows(mysqli_query($db, "SELECT * FROM `users` WHERE `username` = '".$username."'")) > 0) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Username already exist.
                                        </div></div>';                                                
                                    }
                                    if(mysqli_num_rows(mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '".$email."'")) > 0) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Email already exist.
                                        </div></div>';                                                
                                    }
                                    if(isset($error)) {
                                        echo $error;
                                    } else {
                                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                        $insert_query = mysqli_query($db, "INSERT INTO `users` (`username`, `password`, `email`, `api_key`) VALUES ('".$username."', '".$hashed_password."', '".$email."', '')");
                                        if(!$insert_query) {
                                          echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Cant register you. Contact support.
                                        </div></div>'; 
                                        die();
                                        }
                                        echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-success" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Success!</strong> Now you can login.
                                        </div></div>';
                                        echo '<meta http-equiv="refresh" content="3; url=login">';
                                    }
                                    }
                                    ?>
                                    <form method="post">
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input class="form-control form-control-lg " type="text" name="username" placeholder="Username" pattern=".{1,15}" title="Username must be between 1 to 15 characters" value="" required autofocus autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input class="form-control form-control-lg " type="email" name="email" placeholder="Email Address" pattern=".{5,50}" title="Email must be between 5 to 50 characters" value="" required autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input class="form-control form-control-lg " type="password" name="password" placeholder="Password" pattern=".{8,100}" title="Password must be between 8 to 100 characters" value="" required autocomplete="off">
                                                <small>Password must be at least 8 characters</small>
                                            </div>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input class="form-control form-control-lg " type="password" name="rpassword" placeholder="Repeat Password" pattern=".{8,100}" title="Password must be between 8 to 100 characters" value="" required autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input name="csrf" type="hidden" value="<?=sha1(md5($_SERVER['HTTP_USER_AGENT'].getIp()))?>" required>
                                                <button class="btn btn-block btn-success btn-lg shadow " name="go" type="submit">Create Account</button>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="text-small text-muted">
By clicking "Create Account" you agree to our <br><a href="tos">Terms of Service</a> and <a href="privacy">Privacy Policy</a>
</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 card-body">
                            <div>
                                <div class="mb-5 text-center">
                                    <h3 class="h2 mb-2">Features &amp; Benefits</h3>
                                </div>
                                <ul class="list-unstyled list-spacing-sm mb-4">
                                    <li class="row">
                                        <div class="col-2 col-md-1">
                                            <i class="fa fa-check h5 text-success"></i>
                                        </div>
                                        <div class="col-10">Access to the World's Fastest and Largest Data Breach Search Engine</div>
                                    </li>
                                    <li class="row align-items-center pt-1">
                                        <div class="col-2 col-md-1">
                                            <i class="fa fa-check h5 text-success"></i>
                                        </div>
                                        <div class="col-10">Access to over 7,2 billion records</div>
                                    </li>
                                    <li class="row align-items-center pt-1">
                                        <div class="col-2 col-md-1">
                                            <i class="fa fa-check h5 text-success"></i>
                                        </div>
                                        <div class="col-10">Access to over 10,000 data breaches</div>
                                    </li>
                                    <li class="row">
                                        <div class="col-2 col-md-1 pt-1">
                                            <i class="fa fa-check h5 text-success"></i>
                                        </div>
                                        <div class="col-10">Access to exclusive data breaches</div>
                                    </li>
                                    <li class="row">
                                        <div class="col-2 col-md-1 pt-1">
                                            <i class="fa fa-check h5 text-success"></i>
                                        </div>
                                        <div class="col-10">Trusted by Fortune 500 Companies</div>
                                    </li>
                                    <li class="row align-items-center">
                                        <div class="col-2 col-md-1 pt-1">
                                            <i class="fa fa-check h5 text-success"></i>
                                        </div>
                                        <div class="col-10">Trusted by Governments &amp; Militaries</div>
                                    </li>
                                    <li class="row align-items-center">
                                        <div class="col-2 col-md-1 pt-1">
                                            <i class="fa fa-check h5 text-success"></i>
                                        </div>
                                        <div class="col-10">Loved by Cybersecurity Researchers</div>
                                    </li>
                                </ul>
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