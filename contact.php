<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 
    $mail_to = "india@ricklowe.studio";
    
    # Sender form data
    $subject = "Rick Lowe Studio - New message from Website";
    $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["visitor_name"])));
    $email = filter_var(trim($_POST["visitor_email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["visitor_message"]);
    
    if (empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($message)) {
      # Set a 400 (bad request) response code and exit
      http_response_code(400);
      echo '<p class="alert-warning">Please complete the form and try again.</p>';
      exit;
    }

    # Mail content
    $content = "Name: $name\n<br>";
    $content .= "Email: $email\n\n<br>";
    $content .= "Phone: $phone\n<br>";
    $content .= "Message:\n$message\n<br>";

    # Email headers
    $headers  = "From: <$email>\r\nX-Mailer: php\r\n";
	$headers .= "MIME-Version: 1.0\r\n"; #Define MIME Version
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; #Set content type
	$headers .= "Cc: info@ricklowe.studio\r\n"; #Your BCC Mail List
	$headers .= "Bcc: fred.arnal@gmail.com\r\n"; #Your BCC Mail List

    # Send the email
    if ($email != "eric.jones.z.mail@gmail.com") {
    $success = mail($mail_to, $subject, $content, $headers);}
    
      # Set a 200 (okay) response code
      http_response_code(200);
      header('Location: https://www.ricklowe.com/contact.html');
exit;
}
?>