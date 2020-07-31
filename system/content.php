<?php
include('functions.php');
function html_header() { ?>
<!DOCTYPE html>
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='shortcut icon' type='image/x-icon' href='/favicon/favicon.ico' />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="title" content="We Leak Info - Data Breach Search Engine: Discover your vulnerabilities before your attackers">
<meta name="description" content="We Leak Info is the industry leading data breach search engine. We Leak Info is the top choice for Fortune 500 companies. Start offering better security with zero compromises.">
<meta name="keywords" content="weleakinfo, weleakinfo.com, we leak info, we leakinfo, weleak info, weleakinfo.to, data breach, search engine, leak check">
<title>We Leak Info - Search Engine</title>
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,400i,500" rel="stylesheet">
<link href="css/global.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/cookieconsent.min.css" rel="stylesheet">
<link href="css/all.min.css" rel="stylesheet">

</head>

<div class="nav-container" id="navbar">
<div class="bg-dark navbar-dark position-fixed" data-sticky="top">
<div class="container">
<nav class="navbar navbar-expand-lg">
<a class="navbar-brand font-weight-bold" href="/">We Leak Info</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars h4"></i></button>
<div class="collapse navbar-collapse justify-content-between" id="navbarNav">
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" href="pricing">Pricing</a>
</li>
<li class="nav-item">
<a class="nav-link" href="redeem">Redeem Plan</a>
</li>
<li class="nav-item">
<a class="nav-link" href="api">API</a>
</li>
<li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Tools</a>
                    <div class="dropdown-menu">
                        <a href="hash" class="dropdown-item">Hash Decode</a>
                    <a href="mc" class="dropdown-item">Minecraft Search </a>
                    </div>

<li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Support</a>
                    <div class="dropdown-menu">
                        <a href="mailto:weleakinfov2@protonmail.ch" class="dropdown-item">Email</a>
                        <a href="https://t.me/weleakinfosupport" class="dropdown-item">Telegram</a>
                    </div>
</li>
</ul>
<?php
if(!isset($_SESSION['username'])) { ?>
<ul class="navbar-nav">
<li class="nav-item">
<a href="login">Login</a><span>&nbsp;or&nbsp;</span>
<a href="register">Register</a>
</li>
</ul>
<? } else { ?>
<ul class="navbar-nav">
<li class="nav-item">
<a href="profile">Profile</a><span>&nbsp;or&nbsp;</span>
<a href="logout">Logout</a>
</li>
</ul>
<? } ?>
</div>
</nav>
</div>
</div>
</div>
<div class="main-container" id="main">
<section class="space-xs text-center bg-gradient text-light">
<div class="container">
<div class="row">
<div class="col">
<i class="fa fa-shield"></i>
</div>
</div>
</div>
<?php }
function footer() { ?>
<footer class="bg-gray text-light footer-long">
<div class="container">
<div class="row">
<div class="col-12 col-md-3">
<img class="col-12 mb-4 pl-0 img-fluid" src="/image/logo.png" alt="Logo">
<p class="text-muted">&copy; 2020 - We Leak Info</p>
</div>
<div class="col-12 col-md-9">
<span class="h5">World's Fastest and Largest Data Breach Search Engine</span>
<div class="row no-gutters">
<div class="col-6 col-lg-3">
<h6 class="font-weight-bold">Main</h6>
<ul class="list-unstyled">
<li>
<a href="/">Search</a>
 </li>
 <li>
<a href="hash">Hash Brute</a>
 </li>
</ul>
</div>
<div class="col-6 col-lg-3">
<h6 class="font-weight-bold">Services</h6>
<ul class="list-unstyled">
<li>
<a href="pricing">Pricing</a>
</li>
<li>
<a href="api">API</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</footer>
</div>
<script src="javascript/jquery.min.js"></script>
<script src="javascript/popper.min.js"></script>
<script src="javascript/bootstrap.js"></script>
<script src="javascript/cookieconsent.min.js"></script>
<script src="javascript/particles.min.js"></script>
<script src="javascript/smooth-scroll.polyfills.min.js"></script>
<script type="text/javascript">
<?php }
?>