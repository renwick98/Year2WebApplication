<?php

  ini_set("session.save_path", "/home/unn_w17021949/sessionData");
  session_start();

?>

<?php
require_once("myFunctions.php");
  echo makePageStart ("Edit Event Form", "myCSS.css");
    if (check_login(true)) {
  echo makeLogout("North Events");
  }
  else {
    echo makeLogin("North Events");
  }
  echo makeNavMenu("NAVIGATION", array("chooseEventPage.php"=>"Events List","bookEventsForm.php"=>"Book Events Form","credits.php"=>"Credits","index.php"=>"Index"));
  echo startMain();
  // FUNCTIONS CREATING THE WEB PAGE
  require_once("myFunctions.php");
    if (check_login(true)) {
  // code...

$targetID = isset ($_REQUEST['eventID'])? $_REQUEST ['eventID']: null;
      try{
        $dbConn = getConnection();
         $sqlQuery = "SELECT eventID, eventTitle, venueID, catID, eventDescription, eventStartDate, eventEndDate, eventPrice, eventDescription FROM NE_events WHERE eventID = $targetID";
         $queryResult = $dbConn->query($sqlQuery);
         // THIS FUNCTION ESTABLISHES THE CONNECTION TO THE PHYMYADMIN DATABASE
         $rowObj = $queryResult->fetchObject();
         // SPECIFIES WE ARE GOING TO BE RETRIEVING ROWS OF DATA
         $eventID = $rowObj->eventID;
         $eventTitle = $rowObj->eventTitle;
         $eventPrice = $rowObj->eventPrice;
         $eventDescription = $rowObj->eventDescription;
         $eventStartDate = $rowObj->eventStartDate;
         $eventEndDate = $rowObj->eventEndDate;
         $eventPrice = $rowObj->eventPrice;
         $venueID = $rowObj->venueID;
         $catID = $rowObj->catID;
         // THIS POPULATES THE GIVEN VARIABLES TO RETURN THE SPECIFIC ROWS OF DATA WHICH IS ASKED OF IT
         echo "<h2> Event chosen for edit: '$eventTitle' </h2>
         <form action = 'updateEventPage.php' method = 'POST'>
          <div>
          <p>Event ID</p>
            <input type = 'text' name = 'updateEventID' value = '$eventID' readonly > </input>
          </div> <div>
          <p>Event Title</p>
            <input type = 'text' name = 'updateEventTitle' value = '$eventTitle' > </input>
          </div> <div>
         <p>Event Start Date</p>
           <input type = 'text' name = 'updateEventStartDate' value = '$eventStartDate' > </input>
         </div> <div>
         <p>Event End Date</p>
           <input type = 'text' name = 'updateEventEndDate' value = '$eventEndDate' > </input>
         </div> <div>
         <p>Event Description</p>
           <input type = 'text' name = 'updateEventDescription' value = '$eventDescription' > </input>
         </div> <div>
         <p>Event Price</p>
           <input type = 'text' name = 'updateEventPrice' value = '$eventPrice' > </input>
         </div>  ";
         // THIS CREATES A FORM FOR AND RETRIEVES THE QUERIED DATA INTO THE SPECIFIED DIVS
}
  catch (Exception $e){
    echo "<p>Query failed: ".$e->getMessage()."</p>\n";
    // CATCH FUNCTION WHICH WILL CATCH ANY FAILED QUERIES AND RETURN AN ERROR
  }
  try {
      $dbConn = getConnection();
        $sqlQueryDropCat = "SELECT catDesc, catID FROM NE_category";
        $queryResult = $dbConn->query($sqlQueryDropCat);
          echo "<div>
          <p>Category ID</p>
          <select name = 'updateEventCategory' >
          ";
          while ($rowObj=$queryResult->fetchObject())
          {
            if ($catID===$rowObj->catID){
              echo "<option value = $catID selected = 'SELECTED'> {$rowObj->catDesc}</option>";
            }
            else {
              echo "<option value = {$rowObj->catID} > {$rowObj->catDesc}</option>";
            }
          }
          echo "</select> </div>";
  }     // THIS DYNAMICALLY CREATES THE DROPDOWN BOX FROM THE DATABASE TO THE FORM FOR THE CATEGORY ID
  catch (Exception $e){
    echo "<p> Oh no oh no oh no".$e->getMessage()."</p>\n";
  }
  // CATCH FUNCTION WHICH WILL CATCH ANY FAILED QUERIES AND RETURN AN ERROR

  try {
      $dbConn = getConnection();
        $sqlQueryDropVen = "SELECT venueID, venueName FROM NE_venue";
        $queryResult = $dbConn->query($sqlQueryDropVen);
          echo "<div>
          <p> Venue ID </p>
          <select name = 'updateEventVenue' >
          ";
          while ($rowObj=$queryResult->fetchObject())
          {
            if ($venueID===$rowObj->venueID){
              echo "<option value = $venueID SELECTED = 'SELECTED'> {$rowObj->venueName}</option>";
            }
            else {
              echo "<option value = {$rowObj->venueID} > {$rowObj->venueName}</option>";
            }
          }
          echo "</select> </div>";
  }     // THIS DYNAMICALLY CREATES THE DROPDOWN BOX FROM THE DATABASE TO THE FORM FOR THE VENUE ID
  catch (Exception $e){
    echo "<p> Oh no oh no oh no".$e->getMessage()."</p>\n";
  }     // CATCH FUNCTION WHICH WILL CATCH ANY FAILED QUERIES AND RETURN AN ERROR
  echo " <br> <input type='submit' name='submit'>
  </form> ";
        // THESE TAGS CLOSE MY FORM
}


else {
  echo "<h2> PLEASE LOG IN</h2>";
}
echo endMain();
echo makeFooter("Luke Renwick - w17021949");
echo makePageEnd();
        // FUNCTIONS CREATING THE WEB PAGE
?>
