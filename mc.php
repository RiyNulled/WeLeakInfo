<?php 
include 'system/content.php';
global $db;
if(!isset($_SESSION['username'])) {
	header("Location: login");
	die();
}
?>
    <?=html_header()?>
        <section class="bg-dark text-white" style="padding-top: 13rem; padding-bottom: 10rem">
            <div class="bg-image" id="particles-js"></div>
            <div class="container">
                <div class="row text-center justify-content-center section-intro">
                    <div class="col-12 col-md-10 col-lg-8">
                        <h1 class="display-3">Minecraft Search</h1>
                        <span class="lead">This tool can help you with find minecraft usernames</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-9">
                        <form class="card card-sm" id="search" method="POST">
                            <div class="card-body row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fa fa-search text-secondary"></i>
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-lg form-control-borderless" name="query" type="text" placeholder="Enter your query here" required autofocus autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-lg btn-success" type="submit" name="go">Search</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST['go'])) {
                            $start = microtime(true);
                            $text = mysqli_real_escape_string($db, $_POST['query']);
                            if(empty($text)) {
                                $error = '<div class="col-lg-16">                      
                                <div class="alert alert-solid alert-danger" role="alert">
                                <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Please fill query.
                                </div></div>';
                            }
                            if(isset($error)) {
                                echo $error;
                            } else {
                            	$search_query = mcc_check($text);
                            	if($search_query == false) {
                            	$error2 = '<div class="col-lg-16">                      
                                <div class="alert alert-solid alert-warning" role="alert">
                                <strong><i class="fa fa-exclamation-circle"></i></strong> No entries found.
                                </div></div>';                            	
                            	}
                            if(isset($error2)) {
                                echo $error2;
                            } else {
                                $time = microtime(true) - $start;
                             ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive pricing">
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? foreach($search_query as $row) { 
                                            ?>
                                            <tr>
                                                <th>
                                                    <?=$row['username']?>
                                                </th>
                                                <td>
                                                    <?=$row['password']?>
                                                </td>
                                            </tr>
                                            <? } ?>
                                    </tbody>
                                </table>
                                <?php
                                if($search_query == true && $search_query['found'] > 0) { ?>
                                <div class="card">
					<div class="card-header text-white bg-gradient"> <span><?=$search_query['found']?> results in <?=$time?> sec</span></div></div>
                                <? } ?>
                            </div>
                            <? }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
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