<?php
include 'system/content.php';
if(!isset($_SESSION['username'])) {
    header('Location: login');
}
if($_SESSION['license'] == "user") {
	header('Location: pricing');
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
                                        <h1 class="h2 mb-2">Hash Brute</h1>
                                        <span>Help you with decoding hashes</span>
                                    </div>
                                    <div class="row no-gutters justify-content-center">
                                    <?php
                                    if(isset($_POST['go'])) {
                                    $hash = mysqli_real_escape_string($db, $_POST['hash']);
                                    if(empty($hash)) {
                                        $error = '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-danger" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Please fill query.
                                        </div></div>';
                                    }
                                    $query = hash_brute($hash);
                                    if(isset($error)) {
                                        echo $error;
                                    } else {
                                        if($query == false) {
                                        echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-warning" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Unlucky!</strong> Cant decode this hash.
                                        </div></div>';
                                        } else {
                                        echo '<div class="col-lg-16">                      
                                        <div class="alert alert-solid alert-success" role="alert">
                                        <strong><i class="fa fa-exclamation-circle"></i> Success!</strong> Password: '.$query['password'].'
                                        </div></div>';
                                        }
                                    }
                                    }
                                    ?>
                                        <form class="text-left col-lg-8" id="reedem" method="post">
                                            <div class="form-group">
                                                <input class="form-control form-control-lg " type="text" name="hash" placeholder="Hash" required autofocus>
                                            </div>
                                            <div class="text-center mt-2">
                                                <button class="btn btn-success btn-lg shadow" type="submit" name="go">Brute</button>
                                            </div>
                                        </form>
                                    </div>
<br>                                 
<div id="accordion">
    <div class="card ">
       <div class="card-header">
         <a class="card-link" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
          Supported Hash
        </a>
      </div>
      <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
        <div class="card-body">
                                        MD5, SHA256, SHA256 (AuthMe), SHA1, MYSQL5, MYSQL3, SHA512</div>
                                    
                                
                            </div>
                        </div>
                                </div>
                                </div>
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