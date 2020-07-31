<?php 
include 'system/content.php';
global $db;
if(isset($_SESSION['lic'])) {
if($_SESSION['lic'] == "user") {
    $license = "user";
} else {
    $license = $_SESSION['lic'];
}
} else {
    $license = "user";
}
?>
    <?=html_header()?>
        <section class="bg-dark text-white" style="padding-top: 13rem; padding-bottom: 10rem">
            <div class="bg-image" id="particles-js"></div>
            <div class="container">
                <div class="row text-center justify-content-center section-intro">
                    <div class="col-12 col-md-10 col-lg-8">
                        <h1 class="display-3">Are you secure?</h1>
                        <span class="lead">Make sure you're secure by searching through our <strong>7,239,193,912</strong> records!</span>
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
                                <div class="col">
                                    <select class="form-control form-control-lg" name="type" required>
                                    	<option value="email">Email</option>
                                    	<option value="username">Username</option>
                                    	<option value="epwd">Email by password</option>
                                    	<option value="elogin">Username by password</option>
                                    	<option value="phone">Phone (Beta)</option>
                                    	<option value="domain">Domain (Beta)</option>
                                    </select>
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
                            $type = mysqli_real_escape_string($db, $_POST['type']);
                            if(empty($text) || empty($type)) {
                                $error = '<div class="col-lg-16">                      
                                <div class="alert alert-solid alert-danger" role="alert">
                                <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Please fill query.
                                </div></div>';
                            }
                            if(!isset($_SESSION['username'])) {
                                $error = '<div class="col-lg-16">                      
                                <div class="alert alert-solid alert-danger" role="alert">
                                <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> You need register to use this.
                                </div></div>';     
                            }
                            if($_SESSION['license'] == "user") {
                            	if($type !== "email") {
                            $error = '<div class="col-lg-16">                      
                                <div class="alert alert-solid alert-danger" role="alert">
                                <strong><i class="fa fa-exclamation-circle"></i> Error!</strong> Free users can use only EMAIL type.
                                </div></div>';                     	
                            	}
                            }
                            if(isset($error)) {
                                echo $error;
                            } else {
                            switch($type) {
                            	case 'email':
                            	$search_query = c_check($text, 'email');
                            	break;
                            	case 'username':
                            	$search_query = c_check($text, 'login');
                            	break;
                            	case 'epwd':
                            	$search_query = c_check($text, 'pass_email');
                            	break;
                            	case 'elogin':
                            	$search_query = c_check($text, 'pass_login');
                            	break;
                            	case 'domain':
                            	$search_query = c_check($text, 'domain_email');
                            	break;
                            	case 'phone':
                            	$search_query = c_check($text, 'phone');
                            	break;
                            	default:
                            	$search_query = c_check($text, 'email');
                            }
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
                                        <? foreach($search_query['result'] as $row) { 
                                            $ex = explode(":", $row['line']);
                                            $str = $ex[1];
                                            if($license == "user") {
                                                $str_length = strlen($str);
                                                $str[$str_length-1] = '*';
                                                $str[$str_length-2] = '*';
                                                $str[$str_length-3] = '*';
                                                $str[$str_length-4] = '*';
                                            }
                                            ?>
                                            <tr>
                                                <th>
                                                    <?=$ex[0]?>
                                                </th>
                                                <td>
                                                    <?=$str?>
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
        <section id="features">
            <div class="container">
                <div class="row justify-content-center text-center section-intro">
                    <div class="col-12 col-md-9 col-lg-8">
                        <span class="title-decorative">Amazing Features</span>
                        <h2 class="display-4">Great features to work with</h2>
                        <span class="lead">Easy to use features to help secure your life</span>
                    </div>
                </div>
                <ul class="row feature-list">
                    <li class="col-12 col-md-4">
                        <i class="fad fa-rabbit-fast fa-3x text-orange mb-3"></i>
                        <h1 class="h5 font-weight-bold">Fast &amp; Efficient</h1>
                        <p>Fetch up to 10,000 results per page in a fraction of a millisecond. Wildcard and Regex doesn't slow us down!</p>
                    </li>
                    <li class="col-12 col-md-4">
                        <i class="fad fa-database fa-3x text-primary mb-3"></i>
                        <h1 class="h5 font-weight-bold">Extensive Data Breaches</h1>
                        <p>Gain access to an ever growing collection of over 10,000 data breaches. We constantly acquire and import new data every other week.</p>
                    </li>
                    <li class="col-12 col-md-4">
                        <i class="fad fa-fire-smoke fa-3x text-red mb-3"></i>
                        <h1 class="h5 font-weight-bold">Powerful Search Operations</h1>
                        <p>Fill in unknown parts of your query with Wildcard and Regex. Specify characters, length and more! Find all variations within seconds.</p>
                    </li>
                </ul>
                <div class="row justify-content-center text-center section-outro">
                    <div class="col-lg-4 col-md-5">
                        <h1 class="h6 font-weight-bold">Need something more?</h1>
                        <p>See how our API program can help you better secure your organization</p>
                        <a href="api">Learn More ›</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="pricing">
            <div class="container">
                <div class="row justify-content-center text-center section-intro">
                    <div class="col-12 col-md-9 col-lg-8">
                        <span class="title-decorative">Simple Pricing</span>
                        <h1 class="display-4">No hidden fees</h1>
                        <span class="lead">Great competitive pricing with amazing benefits</span>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="pricing-website" role="tab" aria-selected="true">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="card pricing card-lg">
                                    <div class="card-body">
                                        <h5>Trial</h5>
                                        <span class="display-3 price-collapse collapse show">$2</span>
                                        <span class="h6">Includes:</span>
                                        <ul class="list-unstyled">
                                            <li class="font-weight-bold">24 Hours Website Access</li>
                                            <li>Unlimited Searches</li>
                                            <li>24/7 Support</li>
                                        </ul>
                                        <a href="register">
                                            <button class="btn btn-lg btn-outline-primary mt-lg-4">Purchase</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card pricing card-lg">
                                    <div class="card-body">
                                        <h5>Simple</h5>
                                        <span class="display-3">$7</span>
                                        <span class="h6">Includes:</span>
                                        <ul class="list-unstyled">
                                            <li class="font-weight-bold">1 Week Website Access</li>
                                            <li>Unlimited Searches</li>
                                            <li>24/7 Support</li>
                                        </ul>
                                        <a href="register">
                                            <button class="btn btn-lg btn-success shadow mt-lg-4">Purchase</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="card pricing card-lg">
                                    <div class="card-body">
                                        <h5>Pro</h5>
                                        <span class="display-3">$25</span>
                                        <span class="h6">Includes:</span>
                                        <ul class="list-unstyled">
                                            <li class="font-weight-bold">1 Month Website Access</li>
                                            <li>Unlimited Searches</li>
                                            <li>API Access</li>
                                            <li>24/7 Support</li>
                                        </ul>
                                        <a href="register">
                                            <button class="btn btn-lg btn-outline-primary mt-lg-4">Purchase</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card pricing">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4 mt-lg-3">
                                                <h5>Elite</h5>
                                                <h1 style="font-weight: 400">$70</h1>
                                            </div>
                                            <div class="col-md-6 col-lg-4 mt-lg-2">
                                                <h5>Includes:</h5>
                                                <span class="h6"><span class="font-weight-bold">3 Months Website Access</span>, Unlimited Searches, API Access, 24/7 Support</span>
                                            </div>
                                            <div class="col-md-6 col-lg-4 mt-lg-2">
                                                <a href="register">
                                                    <button class="btn btn-lg btn-primary shadow mt-lg-4">Purchase</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-gradient p-0 text-white">
            <svg class="decorative-divider" preserveaspectratio="none" viewbox=" 0 0 100 100">
                <polygon fill="#F8F9FB" points="0 0 100 0 100 100"></polygon>
            </svg>
            <div class="container space-lg">
                <div class="row text-center">
                    <div class="col">
                        <h3 class="h1">Start securing yourself today</h3>
                        <a <a href="register"> <button class="btn btn-lg btn-success shadow">Register Now</button> </a
                                     
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