<?php
// Configuration variables
$cookiePass = "HivePass";
$cookieUser	= "HiveLogin";
$domain		= "http://honeyheads.me/hive";
$errorMsg	= "";
$host 		= $_SERVER['HTTP_HOST'];
$next		= "hive/desktop.php";
$postUser	= "";
$postPass	= "";
$protocol	= "http";
$redirect	= "";
$referer 	= $_SERVER['HTTP_REFERER'];
$secretName	= "";
$secretPass = "";	
$secretUser = "";
$scriptLoc 	= "/login.php";
$testUser	= "janet";
$testPass	= "dev";
$uri  		= $_SERVER['REQUEST_URI'];

// adapt protocol
if (isset($_SERVER['HTTPS'])) {
	if (strtoupper($_SERVER['HTTPS']) == 'ON') {
		$protocol = "https";
	}
}

// Prevent off-site redirect
if (isset($POST['redirect'])) {
	$redirect = preg_replace("/^\//", "", $_POST['redirect']);
	$redirect = str_replace("\n", "", $redirect);
} else {
	$redirect = $scriptLoc;
}

checkCookies($protocol, $host, $next);

if (isset($_POST['username']) && isset($_POST['password'])) {
	$postUser	= $_POST['username'];
	$postPass	= $_POST['password'];
	
	// User submits login form: process and prepare authentication cookie for destination page to authenticate.
	if (isset($_POST['remember'])) {
		setrawcookie($cookieUser, "hivelogin:" . hash_hmac("sha256", $postUser, $secretUser), time()+(60*60*24*30));
		setrawcookie($cookiePass, "hivepass:" . hash_hmac("sha256", $postPass, $secretPass), time()+(60*60*24*30));
	} else {
		setrawcookie($cookieUser, "hivelogin:" . hash_hmac("sha256", $postUser, $secretUser), false);
		setrawcookie($cookiePass, "hivepass:" . hash_hmac("sha256", $postPass, $secretPass), false);		
	}
	
	if (($postUser == $testUser) && ($postPass == $testPass)) {
		// redirect to destination page 
		header("Location: {$protocol}://".$host."/".$next);		
	}
} else {
	$errorMsg = "You must supply a valid username and password.";
}

function checkCookies($protocol, $host, $next) {
	// cookies exist, check against user
	$secret = "";
	if (isset($_COOKIE['HiveLogin']) && isset($_COOKIE['HivePass'])) {
		$testUser	= "hivelogin:" . hash_hmac("sha256", $testUser, $secret);
		$testPass	= "hivepass:" . hash_hmac("sha256", $testPass, $secret);

		if ($_COOKIE['HiveLogin'] == $testUser) {
			// redirect to destination page 
			header("Location: {$protocol}://".$host."/".$next);
		}
	}
}

?>
<html lang="en">
<head>

<meta property="og:site_name" content="hONEyheads!!" />
<meta property="og:title" content="The Hive" />
<meta property="og:description" content="Login to The Hive" />
<meta property="og:url" content="http://honeyheads.me/hive/login.php" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link rel="icon" type="image/png" href="//www.weebly.com/uploads/reseller/assets/1014-favicon.ico" />
<link id="wsite-base-style" rel="stylesheet" type="text/css" href="//cdn2.editmysite.com/css/sites.css?buildTime=1520379196" />
<link rel="stylesheet" type="text/css" href="//cdn2.editmysite.com/css/old/fancybox.css?1520379196" />
<link rel="stylesheet" type="text/css" href="/files/main_style.css?1520450519" title="wsite-theme-css" />
<link href='//fonts.googleapis.com/css?family=Actor&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<title>The Hive</title>

