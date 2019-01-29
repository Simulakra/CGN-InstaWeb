<script type="text/javascript">
	if(window.location.hash.length>0)
	 window.location.href = "auth.php?"+window.location.hash.substring(1);
</script>
<body>
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
		$handle = fopen("site.settings", "r");

	if ($handle) {
		echo '<form method="POST" action="savesettings.php" >';
		$rowcount=4;

	    if (($line = fgets($handle)) !== false) {
	    	echo 'Site Title: <br><input type="text" name="sitetitle" value="'.$line.'"><br>';
	        $rowcount--;
	    }
	    if (($line = fgets($handle)) !== false) {
	    	echo 'Site Sub Title: <br><input type="text" name="sitesubtitle" value="'.$line.'"><br>';
	        $rowcount--;
	    }
	    if (($line = fgets($handle)) !== false) {
	    	echo 'Site Desc: <br><textarea rows="4" cols="50" name="sitedesc">'.str_replace("<br>", "\n", $line).'</textarea><br>';
	        $rowcount--;
	    }
	    if (($line = fgets($handle)) !== false) {
	    	echo 'Site Background Color: <br><input type="color" name="sitebg" value="'.substr($line, 0, 7).'"><br>';
	        $rowcount--;
	    }

	    if( $rowcount>=4 ) echo 'Site Title: <br><input type="text" name="sitetitle"><br>';
	    if( $rowcount>=3 ) echo 'Site Sub Title: <br><input type="text" name="sitetitle"><br>';
	    if( $rowcount>=2 ) echo 'Site Desc: <br><textarea rows="4" cols="50" name="sitedesc"></textarea><br>';
	    if( $rowcount>=1 ) echo 'Site Background Color: <br><input type="color" name="sitebg"><br>';

	    fclose($handle);

	    echo '<button type="submit" value="Submit">Değişiklikleri Kaydet</button>';
		echo '</form>';
	} else {
	    echo "ERROR: Couldn't handle site.settings file.";
	} 
}
//echo $_GET["access_token"];
//https://api.instagram.com/oauth/authorize/?client_id=cd4fae473b4f4daa8c3af0ac15badf8f&redirect_uri=http://localhost/CGN-InstaWeb/auth.php&response_type=token
?>
</body>