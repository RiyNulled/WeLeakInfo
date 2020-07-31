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
                                        <h1 class="h2 mb-2">API</h1>
                                    </div>
                                    <div class="row no-gutters justify-content-center">
                                    </div>                             
<div id="accordion">
    <div class="card ">
       <div class="card-header">
         <a class="card-link" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
          API Examples
        </a>
      </div>
      <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
        <div class="card-body">
                                        API LINK: https://gg.trejfdsjksdjfjvds.xyz/api<br>
                                        Example checking: https://gg.trejfdsjksdjfjvds.xyz/api?value=testm&type=email&key=YOUR KEY<br>
                                        Need type parametrs: value (Nickname, email, etc), type (now you can use only email), key (your api key from profile page)<br>
                                        <strong>DECODER API FROM ELITE!</strong>
                                        Example decoding: https://gg.trejfdsjksdjfjvds.xyz/api?value=cda7a650c5856cf2f6738072447d7825&type=decode&key=YOUR KEY<br>
        </div>
                                    
                                
                            </div>
                        </div>
        <div class="card ">
       <div class="card-header">
         <a class="card-link" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
          Errors
        </a>
      </div>
      <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
        <div class="card-body">
       	Can't connect to DB. Contact support - You need contact with support.<br>
       	Please fill all input data - You need type all parametrs (value, type, key)<br>
       	Invalid key - You try use invalid key, please check key and remove spaces.<br>
       	Access to API from Pro - You have plan lower than Pro, please buy upgrade.<br>
       	Plan expired - Your plan expired, please recharge it.<br>
       	Result not found - Result not found, try use another query.<br>
       	Invalid type - You use invalid type. Now you can use only 'email' type
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