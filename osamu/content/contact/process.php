<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/mail_functions.php';
// if ($_POST['m66'] != "") {
//   $page['title'] = 'Stop BOTS';
 
// }
if ($_POST) {
    $name = "";
    $nameErr = "";
    $email = "";
    $emailErr = "";
    $contact_reason = "";
    $reasonErr = "";
    $message = "";
    $messageErr = "";
    $subtitle = "";
    $errors = array();
    
    
    
    if(isset($_POST['name']) && checkName($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    } else {
      $nameErr = "Letters and spaces only in the name section please";
      $errors[] = $nameErr;
    }
     
    if(isset($_POST['email']) && checkEmail($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    } else {
      $emailErr = "Please provide a valid email address";
      $errors[] = $emailErr;
    }
     
    if(isset($_POST['message']) && checkMessage($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
    } else {
      $messageErr = 'Please do no use any special characters in your message. Letters, spaces, numbers and punctuation (".", "?", ",", "-") only';
      $errors[] = $messageErr;
    }
     
    $recipient = "enquiries@pcwebsites.com.au";
    
     
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $name . "\r\n" . 'Reply-To: ' . $email . "\r\n" ;
    
    if (empty($errors)) {
      if(mail($recipient, $contact_reason, $message, $headers)) {
        $page['title'] = "Your message has been sent";
        $subtitle = "Thanks for contacting me, I will get back to you shortly. Feel free to keep browsing.";
      } else {
        $page['title'] = "Message failed to send";
        $subtitle = 'Please contact me via <a href="https://twitter.com/PerthDev" target="_blank">twitter</a> or <a href="https://www.linkedin.com/in/osamu-morozumi-692a27141/" target="_blank">linkedin</a>';
      }
    }
       else {
      $page['title'] = "One or more fields is incorrectly filled out";
      $subtitle = 'There are errors in the format of your message. Please review the list below and <a href="./contact.php">try again</a>';
     
    } 
} else {
  $page['title'] = "Something went wrong";
}
$page['description'] = 'success/error';
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.inc.html.php';
include $_SERVER['DOCUMENT_ROOT'] . '/templates/nav.inc.html.php';

?>
<main class="outer">
 <!-- main content -->
   <article class="blog-article card" id="content">
        
   <div class="article-header flex wrap">
          <section class="article-header">
            <h2>
              <?php echo $page['title']; ?>
            </h2>
            <h3><?php echo $subtitle; ?></h3>
          </section>
        </div>
  </div>
  
  <section class="errors outer">
    <ul>
    <?php 
      foreach ($errors as &$err) {
        if ($err != "") {
          echo '<li>' . $err . '</li>';
        }
      }
    ?>
    </ul>
  </section>
<hr>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.inc.html.php'; ?>