<style type='text/css'>
.wsite-elements.wsite-not-footer:not(.wsite-header-elements) div.paragraph, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) p, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-block .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-description, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, #wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
#wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
.wsite-elements.wsite-footer div.paragraph, .wsite-elements.wsite-footer p, .wsite-elements.wsite-footer .product-block .product-title, .wsite-elements.wsite-footer .product-description, .wsite-elements.wsite-footer .wsite-form-field label, .wsite-elements.wsite-footer .wsite-form-field label{}
.wsite-elements.wsite-not-footer:not(.wsite-header-elements) h2, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-long .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-large .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-small .product-title, #wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {}
#wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {}
.wsite-elements.wsite-footer h2, .wsite-elements.wsite-footer .product-long .product-title, .wsite-elements.wsite-footer .product-large .product-title, .wsite-elements.wsite-footer .product-small .product-title{}
#wsite-title {}
.wsite-menu-default a {}
.wsite-menu a {}
.wsite-image div, .wsite-caption {}
.galleryCaptionInnerText {}
.fancybox-title {}
.wslide-caption-text {}
.wsite-phone {}
.wsite-headline,.wsite-header-section .wsite-content-title {}
.wsite-headline-paragraph,.wsite-header-section .paragraph {}
.wsite-button-inner {}
.wsite-not-footer blockquote {}
.wsite-footer blockquote {}
.blog-header h2 a {}
#wsite-content h2.wsite-product-title {}
.wsite-product .wsite-product-price a {}
@media screen and (min-width: 767px) {.wsite-elements.wsite-not-footer:not(.wsite-header-elements) div.paragraph, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) p, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-block .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-description, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .wsite-form-field label, #wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
#wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
.wsite-elements.wsite-footer div.paragraph, .wsite-elements.wsite-footer p, .wsite-elements.wsite-footer .product-block .product-title, .wsite-elements.wsite-footer .product-description, .wsite-elements.wsite-footer .wsite-form-field label, .wsite-elements.wsite-footer .wsite-form-field label{}
.wsite-elements.wsite-not-footer:not(.wsite-header-elements) h2, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-long .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-large .product-title, .wsite-elements.wsite-not-footer:not(.wsite-header-elements) .product-small .product-title, #wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {}
#wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {}
.wsite-elements.wsite-footer h2, .wsite-elements.wsite-footer .product-long .product-title, .wsite-elements.wsite-footer .product-large .product-title, .wsite-elements.wsite-footer .product-small .product-title{}
#wsite-title {}
.wsite-menu-default a {}
.wsite-menu a {}
.wsite-image div, .wsite-caption {}
.galleryCaptionInnerText {}
.fancybox-title {}
.wslide-caption-text {}
.wsite-phone {}
.wsite-headline,.wsite-header-section .wsite-content-title {}
.wsite-headline-paragraph,.wsite-header-section .paragraph {}
.wsite-button-inner {}
.wsite-not-footer blockquote {}
.wsite-footer blockquote {}
.blog-header h2 a {}
#wsite-content h2.wsite-product-title {}
.wsite-product .wsite-product-price a {}
}</style>

<style type='text/css'>
.wsite-header {
	background-image: url(/uploads/3/6/1/9/36198146/header_images/1479409134.jpg) !important;
	background-position: 0 0 !important;
}
</style>

<script>
	var STATIC_BASE = '//cdn1.editmysite.com/';
	var ASSETS_BASE = '//cdn2.editmysite.com/';
	var STYLE_PREFIX = 'wsite';
</script>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
<script type="text/javascript" src="//cdn2.editmysite.com/js/lang/en/stl.js?buildTime=1520379196&"></script>
<script src="//cdn2.editmysite.com/js/site/main.js?buildTime=1520379196"></script><script type="text/javascript">_W.resellerSite = true;</script>
<script type="text/javascript">_W.configDomain = "www.weebly.com";</script><script>_W.relinquish && _W.relinquish()</script>
<script type="text/javascript" src="//cdn2.editmysite.com/js/lang/en/stl.js?buildTime=1520379196&"></script>
<script> _W.themePlugins = [];</script>
<script type="text/javascript"> _W.recaptchaUrl = "https://www.google.com/recaptcha/api.js"; </script>
<script type="text/javascript"> window._W = window._W || {}; _W.showV2Footer = 0; </script>

<script type="text/javascript"><!--
	function initFlyouts(){
		initPublishedFlyoutMenus(
			[{"id":"113396836455084412","title":"Home","url":"index.html","target":"","nav_menu":false,"nonclickable":false},{"id":"264397685514220120","title":"Join Email List","url":"join-email-list.html","target":"","nav_menu":false,"nonclickable":false},{"id":"387497601545912080","title":"Bee Swarm","url":"calendar.php","target":"","nav_menu":false,"nonclickable":false},{"id":"429948090307876468","title":"Wall of Fame","url":"wall-of-fame.html","target":"","nav_menu":false,"nonclickable":false},{"id":"140610074220922761","title":"The Hive","url":"http:\/\/honeyheads.me\/hive\/login.php","target":"","nav_menu":false,"nonclickable":false}],
			"429948090307876468",
			'',
			'active',
			false,
			{"navigation\/item":"<li {{#id}}id=\"{{id}}\"{{\/id}} class=\"wsite-menu-item-wrap\">\n\t<a\n\t\t{{^nonclickable}}\n\t\t\t{{^nav_menu}}\n\t\t\t\thref=\"{{url}}\"\n\t\t\t{{\/nav_menu}}\n\t\t{{\/nonclickable}}\n\t\t{{#target}}\n\t\t\ttarget=\"{{target}}\"\n\t\t{{\/target}}\n\t\t{{#membership_required}}\n\t\t\tdata-membership-required=\"{{.}}\"\n\t\t{{\/membership_required}}\n\t\tclass=\"wsite-menu-item\"\n\t\t>\n\t\t{{{title_html}}}\n\t<\/a>\n\t{{#has_children}}{{> navigation\/flyout\/list}}{{\/has_children}}\n<\/li>\n","navigation\/flyout\/list":"<div class=\"wsite-menu-wrap\" style=\"display:none\">\n\t<ul class=\"wsite-menu\">\n\t\t{{#children}}{{> navigation\/flyout\/item}}{{\/children}}\n\t<\/ul>\n<\/div>\n","navigation\/flyout\/item":"<li {{#id}}id=\"{{id}}\"{{\/id}}\n\tclass=\"wsite-menu-subitem-wrap {{#is_current}}wsite-nav-current{{\/is_current}}\"\n\t>\n\t<a\n\t\t{{^nonclickable}}\n\t\t\t{{^nav_menu}}\n\t\t\t\thref=\"{{url}}\"\n\t\t\t{{\/nav_menu}}\n\t\t{{\/nonclickable}}\n\t\t{{#target}}\n\t\t\ttarget=\"{{target}}\"\n\t\t{{\/target}}\n\t\tclass=\"wsite-menu-subitem\"\n\t\t>\n\t\t<span class=\"wsite-menu-title\">\n\t\t\t{{{title_html}}}\n\t\t<\/span>{{#has_children}}<span class=\"wsite-menu-arrow\">&gt;<\/span>{{\/has_children}}\n\t<\/a>\n\t{{#has_children}}{{> navigation\/flyout\/list}}{{\/has_children}}\n<\/li>\n"},
			{}
		)
	}
