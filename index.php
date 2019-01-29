<?php error_reporting(0); 

$sitetitle = "";
$sitesubtitle = "";
$sitedesc = "";
$sitebg = "";

if( !file_exists("user.settings") )
	header("Location: https://api.instagram.com/oauth/authorize/?client_id=cd4fae473b4f4daa8c3af0ac15badf8f&redirect_uri=http://localhost/CGN-InstaWeb/auth.php&response_type=token");
else if( !file_exists("site.settings") )
	header("Location: auth.php");
else{
	$handle = fopen("site.settings", "r");
	if (($line = fgets($handle)) !== false) $sitetitle = $line;
	if (($line = fgets($handle)) !== false) $sitesubtitle = $line;
	if (($line = fgets($handle)) !== false) $sitedesc = $line;
	if (($line = fgets($handle)) !== false) $sitebg = substr($line, 0, 7);
}
?>
<html>
	<head>
		<title><?php echo $sitetitle." - ".$sitesubtitle; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/images/favicon/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="assets/images/favicon/apple-touch-icon-60x60.png" />
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/images/favicon/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/images/favicon/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/images/favicon/apple-touch-icon-152x152.png" />
		<link rel="icon" type="image/png" href="assets/images/favicon/favicon-196x196.png" sizes="196x196" />
		<link rel="icon" type="image/png" href="assets/images/favicon/favicon-96x96.png" sizes="96x96" />
		<link rel="icon" type="image/png" href="assets/images/favicon/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="assets/images/favicon/favicon-16x16.png" sizes="16x16" />
		<link rel="icon" type="image/png" href="assets/images/favicon/favicon-128.png" sizes="128x128" />
		<link rel="stylesheet" href="assets/css/ekko-lightbox.css">
		<meta name="application-name" content="&nbsp;"/>
		<meta name="msapplication-TileColor" content="#FFFFFF" />
		<meta name="msapplication-TileImage" content="assets/images/favicon/mstile-144x144.png" />
		<meta name="msapplication-square70x70logo" content="assets/images/favicon/mstile-70x70.png" />
		<meta name="msapplication-square150x150logo" content="assets/images/favicon/mstile-150x150.png" />
		<meta name="msapplication-wide310x150logo" content="assets/images/favicon/mstile-310x150.png" />
		<meta name="msapplication-square310x310logo" content="assets/images/favicon/mstile-310x310.png" />

		<meta name="description" content="Apaz Butik Otel, yapıldığı dönemin özgün ayrıntılarıyla, günümüz konforunun ince bir zevkle birleştiği kendine has bir sıcaklığa sahip butik otel." />

		<meta name="keywords" content="Apaz Butik Otel,Alaçatı Butik Oteller, Alaçatı Otelleri, Butik Otel Alaçatı, Alaçatı Otel Çeşme" />
	</head>
	<body style="<?php echo'background-color: '.$sitebg.';' ?>">

		<!-- Wrapper -->
			<div id="wrapper">

<div class="container">	
	
