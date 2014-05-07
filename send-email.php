<?php
if(isset($_POST['email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "zartre.y@gmail.com";
    $email_subject = "THXSP";
     
     
    function died($error) {
        // your error code can go here
        echo "มีข้อผิดพลาดเกิดขึ้น";
        echo "ด้านล่างนี้คือข้อผิดพลาด<br /><br />";
        echo $error."<br /><br />";
        echo "กรุณาแก้ข้อผิดพลาดเหล่านี้<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {    
    $error_message .= 'อีเมลไม่ถูกต้อง<br />';
  }
    
  if(strlen($message) < 2) {
    $error_message .= 'ข้อความไม่ถูกต้อง<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
      
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

$mailResponse = mail($email_to, $email_subject, $email_message, $headers);  

if($mailResponse) { //if $mailResponse is True (if the mail was sent)

    header('Location: contact-success.html'); //redirecting to contact-success.html

} else {
    echo "Sorry. Unable to send the email. Please try again later!";   
}

?> 
<?php
}
?>