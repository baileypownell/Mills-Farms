 <?php

// New contact form
// Wolfmania PHP Mailer

// validate for numeric...
// ...this one also replaces common numeric ameliorations and returns the $string if TRUE...
function validateNumeric($string) {
     $newString = trim(str_replace(array('$','+',',',' ','(',')'), '', $string));
     if (is_numeric($newString) == TRUE) {
          return $newString;
     } else {
          return FALSE;
     }
}
// validate for alpha-numeric, and several other characters...
// TODO: what about accent marks for international words?
function validateAlphaNum($string) {
     if ($string == preg_replace("/[^a-z\d\s\_\$\'\~\-\+\.\,\(\)]/i", '', $string)) {
          return $string;
     }
}
// validate/sanitize emails for forms...
function validateEmail($form_field) {
     if(filter_var($form_field, FILTER_VALIDATE_EMAIL)) {
          return $form_field;
     }
}
// validate against html tags...
function validateNoTags($string) {
     if ($string == strip_tags($string)) {
          return $string;
     }
}


$result="";

//var_dump($_POST);

if(isset($_POST['user_email'])) {
  require ('PHPMailerAutoload.php');
  $mail = new PHPMailer;
  $mills_email = 'bailey.pownell@gmail.com';

  $mail->Host='smtp.gmail.com';
  $mail->Port=587;
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='tls';
  $mail->Password='Believer323';

  $mail->setFrom($_POST['user_email']);
  $mail->addAddress($mills_email);
  $mail->addReplyTo($_POST['user_email']);

  $mail->isHTML(true);
  $mail->Subject='Form Submission:  Website Message'; 
  $mail->Body='<h1 align=left>Name: ' .$_POST['user_name'].'<br>Email: '.$_POST['user_email'].'<br>Message: '.$_POST['user_message'].'</h1>';

  if(!$mail->send()) {
    $result = "Something went wrong. Please try again.";
  } else {
    $result = "Thanks " . validateAlphaNum($_POST['user_name']) . " for contacting us. We'll get back to you soon!";

  }
  //echo($result);
 }

?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author" content="Bailey Pownell">
    <title>Mills Farms</title>
    <meta name="description" content="Beef farm in Cass County, Indiana.">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="mills.css">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text|Nothing+You+Could+Do" rel="stylesheet">
    <link rel="stylesheet" href="/path/to/css/stylesheet.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
  <header>
    <div><a href="index.html"><img src="images/logo.png" class="logo"></a></div>
    <input type="checkbox" class="nav-toggle" id="nav-toggle">

      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="OurProduct.html">Our Product</a></li>
          <li><a href="ContactUs.php">Contact Us</a></li>
          <li><a href="About.html">About</a></li>
        </ul>
      </nav>
      <label for="nav-toggle" class="nav-toggle-label">
        <span><div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div></span>
      </label>
    </header>

  <!-- VIDEO -->
  <div class="pasture"></div>
   <!--<div id="video-container"><a href="#"></a>

   <video poster="images/cows.jpg" preload="auto" loop="loop" autoplay muted>
    <source src="wheat.mp4" type="video/mp4">
    <source src="wheat.webm" type="video/webm">
    </video> -->


  <main>
    <h5 class="slide">Questions? Comments? Need to place an order? Just fill out the form below!</h5>
    <div class="contactWrapper fading">
      <div id="flex">
      <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="user_name">
        <label for="mail">E-mail:</label>
        <input type="email" id="mail" name="user_email">
        <label for="msg">Message:</label>
        <textarea id="msg" name="user_message"></textarea>
        <div class="button">
          <button type="submit">SUBMIT</button>
        <?php echo "<p class='submitNotification'>" . $result . "</p>"; ?>
      </div>
      </form>
      <!-- Facebook Page -->
        <div>
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fwalmart%2F&tabs=timeline&width=500&height=800&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="800" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
      </div>
    </div>

        <div id="map"></div>
        <script>
        function initMap() {
          var location = {lat: 40.694740, lng: -86.213490};
          var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: location
          });
          var marker = new google.maps.Marker({
            position: location,
            map: map
          });
        }
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS6Mh_Xo7Q80P_RpB5fZXQp0HMl0qBnJ0&callback=initMap"></script>
      </div>
    </main>

  <footer>
    <div class="footer-parent">
    <br>
    <div><a href=""><img class="logo" src="images/logo.png"></a></div>
    <br>
    <hr>
    <br>
      <p>Address: 4881 South 850 East, Walton IN 46994</p>
      <p>Phone: (574) 626-0528</p>
      <p>E-mail: millsfamilyfarmsindiana@gmail.com</p>
      <p>&copy;2019 Mills Farms.</p>
    <br>
  </div>
  </footer>

</body>

</html>
