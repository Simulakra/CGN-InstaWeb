<script type="text/javascript">
	if(window.location.hash.length>0)
	 window.location.href = "auth.php?"+window.location.hash.substring(1);
</script>
<?php 
if( !file_exists("user.settings") && !empty($_GET["access_token"]) ){
	$myfile = fopen("user.settings", "w");
	fwrite($myfile, $_GET["access_token"]);
	fclose($myfile);
	header("Location: index.php");
}
else{
	if( !file_exists("site.settings") )
		$handle = fopen("site.settings", "w");
	else 
		$handle = fopen("site.settings", "r+");

	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
	        // process the line read.
	    }

	    fclose($handle);
	} else {
	    echo "ERROR: Couldn't handle site.settings file.";
	} 
}
//echo $_GET["access_token"];
//https://api.instagram.com/oauth/authorize/?client_id=cd4fae473b4f4daa8c3af0ac15badf8f&redirect_uri=http://localhost/CGN-InstaWeb/auth.php&response_type=token
?>