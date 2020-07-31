<?php 
include 'system/content.php';
if(!isset($_SESSION['username'])) {
	header("Location: /login");
}
$user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'"));
if($user['license'] == "user") {
	$lic_disp = "User";
} else {
	$lic_disp = $user['license'];
}
?>
    <?=html_header()?>
        <section>
            <div class="container">
            <div class="container">
                <div class="row justify-content-center text-center section-intro">
                    <div class="col-12 col-md-9 col-lg-8">
                        <span class="title-decorative">Profile</span>
                        <h1 class="display-4"><?=$_SESSION['username']?></h1>
                        <span class="lead">Your profile:</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <table class="table table-bordered table-responsive pricing">
                            <tbody>
                                <tr>
                                    <th class="align-middle" scope="row">Username</th>
                                    <td class="align-middle font-weight-bold"><?=$_SESSION['username']?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row">Email</th>
                                    <td class="align-middle font-weight-bold"><?=$user['email']?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row">License</th>
                                    <td class="align-middle font-weight-bold"><?=$lic_disp?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row">Expire date</th>
                                    <td class="align-middle font-weight-bold"><?=date('m/d/Y H:i', $user['expire'])?></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row">Api Key</th>
                                    <?php
                                    if(empty($user['api_key'])) { 
                                    if(isset($_POST['generate'])) {
                                    	    function randstring($length_of_string) {  
            									$str_result = 'QWERTYUIOPASDFGHJKLZXCVBNM'; 
        										return substr(str_shuffle($str_result), 0, $length_of_string); 
          									} 
            								$apikey = randstring(4)."-".randstring(4)."-".randstring(4)."-".randstring(4);
            								mysqli_query($db, "UPDATE `users` SET `api_key` = '".$apikey."' WHERE `username` = '".$_SESSION['username']."'");
                                    }
                                    ?>

                                    <td class="align-middle font-weight-bold"><form method="POST"><button class="btn btn-block btn-success btn-lg shadow " name="generate" type="submit">Generate Key</button></form></td>
                                    <?php } else {
                                    echo '<td class="align-middle font-weight-bold"><input disabled class="form-control " value="'.$user['api_key'].'"></td>';
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                                <div class="col-12 col-lg-9">
                                    <?php
                                    if(isset($_POST['go'])) {
                                    $password = mysqli_real_escape_string($db, $_POST['password']);
                                    $rpassword = mysqli_real_escape_string($db, $_POST['rpassword']);
                                    $csrf = mysqli_real_escape_string($db, $_POST['csrf']);
                                    if($csrf !== sha1(md5($_SERVER['HTTP_USER_AGENT'].getIp()))) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Bad CSRF TOKEN, try reload page.
                                        </div></div>';
                                    }
                                    if(empty($password) || empty($rpassword)) {
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
                                    if($password !== $rpassword) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Passwords do not match.
                                        </div></div>';                                          
                                    }
                                    if(isset($error)) {
                                        echo $error;
                                    } else {
                                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                        $insert_query = mysqli_query($db, "UPDATE `users` SET `password` = '".$hashed_password."' WHERE `username` = '".$_SESSION['username']."'");
                                        if(!$insert_query) {
                                          echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Cant change password. Contact support.
                                        </div></div>'; 
                                        die();
                                        }
                                        echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-success" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Success!</strong> Password changed.
                                        </div></div>';
                                        echo '<meta http-equiv="refresh" content="3; url=/">';
                                    }
                                    }
                                    ?>
  <div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
          Change your Password !
        </a>
      </div>
      <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
        <div class="card-body">
                                        <form method="post">
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input class="form-control form-control-lg " type="password" name="password" placeholder="Password" pattern=".{8,100}" title="New Password" value="" required="" autocomplete="off">
                                                <small>Password must be at least 8 characters</small>
                                            </div>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input class="form-control form-control-lg " type="password" name="rpassword" placeholder="Repeat Password" pattern=".{8,100}" title="Repeat New Password" value="" required="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row form-group">
                                            <div class="col">
                                                <input name="csrf" type="hidden" value="97b95a9f9e776cdcffad5a56bf0a41124b8929a8" required="">
                                                <button class="btn btn-block btn-success btn-lg shadow " name="go" type="submit">Change password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
            </div>
        </div>
        <span>Want logout? <a href="logout">Click Here ›</a></span>
        </section>
        <?=footer()?>
            <script>
                $(document).ready(function() {
                    $('.nav-container').css('min-height', '64px');
                    $('[data-toggle="tooltip"]').tooltip();
                    var scroll = new SmoothScroll('a[href*="#"]');
                });
            </script>
            <script type="text/javascript">
                var wildcard = false;
                var regex = false;
                particlesJS.load('particles-js', 'javascript/particles.json');

                $('button[name="type"]').click(function() {
                    $('button[name="type"].btn-primary').not(this).removeClass('btn-primary').addClass('btn-secondary');
                    $(this).removeClass('btn-secondary').addClass('btn-primary');
                });

                function select(elem) {
                    type = $(elem).attr('id');

                    if ($(elem).hasClass('text-warning')) {
                        $(elem).removeClass('text-warning');
                    } else {
                        $(elem).addClass('text-warning');
                    }

                    if (type === 'wildcard') {
                        wildcard = (wildcard) ? false : true;
                        regex = false;

                        if ($('#regex').hasClass('text-warning')) {
                            $('#regex').removeClass('text-warning');
                        }
                    } else if (type === 'regex') {
                        regex = (regex) ? false : true;
                        wildcard = false;

                        if ($('#wildcard').hasClass('text-warning')) {
                            $('#wildcard').removeClass('text-warning');
                        }
                    } else if (type === 'limit') {

                    }
                }

                function search() {
                    url = 'search?type=' + $('button[name="type"].btn-primary').val() + '&query=' + $('input[name="query"]').val();

                    if ($('button[name="type"].btn-primary').val() != 'domain') {
                        if (wildcard) {
                            url += '&wildcard=true';
                        } else if (regex) {
                            url += '&regex=true';
                        }
                    }

                    window.location.href = url;
                    return false;
                }
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