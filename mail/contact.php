
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
if(isset($_POST['captcha'])){
	if($_POST['captcha']==1){


function isEmail($email) {
  return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

	$name     = $_POST['name'];
    $email    = $_POST['email'];
    $message	=$_POST['message'];


if(!isEmail($email)) {
  echo '<div class="alert alert-error">You must enter a valid email address.</div>';
  exit();
}

$s_body="Bize ulaştıgınız için teşekkür ederiz. En kısa sürede tarafınıza geri dönüş yapılacaktır.";
$msg = $name.' tarafından gönderilen iletişim formu ektedir:'.PHP_EOL.PHP_EOL.'"'.$message.'"'.PHP_EOL.PHP_EOL.'e-mail:'.$email;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';     
  $mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Host = "mail.apazbutikotel.com";
	$mail->SMTPAuth = true;
	$mail->Username = "info@apazbutikotel.com";
	$mail->Password = "123infO321";
	$mail->setFrom("info@apazbutikotel.com","Apaz Otel İnfo");
	$mail->AddAddress("info@apazbutikotel.com");
	$mail->Subject = "İletişim Formu";
	$mail->Body = $msg;
	

	$smail= new PHPMailer();
  	$smail->IsSMTP();
  	$smail->CharSet = 'UTF-8';
  	$smail->Host="mail.apazbutikotel.com";
	$smail->SMTPAuth=true;
	$smail->Username="info@apazbutikotel.com";
	$smail->Password="123infO321";
	$smail->setFrom("info@apazbutikotel.com","Apaz Otel İnfo");
	$smail->AddAddress("$email");
	$smail->Subject="Mesaj Onayı";
	$smail->Body=$s_body;
	

	if($smail->send() && $mail->send()){
		$_SESSION['message']="Mesajınız Gönderilmiştir";
		$_SESSION['success']=true;
		header("Location:../index.php");
	}else{
		$_SESSION['message']="Hata!";
		$_SESSION['success']=false;
		header("Location:../index.php");
	}

  
  }else{
	  $_SESSION['message']="Hata! Lütfen robot olmadığınızı doğulayın";
	  $_SESSION['success']=false;
	  header("Location:../index.php");
}

}else{
	$_SESSION['message']="Hata! Lütfen robot olmadığınızı doğulayın";
  	$_SESSION['success']=false;	
  	header("Location:../index.php");
}







?>
