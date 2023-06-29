<?php
require_once('./config.php');
require_once('./db.php');

// Open database
$db = new KudosDB();

// Get the user's IP address and the work ID, whatever it is
$ip = $_SERVER['REMOTE_ADDR'];

if (array_key_exists('give', $_GET)) {
  // We're giving kudos

  // the work ID is a text string so it can be a number, it can be an abbreviation,
  // it just can't have weird characters in it that would fuck up the database
  $work = filter_var($_GET['give'], FILTER_SANITIZE_STRING);

  // check if the work exists so people can't fill the db full of junk
  $exists = $db->query("select count(*) from works where id={$work};");
  // check if the IP address has already left kudos
  $prevkudos = $db->query("select count(*) from kudos where workid={$work} and ipaddr={$ip};");
  if ($exists > 0 && $prevkudos == 0) {
    $db->query("insert into kudos (workid, ipaddr) values ({$work}, {$ip});");
    $content = "Thanks for leaving kudos! You can now close this window.";
    require("./template.php");
  }
} else if (array_key_exists('show', $_GET)) {
  // We're showing the number of kudos
  
  $work = filter_var($_GET['show'], FILTER_SANITIZE_STRING);
  $count = $db->query("select count(*) from works where id={$work};");

  // creates a new image
  $image = new Imagick();
  // writes the number
  $id->annotation(0, 0, $count);
  $image->newImage(50, 300, "none");
  $image->setImageFormat("png");
  $image->drawImage($id);
  $image->trimImage(0);

  // serves this as an image
  header("Content-Type: image/png");
  echo $imagick->getImageBlob();
} else if (array_key_exists(FORM_PAGE, $_GET)) {
  // We're showing a simple form for creating new works
  
  $content = file_get_contents("./form.php");
  require("./template.php");
} else if (array_key_exists('newwork', $_POST)) {
  $work = filter_var($_POST['newwork'], FILTER_SANITIZE_STRING);
  // check if the work exists already since we can't do duplicates
  $exists = $db->query("select count(*) from works where id={$work};");
  $content = "";
  if ($exists == 0) {
    // it doesn't already exist, so add it to the database
    $result = $db->query("insert into works (id) values ('{$work}');");
    // show a response with a message that tells us if it worked or not
    if ($result) {
      $content = "<p>Your new work has been added! The work ID is {$work}.</p>";
      $content .= "<p>Link to give kudos: <a href=\"//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?give={$work}\">//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?give={$work}</a></p>";
      $content .= "<p>Link to kudos counter: <a href=\"//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?show={$work}\">//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?show={$work}</a></p>";
      $content .= file_get_contents("./form.php");
    } else {
      $content = "<p class='error'>Whoops! It seems like something went wrong; try again.</p>";
      $content .= file_get_contents("./form.php");
    }
  } else {
    $content = "<p class='error'>You've already got a work by this name; try a different ID.</p>";
    $content .= file_get_contents("./form.php");
  }
  
  require("./template.php");
}

// if we haven't closed connection yet, we're done now.
die(1);