//-->
</script>		
</head>
<body class="wsite-theme-light tall-header-page  wsite-page-the-hive">
<!--- Weebly menu -->
<div id="header-wrap">
	<div id="page">
		<div id="header-container">
			<table id="header">
			<tr>
				<td id="logo">
					<span class="wsite-logo">
						<span class="wsite-title-placeholder">&nbsp;</span>
						<span style="display:none">hONEyheads!!</span>
					</span>
				</td>
				<td id="header-right">
					<table>
					<tr>
						<td class="phone-number"></td>
						<td class="social"></td>
					</tr>
					</table>
					<div class="search"></div>
				</td>
			</tr>
			</table>

			<div id="topnav">
				<ul class="wsite-menu-default">
					<li id="pg113396836455084412" class="wsite-menu-item-wrap">
						<a href="/"	class="wsite-menu-item">Home</a>
					</li>
					<li id="pg264397685514220120" class="wsite-menu-item-wrap">
						<a href="/join-email-list.html" class="wsite-menu-item">Join Email List</a>
					</li>
					<li id="pg387497601545912080" class="wsite-menu-item-wrap">
						<a href="/calendar.php" class="wsite-menu-item">Bee Swarm</a>
					</li>
					<li id="pg429948090307876468" class="wsite-menu-item-wrap">
						<a href="/wall-of-fame.html" class="wsite-menu-item">Wall of Fame</a>
					</li>
					<li id="active" class="wsite-menu-item-wrap">
						<a href="http://honeyheads.me/hive/login.php" class="wsite-menu-item">The Hive</a>
					</li>
				</ul>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
</div>
<!-- hONEyhoUSe logo -->
<div id="banner-wrap">
	<div id="container">
		<div id="banner-bot">
			<div id="banner">
				<div id="banner-mid">
					<div id="banner-outer">
						<div class="wsite-header"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--- main area -->
<div id="main-wrap">
	<div id="page">
		<div id="main">
			<div id="content">
				<div id="wsite-content" class="wsite-elements wsite-not-footer">
					<h2 class="wsite-content-title" style="text-align:center;">Admin Login</h2>

					<form id="formLogin" name="formLogin" style="text-align:center;" method="post">
						<div style="color:red;font-size:xx-small;font-style:italic;padding-bottom:15px;">
							*&nbsp;indicates required
						</div>
						
						<div style="padding-bottom:10px;">
							<label for="username">Username:<span style="color:red;">*</span></label>
							<input type="text" id="username" name="username">
						</div>
						<div style="padding-bottom:10px;">
							<label for="password">&nbsp;Password:<span style="color:red;">*</span></label>
							<input type="text" id="password" name="password">
						</div>
						<div style="padding-bottom:15px;">
							<label for="remember">Remember Me:</label>
							<input type="checkbox" name="remember" value="1">
						</div>
						<div style="padding-bottom:15px;">
							<input type="submit" value="&nbsp;&nbsp;Login&nbsp;&nbsp;" id="submit" name="submit" class="button">
							<input type="hidden" name="redirect" value="<?=$redirect;?>"/>
						</div>
						<span id="errorMsg" name="errorMsg" style="color:red;font-size:x-large;">
							<?=$errorMsg;?>
						</span>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="footer-wrap">
	<div id="page">
		<div id="footer"><div class='wsite-elements wsite-footer'>
			Site managed by <a href="https://www.hostmonster.com" target="_blank" rel="nofollow">Hostmonster</a>
		</div>
	</div>
</div>
</body>
</html>
