 <?php

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

$user_name="";

if (isset($_POST['submit'])) {

  require ('PHPMailerAutoload.php');
  $mail = new PHPMailer;
  $mills_email = 'bailey.pownell@gmail.com';

  $mail->Host='smtp.gmail.com';
  $mail->Port=587;
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='tls';
  $mail->Password='CENSORED';

  $mail->setFrom($_POST['user_email']);
  $mail->addAddress($mills_email);
  $mail->addReplyTo($_POST['user_email']);

  $mail->isHTML(true);
  $mail->Subject='Form Submission:  Website Message';
  $mail->Body='<h1 align=left>Name: ' .$_POST['user_name'].'<br>Email: '.$_POST['user_email'].'<br>Message: '.$_POST['user_message'].'</h1>';

  /* if(!$mail->send()) {
    $result = "Something went wrong. Please try again.";
  } else {
    $result = "Thanks " . validateAlphaNum($_POST['user_name']) . " for contacting us. We'll get back to you soon!";

  } */

 }

 // function to alert the user of an email whe it is sent
  function alert() {
    ?>
    <script>
    alert('Your message has been sent!');
    </script>
    <?php
}
?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author" content="Bailey Pownell">
    <title>Mills Farms</title>
    <meta name="description" content="Beef farm in Bucks County, Pennsylvania.">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="mills.css">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text|Nothing+You+Could+Do" rel="stylesheet">
    <link rel="stylesheet" href="/path/to/css/stylesheet.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
  <header>
    <div><a href="index.html"><img src="images/barn.png" class="logo"></a></div>
    <input type="checkbox" class="nav-toggle" id="nav-toggle">

      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="ContactUs.html">Contact Us</a></li>
          <li><a href="About.html">About</a></li>
        </ul>
      </nav>
      <label for="nav-toggle" class="nav-toggle-label">
        <span><div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div></span>
      </label>
  </header>
  <div class="contactAndAbout-image">
     <img src="images/herd.jpg" alt="cows in pasture">
  </div>
  <main>
    <h5 class="slide">Questions? Comments? Need to place an order? Just fill out the form below!</h5>
    <div class="contactWrapper fade">
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

      </div>
      </form>
      <!-- Facebook Page -->
      <div>
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fwalmart%2F&tabs=timeline&width=500&height=800&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="300" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
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
      <div class="darken">
        <div><a href=""><img class="logo" src="images/barn.png"></a></div>
        <p><i class="fas fa-map-pin"></i>4881 South 850 East, Doylestown PA 18901</p>
        <p><i class="fas fa-phone-square"></i>(939) 517-9091</p>
        <p><i class="fas fa-at"></i>millsfamilyfarms@gmail.com</p>
        <p>&copy;2019 Mills Family Farms.</p>
        <p><a href=""><i class="fab fa-facebook-square"></i></a><a href=""><i class="fab fa-instagram"></i></a><a href=""><i class="fab fa-twitter-square"></i></a></p>
      </div>
    </div>
    </footer>

</body>

</html>
