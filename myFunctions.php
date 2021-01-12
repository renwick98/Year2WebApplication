<?php

function set_session($key, $value){
  $_SESSION[$key] = $value;
  return true;
} // FUNCTION WHICH SET'S A SESSION IF THE KEY ENTERED MATCHES THE VALUE FOUND IN THE DATABASE

function get_session($key){
  $feedbackKey = "";
  if(isset($_SESSION[$key])){
    $feedbackKey = $_SESSION[$key];
  }
  return $feedbackKey;
} // FUNCTION WHICH SETS THE VALUE OF THE RETURN TO THE CALLER INDICATING THE STATUS OF THE SESSION, MAINLY IF THE SESSION IS PRESENT OR NOT, ALLOWS SYSTEM TO BE ABLE TO DETECT IF USER IS OR IS NOT LOGGED IN

function check_login(){
  if(get_session('logged-in')){
    return true;
  }
  else {
    return false;
  }
}
// FUNCTION TO DETECT IF THE USER IS OR IS NOT LOGGED IN, CALLS GET SESSION FUNCTION

function getConnection() {
  try {
    $connection = new PDO("mysql:host=localhost;dbname=unn_w17021949","unn_w17021949", "MJQXRTEY");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   return $connection;
  }
  catch (Exception $e) {
    throw new Exception("Connection error ". $e->getMessage(), 0, $e);
  }
}

// FUNCTION TO GET THE CONNECTION TO THE DATABASE, ALLOWS DATA TO BE READ BACK. CAN BE CALLED FROM OTHER FILES


function makePageStart($pageContentIndex, $Start) {
$pageStartContent = <<<PAGESTART
<!doctype html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>$pageContentIndex</title>
 <link href="$Start" rel="stylesheet" type="text/css">
</head>
<body>
<div id="gridContainer">
PAGESTART;
$pageStartContent .="\n";
return $pageStartContent;
}
// FUNCTION TO MAKE THE STARTING CONTENT OF HTML

function makeLogin($headerIndex){
$headContent = <<<HEAD
 <header>
  <h1>$headerIndex</h1>
  <form method = 'post' action = 'loginProcess.php'>
  <input type='text' name='username'>
  <input type='password' name='password'>
  <input type='submit' value='Logon'>
  </form>
 </header>
HEAD;
$headContent .="\n";
return $headContent;
}
// FUNCTION TO MAKE THE LOGIN FORM OF THE USER TO FILL OUT, OTHER FILES USE IN CONJUNCTION WITH CHECK SESSION TO SEE IF THE USER IS OR IS NOT LOGGED IN.

function makeLogout($headerIndex){
$headContent = <<<HEAD
 <header>
  <h1>$headerIndex</h1>
  <form method = 'post' action = 'logoutProcess.php'>
  <input type='submit' value='Logout'>
  </form>
 </header>
HEAD;
$headContent .="\n";
return $headContent;
}
// FUNCTION TO DISPLAY LOGOUT BUTTON TO THE USER, IF THE USER IS LOGGED IN, OTHER FILES USE IN CONJUNCTION WITH THE CHECK SESSON TO SEE IF THE USER IS OR IS NOT LOGGED IN.

function makeNavMenu($navMenuHeader, $input) {
$navMenuContent = <<<NAVMENU
 <nav>
  <h2>$navMenuHeader</h2>
<ul>
NAVMENU;

foreach ($input as $key => $value) {
  $navMenuContent .= "<li> <a href = $key> $value</a>";
  }
  $navMenuContent .= "</ul>";
$navMenuContent .= "</nav>";

$navMenuContent .= "\n";
return $navMenuContent;
}
// FUNCTION TO MAKE THE NAVIGATION MENU, WHEN CALLED PARAMETERS TO MAKE THE NAVIGATION MENU IS CALLED.

function startMain() {
  return "<main>\n";
 }

function endMain() {
  return "</main>\n";
 }
 // FUNCTIONS TO MAKE THE SURROUNDING TAGS FOR THE BODY

function makeFooter($footerMenuContent) {
$footContent = <<<FOOT
<footer>
<p>$footerMenuContent</p>
</footer>
FOOT;
$footContent .="\n";
return $footContent;
}
// FUNCTION TO MAKE THE FOOTER CONTENT

function makePageEnd() {
return "</div>\n</body>\n</html>";
}

// FUNCTION TO MAKE THE PAGE END HTML
 ?>