<header id="header">
<h1 ><a  href="index.php" style="cursor: pointer;text-decoration:none" ><img class="logo" src="assets/images/favicon/apple-touch-icon-72x72.png" /><strong><span class="logocolor"><?php echo $sitetitle; ?></span></strong><span class="respon"><?php echo $sitesubtitle; ?></span></a>
<nav>
<ul>
<li class="logocolor" ><a href="#footer"style="cursor: pointer;text-decoration:none"  class="icon fa-info-circle"><span class="logocolor">Hakkımızda</span></a></li>
</ul>
</nav>
</h1>
</header>
</div>

				<!-- Main -->
					<div id="main">
						<?php
							session_start();
							function rudr_instagram_api_curl_connect( $api_url ){
							$connection_c = curl_init(); // initializing
							curl_setopt($connection_c, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
							curl_setopt($connection_c, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
							curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
							curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
							$json_return = curl_exec( $connection_c ); // connect and get json data
							curl_close( $connection_c ); // close connection
							return json_decode( $json_return ); // decode and return
						    }

							$access_token	= fread(fopen("user.settings","r"),filesize("user.settings"));//'4618655325.aec4650.4a63731d091340d4b67322cbfadc6ab0';
							$return			= rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/self/media/recent?access_token=" . $access_token);
							foreach ($return->data as $post) {
								if ($post->type=="video") {
									echo '
										<div class="square">
											<div class="content">
												<div class="table">
													<div class="table-cell">
														<article class="thumb">
															<a href="'.$post->videos->standard_resolution->url.'" data-toggle="lightbox"><img src="'.$post->images->standard_resolution->url.'" /></a>

															<h2>'.mb_strimwidth($post->videos->caption->text, 0, 120, "...").'</h2>
												
															<p>'.$post->videos->caption->text.'</p>
														</article>
													</div>
												</div>
											</div>
										</div>';
								}else{
								echo '
									<div class="square">
										<div class="content">
											<div class="table">
												<div class="table-cell">
													<article class="thumb">
														<a href="'.$post->images->standard_resolution->url.'" class="image">';
														
														if($post->images->standard_resolution->width > $post->images->standard_resolution->height){
															echo '<img class="wbigger" src="'.$post->images->thumbnail->url .'" alt="" />';
														}else{
														echo '<img src="'.$post->images->standard_resolution->url.'" alt="" />';
														}
														
														echo '
														</a>

														<h2>'.mb_strimwidth($post->caption->text, 0, 120, "...").'</h2>
											
														<p>'.$post->caption->text.'</p>
													</article>
												</div>
											</div>
										</div>
									</div>';
								}
							}



						?>
				
						
					</div>

				<!-- Footer -->
					<footer id="footer" class="panel">
						<div class="inner split">
							<div>
								<section>
									<h2><?php echo $sitetitle." - ".$sitesubtitle; ?></h2>
									<p><?php echo $sitedesc; ?></p>
								</section>
								<section>
									<h2>BİZİ TAKİP EDİN</h2>
									<ul class="icons">
										<li><a href="https://www.instagram.com/<?php echo rudr_instagram_api_curl_connect('https://api.instagram.com/v1/users/self/?access_token='.$access_token)->data->username; ?>" class="icon fa-instagram" target="_blank"><span class="label">Instagram</span></a></li>	
									</ul>
								</section>
								<p class="copyright">
								 <a class="icon" href="http://www.cgnyazilim.com"><strong>designed by CGN</strong></a>.
								</p>
							</div>
							<div>
								<section>
									<h2>İLETİŞİM İÇİN BİZE YAZIN</h2>
									<?php
										if (isset($_SESSION['message'])) {
											if ($_SESSION['success']) {
												echo '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>';
                        						session_destroy();
											}else{
												echo '<div class="alert alert-danger" role="alert">'.$_SESSION['message'].'</div>';
												session_destroy();
											}
										}
									?>
									<form method="post" action="mail/contact.php">
										<div class="field half first">
											<input type="text" name="name" id="name" placeholder="Adınız" required />
										</div>
										<div class="field half">
											<input type="text" name="email" id="email" placeholder="Email" required />
										</div>
										<div class="field">
											<textarea name="message" id="message" rows="4" placeholder="Mesajınız" required></textarea>
										</div>
										<div class="field">
											<span class="robot">Ben Robot Değilim!</span><input type="checkbox" name="captcha" value="1"> 
										</div>
										<ul class="actions">
											<li><input type="submit" value="Gönder" class="special" /></li>
										</ul>
									</form>
								</section>
							</div>
						</div>
					</footer>

			</div>
<script type="text/javascript">
	        	$('.inzVideo').contents().find('body').css({
            background: 'purple'
        });
	        </script>  
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>			
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/jquery.poptrox.min.js"></script>
            <script src="assets/js/ekko-lightbox.js"></script>
            <script>
	            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
	                event.preventDefault();
	                $(this).ekkoLightbox();
	            });
	        </script> 
	        
	        
	</body>
</html>