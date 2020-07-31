<?php 
include 'system/content.php';
?>
    <?=html_header()?>
        <section>
            <div class="container">
                <div class="row justify-content-center text-center section-intro">
                    <div class="col-12 col-md-9 col-lg-8">
                        <span class="title-decorative">Simple Pricing</span>
                        <h2 class="display-4">No hidden fees</h2>
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
                                        <a data-shoppy-product="iCrv7UG">
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
                                        <a data-shoppy-product="MSKYeye">
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
                                            <li>Unlimited Searches & API Access</li>
                                            <li>24/7 Support</li>
                                        </ul>
                                        <a data-shoppy-product="cTUNmgD">
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
                                                <a data-shoppy-product="Xli7mHB">
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
        <section>
            <div class="container">
                <div class="row justify-content-center section-intro">
                    <div class="col-auto">
                        <h2 class="h1">Frequently Asked Questions</h2>
                    </div>
                </div>
                <ul class="row feature-list feature-list-sm justify-content-center">
                    <li class="col-12 col-md-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="font-weight-bold">What payment methods do you accept?</h6>
                                <p>We currently accept Bitcoin, Bitcoin Cash, Ethereum, Litecoin, and USD Coin.</p>
                            </div>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Can I have multiple active subscriptions?</h6>
                                <p>Yes you can! New subscriptions will always be added onto your existing subscription.</p>
                            </div>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Do these grant me API access?</h6>
                                <p>Yes sure. <span class="font-weight-bold">But only the Pro and Elite plans will give you the API Access.</span> If you need to try API Access contact our support.</p>
                            </div>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Can I get a refund?</h6>
                                <p><span class="font-weight-bold">All purchases are final as stated on our TOS.</span> If you have an issue with your order please reach out to us via live chat.</p>
                            </div>
                        </div>
                    </li>
                </ul>
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
            
            <!-- Bootstrap core JavaScript-->
   <script src="https://shoppy.gg/api/embed.js"></script> 
          
            </body>

            </html>