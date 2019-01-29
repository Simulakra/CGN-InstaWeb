<?php 
	
$handle = fopen("site.settings", "w");

$temp = "";
if( isset($_POST["sitetitle"]) ){ $temp .= $_POST["sitetitle"]; } $temp .= "\n";
if( isset($_POST["sitesubtitle"]) ){$temp .= $_POST["sitesubtitle"]; } $temp .= "\n";
if( isset($_POST["sitedesc"]) ){$temp .= str_replace("\n", "<br>", $_POST["sitedesc"]); } $temp .= "\n";
if( isset($_POST["sitebg"]) ){$temp .= $_POST["sitebg"]; } $temp .= "\n";

fwrite($handle, $temp);
fclose($handle);

header("Location: index.php");
//echo $temp;
?>