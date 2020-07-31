<?php
include 'system/content.php';
if(!isset($_SESSION['username'])) {
    header('Location: login');
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
                                        <h1 class="h2 mb-2">Reedem code</h1>
                                        <span>Buy code to redeem</span>
                                    </div>
                                    <div class="row no-gutters justify-content-center">
                                    <?php
                                    if(isset($_POST['go'])) {
                                    $code = mysqli_real_escape_string($db, $_POST['code']);
                                    if(empty($code)) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Please fill in all fields.
                                        </div></div>';
                                    }
                                    $query = mysqli_query($db, "SELECT * FROM `codes` WHERE `code` = '".$code."'");
                                    if(mysqli_num_rows($query) < 1) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Invalid code.
                                        </div></div>';                                           
                                    } 
                                    if(isset($error)) {
                                        echo $error;
                                    } else {
                                        $fetch = mysqli_fetch_assoc($query);
                                        $plan = $fetch['plan'];
                                        if($plan == "Trial") {
                                            $durationtime = '+1 day';
                                        }elseif($plan == "Simple") {
                                            $durationtime = '+7 day';
                                        }elseif($plan == "Pro") {
                                            $durationtime = '+30 day';
                                        }elseif($plan == "Elite")  {
                                            $durationtime = '+91 day';
                                        }else{
                                            die("UNKNOWN PLAN");
                                        }
                                        $expdate = strtotime($durationtime, time());
                                        mysqli_query($db, "UPDATE `users` SET `license` = '".$plan."', `expire` = ".$expdate." WHERE `username` = '".$_SESSION['username']."'");
                                        mysqli_query($db, "DELETE FROM `codes` WHERE `code` = '".$code."'");
                                        echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-success" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Success!</strong> Code activated. Your plan: '.$plan.'
                                        </div></div>';
                                        echo '<meta http-equiv="refresh" content="3; url=/">';
                                    }
                                    }
                                    ?>
                                        <form class="text-left col-lg-8" id="reedem" method="post">
                                            <div class="form-group">
                                                <input class="form-control form-control-lg " type="text" name="code" placeholder="Code" required autofocus>
                                            </div>
                                            <div class="text-center mt-2">
                                                <button class="btn btn-success btn-lg shadow" type="submit" name="go">Reedem</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <span class="text-small">Don't have a code? <a href="/pricing">Buy it</a></span>
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